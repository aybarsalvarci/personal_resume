<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/projects', [HomeController::class, 'projects'])->name('projects');
Route::get('/get-projects/{slug}/{count?}', [HomeController::class, 'getProjects'])->name('get-projects');


Route::prefix('/admin')->name('admin.')->group(function() {
    Route::get("/", [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::post('/projects/file-upload', [ProjectController::class, 'fileUpload'])->name('projects.file-upload');
    Route::resource('/projects', ProjectController::class)->except('show');
});
