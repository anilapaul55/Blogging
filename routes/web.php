<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::prefix('Admin')->middleware(['auth'])->group(function () {
Route::middleware(['auth'])->group(function () {
    // Route::get('/home', [AdminController::class, 'index'])->name('home');
    Route::resource('category', CategoryController::Class); 
    Route::get('list_cat', [CategoryController::Class, 'list_cat'])->name('list_cat');
    Route::get('list_blog', [BlogController::Class, 'list_blog'])->name('list_blog');
    Route::get('list', [UserController::Class, 'list'])->name('list');
    Route::resource('blog', BlogController::Class);
    Route::resource('user', UserController::Class);
});