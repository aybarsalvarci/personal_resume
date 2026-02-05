<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\CreateRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Services\Helpers;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Project::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
            $query->orWhere('slug', 'like', '%' . $request->search . '%');
        }

        $projects = $query
            ->orderBy('created_at', 'DESC')
            ->with('category')
            ->paginate(10)
            ->withQueryString();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProjectCategory::orderBy('name', 'DESC')->get();
        return view('admin.projects.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $data = $request->validated();

        // image upload
        $data['image'] = ImageService::upload($request->file('image'), 'images/projects/thumbnails', 800);

        // create slug
        $data['slug'] = $data['slug'] ? Str::slug($data['slug']) : Str::slug($data['name']);

        try {
            Project::create($data);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
            return back()->with('error', "Bir hata oluştu.");
        }

        Log::info('Project created successfully.', $data);
        return redirect()->route('admin.projects.index')->with('success', 'Proje başarıyla oluşturuldu.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        $categories = ProjectCategory::all();
        return view('admin.projects.edit', compact('project', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        //find project
        $project = Project::findOrFail($id);

        $data = $request->validated();

        // thumbnail update
        if ($request->hasFile('image')) {
            try {

                if (Storage::disk('public')->exists($project->image)) {
                    Storage::disk('public')->delete($project->image);
                }

                $data['image'] = ImageService::upload($request->file('image'), 'images/projects/thumbnails', 800);
            } catch (\Exception $exception) {
                Log::error("Proje kapak fotoğrafı güncellenirken bir hata oluştu: " . $exception->getMessage(), $exception->getTrace());
                return redirect()->back()->with("error", "Bir hata oluştu.");
            }
        }

        // editor images
        if ($request->description != $project->description) {
            try {

                $existingImages = Helpers::extractImagesFromEditor($project->description);
                $newImages = Helpers::extractImagesFromEditor($request->description);

                foreach ($existingImages as $image) {
                    if (!in_array($image, $newImages) && Storage::disk('public')->exists($image)) {
                        Storage::disk('public')->delete($image);
                    }
                }
            } catch (\Exception $exception) {
                Log::error("Proje editörü içerisindeki görseller güncellenirken bir hata oluştu: " . $exception->getMessage(), $exception->getTrace());
                return redirect()->back()->with("error", "Bir hata oluştu.");
            }
        }

        try {
            $project->update($data);

        } catch (\Exception $exception) {
            Log::error("Projedeki değişiklikler veritabanına kaydedilirken bir hata oluştu: " . $exception->getMessage(), $exception->getTrace());
            return redirect()->back()->with("error", "Bir hata oluştu.");

        }
        return redirect()->route('admin.projects.index')->withSuccess("Proje başarıyla düzenlendi.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);

        try {

            $project->delete();

            $images = Helpers::extractImagesFromEditor($project->description);

            foreach ($images as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }

            if (Storage::disk('public')->exists($project->image)) {
                Storage::disk('public')->delete($project->image);
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
            return redirect()->back()->with('error', "Bir hata oluştu.");
        }

        return redirect()->route('admin.projects.index')->withSuccess("Proje başarıyla silindi.");
    }

    public function fileUpload(Request $request)
    {
        $response = ImageService::upload($request->file('file'), 'images/projects/content', 800);

        return response()->json(['location' => Storage::url($response)]);
    }
}
