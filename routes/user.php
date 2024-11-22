<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\admin\PasswordController;

Route::group( ['prefix'=>'user', 'middleware' => 'customer'] , function(){

    Route::get('home', [UserController::class,'userHome'])->name('user#home');
    Route::get('edit', [UserController::class,'edit'])->name('user#edit');
    Route::post('update', [UserController::class,'update'])->name('user#update');
    Route::get('navigate/changePassword', [UserController::class, 'navigateChangePassword'])->name('user#navigateChangePassword');
    Route::post('changePassword', [PasswordController::class, 'changePassword'])->name('user#changePassword');
    Route::get('contact', [UserController::class,'contact'])->name('user#contact');
    Route::post('contact/submit', [UserController::class,'contactSubmit'])->name('contact#submit');
    Route::get('cart', [UserController::class,'cart'])->name('user#cart');

    Route::group(['prefix' => 'order'], function(){
        Route::post('addToCart', [OrderController::class, 'addToCart'])->name('user#addToCart');
        Route::get('cart/delete', [OrderController::class,'cartDelete'])->name('cart#delete');
        Route::get('tempStorage', [OrderController::class, 'tempStorage'])->name('user#tempStorage');
        Route::get('paymentPage', [OrderController::class, 'paymentPage'])->name('user#paymentPage');
        Route::post('payment', [OrderController::class, 'payment'])->name('user#payment');
        Route::get('list', [OrderController::class,'orderList'])->name('user#orderList');
    });

    Route::group(['prefix' => 'product'], function(){
        Route::get('details/{id}', [ProductController::class, 'details'])->name('product#details');
        Route::post('comment', [ProductController::class,'comment'])->name('product#comment');
        Route::post('rate', [ProductController::class,'rate'])->name('product#rate');
    });
});
