<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\CreateRequest;
use App\Http\Requests\Blog\UpdateRequest;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Services\Helpers;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Blog::query();

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('slug', 'like', '%' . $request->search . '%');
        }

        $blogs = $query
            ->with('category')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::latest()->get();
        return view('admin.blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $data = $request->validated();

        // thumbnail upload
        if ($request->hasFile('image')) {
            try {
                $data['image'] = ImageService::upload($request->file('image'), 'images/blog/thumbnails', 800);
            } catch (\Exception $exception) {
                Log::error("Blog kapak görseli yüklenemedi : " . $exception->getMessage(), $exception->getTrace());
                return redirect()->back()->with('error', "Kapak görseli yüklenirken bir hata oluştu.");
            }
        }

        // create slug
        $data['slug'] = $data['slug'] ? Str::slug($data['slug']) : Str::slug($data['title']);

        // save to db
        try {
            Blog::create($data);
        } catch (\Exception $exception) {
            // delete images in editor if save to db error
            $images = Helpers::extractImagesFromEditor($data['content']);

            foreach ($images as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }

            // delete thumbnail image if save to db error
            if (Storage::disk('public')->exists($data['image'])) {
                Storage::disk('public')->delete($data['image']);
            }

            Log::error("Blog veritabanına kaydedilemedi: " . $exception->getMessage(), $exception->getTrace());
            return redirect()->back()->withInput()->with('error', "Veri tabanına kaydedilemedi.");
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog oluşturuldu.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::with('category')->findOrFail($id);
        $categories = BlogCategory::orderBy('name', 'ASC')->get();
        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $blog = Blog::findOrFail($id);

        $data = $request->validated();

        // thumbnail update
        try {

            if ($request->hasFile('image')) {
                if (Storage::disk('public')->exists($blog->image)) {
                    Storage::disk('public')->delete($blog->image);
                }

                $data['image'] = ImageService::upload($request->file('image'), 'images/blog/thumbnails', 800);
            }
        } catch (\Exception $exception) {
            Log::error("Blog kapak görseli güncellenemedi: " . $exception->getMessage(), $exception->getTrace());
            return redirect()->back()->withInput()->with('error', "Kapak görseli güncellenirken bir hata oluştu.");
        }

        // update content images
        try {

            if ($data['content'] !== $blog->content) {
                $existedImages = Helpers::extractImagesFromEditor($blog->content);
                $contentImages = Helpers::extractImagesFromEditor($data['content']);

                foreach ($existedImages as $image) {
                    if (!in_array($image, $contentImages) && Storage::disk('public')->exists($image)) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }
        } catch (\Exception $exception) {
            Log::error("Blog içerik görselleri güncellenemedi: " . $exception->getMessage(), $exception->getTrace());
            return redirect()->back()->withInput()->with('error', "İçerik görselleri güncellenirken bir hata oluştu.");
        }

        try {
            $blog->update($data);
        } catch (\Exception $exception) {
            Log::error("Blog güncellenirken veritabanı hatası oluştu: " . $exception->getMessage(), $exception->getTrace());
            return redirect()->back()->withInput()->with('error', "Bir veritabanı oluştu.");
        }

        return redirect()->route('admin.blogs.index')->withSuccess("Blog başarıyla güncellendi.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);

        // delete content images
        try {
            $images = Helpers::extractImagesFromEditor($blog->content);
            foreach ($images as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        } catch (\Exception $exception) {
            Log::error("Blog içerik görselleri silinemedi: " . $exception->getMessage(), $exception->getTrace());
            return redirect()->route('admin.blogs.index')->with('error', "İçerikteki görseller silinemedi.");
        }

        // thumbnail delete
        try {


            if (Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }
        } catch (\Exception $exception) {
            Log::error("Blog kapak görseli silinemedi: " . $exception->getMessage(), $exception->getTrace());
            return redirect()->route('admin.blogs.index')->with('error', "Kapak görseli silinemedi.");
        }

        // delete from db
        try {
            $blog->delete();
        } catch (\Exception $exception) {
            Log::error("Blog veritabanından silinemedi: " . $exception->getMessage(), $exception->getTrace());
            return redirect()->route('admin.blogs.index')->with('error', "Veritabanı kaydı silinemedi.");
        }

        return redirect()->route('admin.blogs.index')->withSuccess("Blog başarıyla silindi.");
    }

    public function fileUpload(Request $request)
    {
        $path = ImageService::upload($request->file('file'), 'images/blog/content', 800);
        return response()->json(['location' => asset(Storage::url($path))]);
    }
}
