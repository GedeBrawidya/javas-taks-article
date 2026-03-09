<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth', \App\Http\Middleware\IsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard'); 
        })->name('dashboard');

        Route::prefix('users')
            ->name('users.')
            ->controller(UserController::class)
            ->group(function () {
                Route::get('', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('', 'store')->name('store');
                Route::get('{user}/edit', 'edit')->name('edit');
                Route::put('{user}','update')->name('update');
                Route::delete('{user}', 'destroy')->name('destroy');
            });

        Route::prefix('categories')
            ->controller(CategoryController::class)
            ->group(function () {
                Route::get('', 'index')->name('categories.index');
                Route::get('create','create')->name('categories.create');
                Route::post('', 'store')->name('categories.store');
                Route::get('{category}/edit', 'edit')->name('categories.edit');
                Route::put('{category}', 'update')->name('categories.update');
                Route::delete('/{category}', 'destroy')->name('categories.destroy');
            });

        Route::prefix('tags')
            ->controller(TagController::class)
            ->group(function () {
                Route::get('', 'index')->name('tags.index');
                Route::get('create','create')->name('tags.create');
                Route::post('', 'store')->name('tags.store');
                Route::get('{tag}/edit', 'edit')->name('tags.edit');
                Route::put('{tag}', 'update')->name('tags.update');
                Route::delete('/{tag}', 'destroy')->name('tags.destroy');
            });

        Route::prefix('articles')
            ->controller(ArticleController::class)
            ->group(function () {
                Route::get('', 'index')->name('articles.index');
                Route::get('create','create')->name('articles.create');
                Route::post('', 'store')->name('articles.store');
                Route::get('{article}/edit', 'edit')->name('articles.edit');
                Route::put('{article}', 'update')->name('articles.update');
                Route::delete('/{article}', 'destroy')->name('articles.destroy');
            });
    

});