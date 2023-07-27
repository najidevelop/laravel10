<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LangController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Post\CategoryController;
use App\Http\Controllers\Post\PostController;
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
});

    //Post cpanel/post
    Route::prefix('/post')->group(function () {
        Route::get('/view', [CategoryController::class, 'index'])->name('cpanel.post.view');
        Route::get('/add', [CategoryController::class, 'create']);
        Route::post('/store', [CategoryController::class, 'store']);
        Route::get('/edit/{itemid}', [CategoryController::class, 'edit']);
        Route::post('/update/{itemid}', [CategoryController::class, 'update']);
        Route::get('/delete/{itemid}', [CategoryController::class, 'destroy']);
        Route::get('/sort', [CategoryController::class, 'sort']);
        Route::post('/updatesort/{itemid}', [CategoryController::class, 'updatesort'])->name('cpanel.post.updatesort');;
        Route::get('/getsortbyid/{itemid}', [CategoryController::class, 'getsortbyid']) ;
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
require __DIR__.'/auth.php';
 