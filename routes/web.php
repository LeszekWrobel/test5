<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

Route::get('/', function () {
     $posts = App\Models\Post::all();
     return view('welcome', compact('posts'));
   // return view('welcome');
});
*/
Route::get('/', [App\Http\Controllers\PostsController::class, 'index'])->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/', [App\Http\Controllers\PostsController::class, 'index']);//->name('home');
