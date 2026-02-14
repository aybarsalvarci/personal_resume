<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class SiteMapController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', 'published')->get();
        return response()->view('sitemap.index', compact('blogs'))->header('Content-Type', 'text/xml');
    }
}
