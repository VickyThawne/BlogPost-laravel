<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\Catch_;
use PhpParser\Node\Stmt\Foreach_;
use Symfony\Component\Translation\Dumper\YamlFileDumper;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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
  
    return view('posts', [
        'posts' => Post::latest()->get()
    ]);
});

Route::get('posts/{post:slug}', function(Post $post){
    
    return view('post', [
        'post' => $post
    ]);
});

Route::get('categories/{category:slug}', function(Category $category){
    return view('posts', [
        'posts' => $category->posts
    ]);
});

Route::get('author/{author:userName}', function(User $author){  
    return view('posts', [
        'posts' => $author->posts
    ]);
});
