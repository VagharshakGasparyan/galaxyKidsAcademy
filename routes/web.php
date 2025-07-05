<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\AdminPhotoController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\AdminTranslationController;
use App\Http\Controllers\AdminUsersController;
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

        //-----------------------------------Account-begin-----------------------------------------------------------------
        Route::get('/account', [AdminController::class, 'account'])->name('admin.account');
        Route::post('/account/update', [AdminController::class, 'accountPostUpdate'])->name('admin.account.update');
        Route::post('/account/update-password', [AdminController::class, 'accountPostUpdatePassword'])->name('admin.account.update_password');
        //-----------------------------------Account-end-------------------------------------------------------------------
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
        Route::get('/logs/show/{name}', [AdminSettingsController::class, 'logsShow'])->name('admin.logs.show');
        Route::delete('/logs/delete/{name}', [AdminSettingsController::class, 'logsDelete'])->name('admin.logs.delete');
        //-----------------------------------Settings-end---------------------------------------------------------------
        //-----------------------------------Users-begin----------------------------------------------------------------
        Route::get('/users', [AdminUsersController::class, 'index'])->name('admin.users');
        Route::get('/users/create', [AdminUsersController::class, 'create'])->name('admin.users.create');
        Route::post('/users/create', [AdminUsersController::class, 'postCreate'])->name('admin.users.postCreate');
        Route::get('/users/update/{id}', [AdminUsersController::class, 'update'])->name('admin.users.update');
        Route::post('/users/update/{id}', [AdminUsersController::class, 'postUpdate'])->name('admin.users.postUpdate');
        Route::get('/users/show/{id}', [AdminUsersController::class, 'show'])->name('admin.users.show');
        Route::delete('/users/delete/{id}', [AdminUsersController::class, 'delete'])->name('admin.users.delete');
        //-----------------------------------Users-end------------------------------------------------------------------
        //-----------------------------------Translations-begin---------------------------------------------------------
        Route::get('/translations', [AdminTranslationController::class, 'index'])->name('admin.translations');
        Route::post('/translations/save', [AdminTranslationController::class, 'save'])->name('admin.translations.save');
        Route::post('/translations/bulk-save', [AdminTranslationController::class, 'bulkSave'])->name('admin.translations.bulk_save');
        Route::post('/translations/put-keys', [AdminTranslationController::class, 'putKeys'])->name('admin.translations.put_keys');
        //-----------------------------------Translations-end-----------------------------------------------------------
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
    Route::get('/about-us', [PageController::class, 'aboutUs'])->name('about_us');
    Route::get('/admissions', [PageController::class, 'admissions'])->name('admissions');
    Route::get('/contact-us', [PageController::class, 'contactUs'])->name('contact_us');
    Route::get('/our-programs', [PageController::class, 'ourPrograms'])->name('our_programs');
    Route::get('/parents-corner', [PageController::class, 'parentsCorner'])->name('parents_corner');
    Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy_policy');
    Route::get('/tuitions-fees', [PageController::class, 'tuitionsFees'])->name('tuitions_fees');

    Route::get('/{slug}/{subs?}', [PageController::class, 'page'])->name('page');
});


