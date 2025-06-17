<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\PageController;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Middleware\LocaleMiddleware;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::post('/logging', [AdminController::class, 'logging'])->name('admin.logging');
    Route::group(['middleware' => [AdminAuthMiddleware::class]], function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        //-----------------------------------Menu-begin-----------------------------------------------------------------
        Route::get('/menu', [AdminMenuController::class, 'index'])->name('admin.menu');
        //-----------------------------------Menu-end-------------------------------------------------------------------
        //-----------------------------------Page-begin-----------------------------------------------------------------
        Route::get('/pages', [AdminPageController::class, 'index'])->name('admin.pages');
        Route::get('/pages/create', [AdminPageController::class, 'create'])->name('admin.pages.create');
        Route::post('/pages/create', [AdminPageController::class, 'postCreate'])->name('admin.pages.postCreate');
        Route::get('/pages/update/{id}', [AdminPageController::class, 'update'])->name('admin.pages.update');
        Route::post('/pages/update/{id}', [AdminPageController::class, 'postUpdate'])->name('admin.pages.postUpdate');
        Route::get('/pages/show/{id}', [AdminPageController::class, 'show'])->name('admin.pages.show');
        Route::delete('/pages/delete/{id}', [AdminPageController::class, 'delete'])->name('admin.pages.delete');
        //-----------------------------------Page-end-------------------------------------------------------------------
    });
});

Route::group([
    'prefix' =>
//        LaravelLocalization::setLocale(),
        '{locale?}',
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', LocaleMiddleware::class],
], function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/home', [PageController::class, 'home'])->name('homeros');


    Route::get('/{slug}/{subs?}', [PageController::class, 'page'])->name('page');
});



