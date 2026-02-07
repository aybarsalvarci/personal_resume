<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;

// ===================== Front Routes =====================
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/projects', [HomeController::class, 'projects'])->name('projects');
Route::get('/get-projects/{slug}/{count?}', [HomeController::class, 'getProjects'])->name('get-projects');
Route::post('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogs');
Route::get('/blog/{slug}', [HomeController::class, 'blogDetail'])->name('blog.detail');

// ===================== Admin Panel Routes =====================
Route::prefix('/admin')->name('admin.')->group(function() {
    Route::get("/", [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::post('/projects/file-upload', [ProjectController::class, 'fileUpload'])->name('projects.file-upload');
    Route::resource('/projects', ProjectController::class)->except('show');

    Route::post('/blogs/file-upload', [BlogController::class, 'fileUpload'])->name('blogs.file-upload');
    Route::resource('/blogs', BlogController::class)->except('show');

    Route::resource('/contacts', ContactController::class)->only('index', 'show', 'destroy');
});

