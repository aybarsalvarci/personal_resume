<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\CreateRequest;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Contact;
use App\Models\HomePage;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
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
            ->with(['category' => function ($query) {
                $query->select('name', 'id');
            }])
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        $homePageSettings = HomePage::firstOrFail();

        return view('front.homepage', compact('projects', 'blogs', 'homePageSettings'));
    }

    public function projects(Request $request)
    {
        $categories = ProjectCategory::orderBy('order', 'ASC')->get();

        $projects = Project::with(['category' => fn($q) => $q->select('id', 'name')])
            //keyword filter
            ->when($request->filled('keyword'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->keyword . '%')
                        ->orWhere('slug', 'like', '%' . $request->keyword . '%')
                        ->orWhere('description', 'like', '%' . $request->keyword . '%');
                });
            })

            // category filter
            ->when($request->filled('category') and $request->get('category') != 'all', function ($query) use ($request) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('slug', $request->get('category'));
                });
            })

            // status filter
            ->when($request->filled('status') and $request->get('status') != 'all', function ($query) use ($request) {
                    $query->where('status', $request->status);
            })

            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('front.projects', compact('projects', 'categories'));
    }

    public function blogs(Request $request)
    {
        $categories = BlogCategory::withCount('blogs')->orderBy('order', 'ASC')->get();

        $totalCount = Blog::count();

        $blogs = Blog::with(['category' => fn($q) => $q->select('id', 'name')])
            ->when($request->has('keyword'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('title', 'like', '%' . $request->keyword . '%')
                        ->orWhere('content', 'like', '%' . $request->keyword . '%')
                        ->orWhere('slug', 'like', '%' . $request->keyword . '%');
                });
            })
            ->when($request->has('category') and $request->get('category') != 'all', function ($query) use ($request) {
                $query->where('category_id', $request->category);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('front.blogs', compact('blogs', 'categories', 'totalCount'));
    }

    public function blogDetail(string $slug)
    {
        $blog = Blog::whereSlug($slug)->firstOrFail();
        return view('front.blog-detail', compact('blog'));
    }

    public function contact(CreateRequest $request)
    {
        try {
            Contact::create($request->validated());
        } catch (\Exception $e) {
            Log::error("İletişim formunda bir hata oluştu: " . $e->getMessage(), $e->getTrace());
            return response(500);
        }

        return response(200);
    }
}
