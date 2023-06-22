<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\RepresentativeController;

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

Route::middleware(['auth','verified'])->group(function () {
    //Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');//
    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');//
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');//
    Route::get('/myPage',[MyPageController::class,'myPage'])->name('myPage');
    Route::post('/reserveAdd',[ReserveController::class,'reserveAdd'])->name('reserveAdd');
    Route::post('/reserveDelete',[ReserveController::class,'reserveDelete'])->name('reserveDelete');
    Route::post('/reserveUpdate',[ReserveController::class,'reserveUpdate'])->name('reserveUpdate');
    Route::post('/favoriteStore',[FavoriteController::class,'favoriteStore'])->name('favoriteStore');
    Route::post('/favoriteDelete',[FavoriteController::class,'favoriteDelete'])->name('favoriteDelete');
});

Route::group(['middleware' => ['auth', 'can:admin_only']], function () {
    Route::get('/accountIndex', [AccountController::class,'accountIndex'])->name('accountIndex');
    Route::get('/accountSearch', [AccountController::class,'accountSearch'])->name('accountSearch');
    Route::post('/accountDelete', [AccountController::class,'accountDelete'])->name('accountDelete');
    Route::post('/representativeAdd', [RepresentativeController::class,'representativeAdd'])->name('representativeAdd');
    Route::post('/representativeDelete', [RepresentativeController::class,'representativeDelete'])->name('representativeDelete');
    Route::get('/representativeSearch', [RepresentativeController::class,'representativeSearch'])->name('representativeSearch');
});

Route::group(['middleware' => ['auth', 'can:manager_admin']], function () {
    Route::get('/managementIndex', [ManagementController::class,'managementIndex'])->name('managementIndex');
    Route::get('/representativeShop', [ManagementController::class,'representativeShop'])->name('representativeShop');
    Route::get('/shopUpdateIndex', [ManagementController::class,'shopUpdateIndex'])->name('shopUpdateIndex');
    Route::get('/shopReserve', [ManagementController::class,'shopReserve'])->name('shopReserve');
    Route::post('/shopCreate', [ManagementController::class,'shopCreate'])->name('shopCreate');
    Route::post('/shopUpdate', [ManagementController::class,'shopUpdate'])->name('shopUpdate');
    Route::get('/informMail', [ManagementController::class,'informMail'])->name('informMail');
});

require __DIR__.'/auth.php';
