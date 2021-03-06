<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\KoperasiController;
use App\Http\Controllers\CooperativeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ChatController;
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
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('cooperative-register', [KoperasiController::class, 'create'])->name('koperasi.create');
Route::post('cooperative-register', [KoperasiController::class, 'store'])->name('koperasi.store');

Route::post('directory-village', [DirectoryController::class, 'village'])->name('directory-village');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('dashboard', DashboardController::class);

    Route::view('profile', 'profile')->name('profile');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('web', WebController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
    
    Route::resource('post', PostController::class);
    
    Route::get('single-post', [PostController::class, 'single'])->name('post.single');
    Route::resource('chat', ChatController::class);
    
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
    
    Route::post('copperative-filter', [CooperativeController::class, 'index'])->name('copperative.filter');
    Route::post('users-filter', [UserController::class, 'index'])->name('users.filter');

    Route::post('post', [PostController::class, 'index'])->name('post.filter-category');
    Route::post('post-store', [PostController::class, 'store'])->name('post.post-store');
    Route::post('post-comment-store', [PostController::class, 'commentStore'])->name('post.comment-store');
    Route::post('post-comment-delete', [PostController::class, 'commentDelete'])->name('post.comment-delete');
    Route::post('post-delete', [PostController::class, 'postDelete'])->name('post.post-delete');
    
    Route::middleware(['admin'])->group(function () {
        //Pengguna
        Route::resource('users', UserController::class);
        Route::post('users-delete', [UserController::class, 'userDelete'])->name('users.user-delete');
        Route::post('users-verifikasi', [UserController::class, 'userVerifikasi'])->name('users.user-verifikasi');
        
        //Koperasi
        Route::resource('cooperative', CooperativeController::class);
        Route::post('cooperative', [CooperativeController::class, 'index'])->name('cooperative.filter-kecamatan');
        Route::post('cooperative-store', [CooperativeController::class, 'store'])->name('cooperative.cooperative-store');
        Route::post('cooperative-delete', [CooperativeController::class, 'cooperativeDelete'])->name('cooperative.cooperative-delete');
        Route::post('cooperative-verifikasi', [CooperativeController::class, 'cooperativeVerifikasi'])->name('cooperative.cooperative-verifikasi');
    });
    
    Route::post('change-password', [UserController::class, 'changePassword'])->name('users.change-password');
    Route::get('setting', [UserController::class, 'setting'])->name('users.setting');
    

});

require __DIR__.'/auth.php';
