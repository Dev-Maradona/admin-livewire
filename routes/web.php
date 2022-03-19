<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Users;
use App\Http\Livewire\Products;
use App\Http\Livewire\Login;

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
    return 'Dashboard works fine in /dashboard';
});

// Dashboard
Route::get('/dashboard', Dashboard::class);
Route::get('/profile', Profile::class);
Route::get('/users', Users::class);
Route::get('/products', Products::class);
Route::get('/login', Login::class);

// Blog
Route::view('/categories', 'categories');
Route::view('/posts', 'posts');
Route::view('/comments', 'comments');

// Views
Route::view('/blank', 'blank');

// Components & Helpers
Route::view('/icons', 'icons');
Route::view('/buttons', 'buttons');
Route::view('/cards', 'cards');
Route::view('/forms', 'forms');
Route::view('/typography', 'typography');