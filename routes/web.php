<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\FavoriteController;

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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/thanksRegister', function () {return view('/thanksRegister');});
Route::get('/thanksReserve', function () {return view('/thanksReserve');});

Route::get('/',[ShopController::class,'index'])->name('index');
Route::get('/detail/{id}',[ShopController::class,'detail'])->name('detail');
Route::get('/search',[SearchController::class,'search'])->name('search');

//Route::get('/dashboard', function () {//
//    return view('dashboard');//
//})->middleware(['auth', 'verified'])->name('dashboard');//

Route::middleware('auth')->group(function () {
    //Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');//
    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');//
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');//
    Route::get('/myPage',[MyPageController::class,'myPage'])->name('myPage');
    Route::post('/reserveAdd',[ReserveController::class,'reserveAdd'])->name('reserveAdd');
    Route::post('/reserveDelete',[ReserveController::class,'reserveDelete'])->name('reserveDelete');
    Route::post('/favoriteStore',[FavoriteController::class,'favoriteStore'])->name('favoriteStore');
    Route::post('/favoriteDelete',[FavoriteController::class,'favoriteDelete'])->name('favoriteDelete');
    Route::post('/favoriteDeleteMyPage',[FavoriteController::class,'favoriteDeleteMyPage'])->name('favoriteDeleteMyPage');
});

require __DIR__.'/auth.php';
