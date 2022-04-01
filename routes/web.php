<?php

// Route
use Illuminate\Support\Facades\Route;

// Livewire Components (For Admin)
use App\Http\Livewire\Admin\Pages\Dashboard;
use App\Http\Livewire\Admin\Pages\Profile;
use App\Http\Livewire\Admin\Pages\Users;
use App\Http\Livewire\Admin\Pages\Products;
use App\Http\Livewire\Admin\Pages\Category;
use App\Http\Livewire\Admin\Pages\Posts;
use App\Http\Livewire\Admin\Pages\Comments;
use App\Http\Livewire\Admin\Pages\Login;
use App\Http\Livewire\Admin\Pages\Messages;
use App\Http\Livewire\Admin\Pages\Notifications;
// Livewire Components (For Site)
use App\Http\Livewire\Site\Pages\Home;

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

/* Website
#############*/
Route::name('site.')->group(function() {
    // Guest
    Route::middleware('guest:web')->group(function() {
        Route::get('/', Home::class);
    });

    // Auth
    Route::middleware('auth:web')->group(function() {
        // 
    });
});


/* Admin Panel
##############*/
Route::prefix('admin')->name('admin.')->group(function() {

    // Guest
    Route::middleware('guest:admin')->group(function() {
        Route::get('/login', Login::class)->name('login');
    });

    // Auth
    Route::middleware('auth:admin')->group(function() {

        // Main
        Route::get('/dashboard', Dashboard::class)->name('dashboard');
        Route::get('/profile', Profile::class)->name('profile');
        Route::get('/users', Users::class)->name('users');
        Route::get('/products', Products::class)->name('products');

        // Blog
        Route::get('/categories', Category::class)->name('categories');
        Route::get('/posts', Posts::class)->name('posts');
        Route::get('/comments', Comments::class)->name('comments');

        // Views
        Route::view('/blank', 'livewire.admin.helpers.blank')->name('blank');

        // Notifications & Messages
        Route::get('/notifications', Notifications::class)->name('notifications');
        Route::get('/messages', Messages::class)->name('messages');

        // Components & Helpers
        Route::view('/icons', 'livewire.admin.helpers.icons')->name('icons');
        Route::view('/buttons', 'livewire.admin.helpers.buttons')->name('buttons');
        Route::view('/cards', 'livewire.admin.helpers.cards')->name('cards');
        Route::view('/forms', 'livewire.admin.helpers.forms')->name('forms');
        Route::view('/typography', 'livewire.admin.helpers.typography')->name('typography');
    });
});