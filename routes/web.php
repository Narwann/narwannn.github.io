<?php

use App\Models\post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\DashboardCategoryController;

use GuzzleHttp\Middleware;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route :: get('/', function () {
    return view('home',[
    "title" => "Home",
    "active"=> "home",
    ]);
});

Route :: get('/about', function () {
    return view('About',[    
    "title"=> "About",
    "active"=> "about",
    "name" => "narwan nahrudin",
    "email"=> "Narwannahrudin11@gmail.com",
    "image"=> "ibo.jpg"]);
});


Route :: get('/posts',[PostController::class,'index']);

//halaman Single Post
route :: get('posts/{post:slug}', [PostController::class,'show']);

route :: get('/categories', function(){
    return view('categories',[
        'title'=> 'Post Categories',
        'active'=>'categories',
        'categories'=>Category::all()
    ]);
});

route :: get('/login', [LoginController::class,'index'])->name('login')->middleware('guest');
route :: post('/login', [LoginController::class,'authenticate']);


Route :: get('/register',[RegisterController::class,'index'])->middleware('guest');

Route :: post('/register',[RegisterController::class,'store']);


Route :: get('/dashboard',function (){
    return view('dashboard.index');
})->middleware('auth');


route :: post('logout', [LoginController::class,'logout']);


Route :: get('/dashboard/posts/checkSlug',[DashboardPostController:: class, 'checkSlug'])->Middleware('auth');
Route :: resource('/dashboard/posts', DashboardPostController::class)->Middleware('auth');
route :: resource('/dashboard/categories', AdminCategoryController:: class)->except('show')->middleware('admin');
