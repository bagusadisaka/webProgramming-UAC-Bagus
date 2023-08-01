<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Models\games;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('Register.login');
});

Route::middleware(['auth', 'web'])->group(function () {

    Route::get('/home', [ProductsController::class,'showproducts'])->name('home');


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::get('/checkout/{id}', [ProductsController::class,'productdetails']);

    Route::post('/filtering',[ProductsController::class,'filtering']);
    Route::get('/ecommerce',[ProductsController::class,'dataecommerce']);
    Route::post('/transaction/{id}',[TransactionController::class,'transactions']);
    Route::get('/buytransaction',[TransactionController::class,'buytransactions']);
    Route::get('/admin',function(){
        return view('adminmenu');
    });

    Route::get('/banned',function(){
        return view('banned');
    });
});

Route::get('/usermanagement',[AdminController::class,'usertable']);
Route::post('/updatedata/{id}',[AdminController::class,'updatedata']);
Route::get('/updatedata/{id}',[AdminController::class,'updatedata']);
