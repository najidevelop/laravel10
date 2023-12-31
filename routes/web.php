<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LangController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Post\CategoryController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Media\MediaImageController;
use App\Http\Controllers\Admin\LanguageController;
//use App\Http\Controllers\Language\LanguageController;
use App\Http\Middleware\Role\AdminRole;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Route::get('cpanel/users', [AdminController::class, 'showUsers']);
   
Route::get('lang/change/{lang}', [LangController::class, 'change']);
Route::get('lang/getLang', [LangController::class, 'getLang']);
//Route::get('cpanel', [AdminController::class, 'index']);

 
Route::get('/dashboard', function () {
     return view('dashboard');
   // Route::get('', [AdminController::class, 'index']);
})->middleware(['auth', 'verified'])->name('dashboard');
 

//cpanel
Route::middleware(['role.admin','auth', 'verified'])-> prefix('cpanel')->group(function () {
 //Route::prefix('cpanel')->group(function () {
     Route::get('', [AdminController::class, 'index']);
    //Users
Route::prefix('/users')->group(function () {
    Route::get('/view', [UserController::class, 'index'])->name('cpanel.users.view');
    Route::get('/add', [UserController::class, 'create']);
    Route::post('/store', [UserController::class, 'store']);
    Route::get('/edit/{userid}', [UserController::class, 'edit']);
    Route::post('/update/{userid}', [UserController::class, 'update']);
    Route::get('/delete/{userid}', [UserController::class, 'destroy']);

});
    //CATEGORY cpanel/category
Route::prefix('/category')->group(function () {
    Route::get('/view', [CategoryController::class, 'index'])->name('cpanel.category.view');
    Route::get('/add', [CategoryController::class, 'create']);
    Route::post('/store', [CategoryController::class, 'store']);
    Route::get('/edit/{itemid}', [CategoryController::class, 'edit']);
    Route::post('/update/{itemid}', [CategoryController::class, 'update']);
    Route::get('/delete/{itemid}', [CategoryController::class, 'destroy']);
    Route::get('/sort', [CategoryController::class, 'sort']);
    Route::post('/updatesort/{itemid}', [CategoryController::class, 'updatesort'])->name('cpanel.category.updatesort');
    Route::get('/getsortbyid/{itemid}', [CategoryController::class, 'getsortbyid']);
    Route::get('/trans/{itemid}/{lang}', [CategoryController::class, 'trans']);
    Route::post('/storetrans/{itemid}/{lang}', [CategoryController::class, 'storeupdatetrans']);
});

    //Post cpanel/post
    Route::prefix('/post')->group(function () {
        Route::get('/view', [PostController::class, 'index'])->name('cpanel.post.view');
        Route::get('/add', [PostController::class, 'create']);
        Route::post('/store', [PostController::class, 'store']);
        Route::get('/edit/{itemid}', [PostController::class, 'edit']);
        Route::post('/update/{itemid}', [PostController::class, 'update']);
        Route::get('/delete/{itemid}', [PostController::class, 'destroy']);
        Route::get('/sort', [PostController::class, 'sort']);
        Route::post('/updatesort/{itemid}', [PostController::class, 'updatesort'])->name('cpanel.post.updatesort');
        Route::get('/getsortbyid/{itemid}', [PostController::class, 'getsortbyid']) ;
        Route::get('/search', [PostController::class, 'search'])->name('cpanel.post.search');
        Route::get('/trans/{itemid}/{lang}', [PostController::class, 'trans']);
        Route::post('/storetrans/{itemid}/{lang}', [PostController::class, 'storeupdatetrans']);
    });
       //Media cpanel/media
       Route::prefix('/media')->group(function () {
        Route::get('/view', [MediaImageController::class, 'index'])->name('cpanel.media.view');
        Route::get('/add', [MediaImageController::class, 'create']);
        Route::post('/store', [MediaImageController::class, 'store']);
        Route::get('/edit/{itemid}', [MediaImageController::class, 'edit']);
        Route::post('/update/{itemid}', [MediaImageController::class, 'update']);
        Route::get('/delete/{itemid}', [MediaImageController::class, 'destroy']);
        Route::get('/search', [MediaImageController::class, 'search'])->name('cpanel.media.search');
    
       
    });
//Media cpanel/language
    Route::prefix('/language')->group(function () {
        Route::get('/view', [LanguageController::class, 'index'])->name('cpanel.language.view');
        Route::get('/add', [LanguageController::class, 'create']);
        Route::post('/store', [LanguageController::class, 'store']);
        Route::get('/edit/{itemid}', [LanguageController::class, 'edit']);
        Route::post('/update/{itemid}', [LanguageController::class, 'update']);
        Route::get('/delete/{itemid}', [LanguageController::class, 'destroy']);
        Route::get('/search', [LanguageController::class, 'search'])->name('cpanel.language.search');
        Route::get('/sort', [LanguageController::class, 'sort']);
        Route::post('/updatesort', [LanguageController::class, 'updatesort'])->name('cpanel.language.updatesort');
        Route::get('/getsort', [LanguageController::class, 'getsort']) ;
  
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
require __DIR__.'/auth.php';
 