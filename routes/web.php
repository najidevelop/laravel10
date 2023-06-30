<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LangController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
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
Route::get('cpanel', [AdminController::class, 'index']);

//cpanel
Route::prefix('cpanel')->group(function () {
    Route::get('', [AdminController::class, 'index']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Users
Route::prefix('/users')->group(function () {
    Route::get('/view', [UserController::class, 'index'])->name('cpanel.users.view');
    Route::get('/add', [UserController::class, 'create']);
    Route::post('/store', [UserController::class, 'store']);
    Route::get('/edit/{userid}', [UserController::class, 'edit']);
    Route::post('/update/{userid}', [UserController::class, 'update']);
    Route::get('/delete/{userid}', [UserController::class, 'destroy']);
});
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
require __DIR__.'/auth.php';
 