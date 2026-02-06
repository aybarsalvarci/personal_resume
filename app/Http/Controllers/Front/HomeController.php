<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\CreateRequest;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function home()
    {
        $projects = Project::where('isFeatured', true)
            ->orderBy('created_at', 'desc')
            ->limit(2)
            ->get();

        $blogs = Blog::where('isFeatured', true)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('front.homepage', compact('projects', 'blogs'));
    }

    public function projects()
    {
        $categories = ProjectCategory::orderBy('order', 'ASC')->get();
        $projects = Project::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('front.projects', compact('projects', 'categories'));
    }

    public function getProjects(string $slug, int $count = 0)
    {

        $query = Project::query();

        if($slug != 'all')
        {
            $category = ProjectCategory::where('slug', $slug)->firstOrFail();
            $query->where('category_id', $category->id);
        }

        $projects = $query->orderBy('created_at', 'DESC')
            ->skip($count)
            ->take(4)
            ->get();

        $view = view('front.partials.project-list', compact('projects'))->render();
        return response()->json(['html' => $view]);
    }

    public function contact(CreateRequest $request)
    {
        try{
            Contact::create($request->validated());
        }
        catch(\Exception $e)
        {
            Log::error("İletişim formunda bir hata oluştu: " . $e->getMessage(), $e->getTrace());
            return response(500);
        }

        return response(200);
    }
}
