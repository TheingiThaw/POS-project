<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\admin\PasswordController;

Route::group(['middleware'=>'authMiddleware'],function(){
    Route::group(['prefix'=>'admin', 'middleware' => 'admin'],function(){

        Route::get('dashboard', [AdminController::class,'homePage'])->name('admin#dashboard');
        Route::get('saleInfo', [AdminController::class,'saleInformation'])->name('sale#information');

        Route::group(['prefix' => 'category'], function(){
            Route::get('list',[CategoryController::class,'list'])->name('category#list');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('edit/{id}',[CategoryController::class, 'edit'])->name('category#edit');
            Route::post('update/{id}',[CategoryController::class, 'update'])->name('category#update');
            Route::get('delete/{id}',[CategoryController::class, 'delete'])->name('category#delete');
        });
        Route::group(['prefix' => 'product'],function(){
            Route::get('list/{action?}',[ProductController::class,'list'])->name('product#list');
            Route::get('createPage',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('create', [ProductController::class, 'create'])->name('product#create');
            Route::get('edit/{id}',[ProductController::class, 'edit'])->name('product#edit');
            Route::post('update/{id}',[ProductController::class,'update'])->name('product#update');
            Route::get('delete/{id}',[ProductController::class, 'delete'])->name('product#delete');
            Route::get('seemore/{id}',[ProductController::class, 'seemore'])->name('product#seemore');
        });
        Route::group(['prefix'=>'profile'],function(){
            Route::get('edit', [AdminController::class, 'edit'])->name('profile#edit');
            Route::get('navigateChangePassword', [PasswordController::class, 'navigateChangePassword'])->name('profile#navigateChangePassword');
            Route::post('changePassword', [PasswordController::class, 'changePassword'])->name('profile#changePassword');
            Route::get('{name?}', [AdminController::class, 'navigate'])->name('profile#view');
            Route::post('update',[AdminController::class,'update'])->name('profile#update');

        });
        Route::group(['middleware'=>'superadmin'],function(){
            Route::group(['prefix','account'],function(){
                Route::get('new',[AdminController::class,'newAdmin'])->name('admin#new');
                Route::post('create',[AdminController::class,'create'])->name('admin#create');
            });

            Route::get('adminList',[AdminController::class,'adminlist'])->name('admin#list');
            Route::get('userList',[AdminController::class,'userlist'])->name('user#list');

            Route::group(['prefix'=>'payment'],function(){
                Route::get('paymentlist',[PaymentController::class,'list'])->name('payment#list');
                Route::post('newpayment',[PaymentController::class,'createPayment'])->name('payment#create');
                Route::get('edit/{id}',[PaymentController::class, 'edit'])->name('payment#edit');
                Route::post('update/{id}',[PaymentController::class,'update'])->name('payment#update');
                Route::get('delete',[PaymentController::class, 'delete'])->name('payment#delete');
                });
        });

        Route::group(['prefix' => 'order'],function(){
            Route::get('list', [AdminController::class, 'orderList'])->name('order#list');
            Route::get('detail/{orderCode}', [AdminController::class, 'orderDetail'])->name('order#detail');
            Route::get('reject', [AdminController::class, 'orderReject'])->name('order#reject');
            Route::get('confirm', [AdminController::class, 'orderConfirm'])->name('order#confirm');

            Route::get('status/onchange', [AdminController::class,'statusOnChange'])->name('status#onchange');
        });


    });
});
