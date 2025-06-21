<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\AdminPhotoController;
use App\Http\Controllers\AdminSettingsController;
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
        //-----------------------------------Photo-begin----------------------------------------------------------------
        Route::get('/photos', [AdminPhotoController::class, 'index'])->name('admin.photos');
        Route::get('/photos/create', [AdminPhotoController::class, 'create'])->name('admin.photos.create');
        Route::post('/photos/create', [AdminPhotoController::class, 'postCreate'])->name('admin.photos.postCreate');
        Route::get('/photos/update/{id}', [AdminPhotoController::class, 'update'])->name('admin.photos.update');
        Route::post('/photos/update/{id}', [AdminPhotoController::class, 'postUpdate'])->name('admin.photos.postUpdate');
        Route::get('/photos/show/{id}', [AdminPhotoController::class, 'show'])->name('admin.photos.show');
        Route::delete('/photos/delete/{id}', [AdminPhotoController::class, 'delete'])->name('admin.photos.delete');
        //-----------------------------------Photo-end------------------------------------------------------------------
        //-----------------------------------Main Menu-begin------------------------------------------------------------
        Route::get('/main-menu', [AdminMenuController::class, 'index'])->name('admin.main_menu');
        Route::get('/main-menu/create', [AdminMenuController::class, 'create'])->name('admin.main_menu.create');
        Route::post('/main-menu/create', [AdminMenuController::class, 'postCreate'])->name('admin.main_menu.postCreate');
        Route::get('/main-menu/update/{id}', [AdminMenuController::class, 'update'])->name('admin.main_menu.update');
        Route::post('/main-menu/update/{id}', [AdminMenuController::class, 'postUpdate'])->name('admin.main_menu.postUpdate');
        Route::delete('/main-menu/delete/{id}', [AdminMenuController::class, 'delete'])->name('admin.main_menu.delete');
        Route::post('/main-menu-reorder', [AdminMenuController::class, 'reorder'])->name('admin.main_menu.reorder');
        //-----------------------------------Main Menu-end--------------------------------------------------------------
        //-----------------------------------Settings-begin-------------------------------------------------------------
        Route::get('/settings', [AdminSettingsController::class, 'index'])->name('admin.settings');
        Route::post('/settings', [AdminSettingsController::class, 'postUpdate'])->name('admin.settings.postUpdate');
        Route::get('/logs', [AdminSettingsController::class, 'logs'])->name('admin.logs');
        //-----------------------------------Settings-end---------------------------------------------------------------
    });
});

Route::group([
    'prefix' =>
//        LaravelLocalization::setLocale(),
        '{locale?}',
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', LocaleMiddleware::class],
], function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');


    Route::get('/{slug}/{subs?}', [PageController::class, 'page'])->name('page');
});



