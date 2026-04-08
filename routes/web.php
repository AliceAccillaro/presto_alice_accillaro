<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'home'])->name('home');

Route::get('/create/article', [ArticleController::class, 'create'])
    ->middleware('auth')
    ->name('create.article');

Route::get('/article/index', [ArticleController::class, 'index'])
    ->name('article.index');

Route::get('/show/article/{article}', [ArticleController::class, 'show'])
    ->name('article.show');

Route::get('/category/{category}', [ArticleController::class, 'byCategory'])
    ->name('byCategory');

Route::get('/lingua/{lang}', [PublicController::class, 'setLanguage'])
    ->name('setLocale');

Route::middleware(['auth'])->group(function () {
    Route::get('/lavora-con-noi', [RevisorController::class, 'workWithUs'])
        ->name('work.with.us');

    Route::post('/lavora-con-noi', [RevisorController::class, 'sendRevisorRequest'])
        ->name('send.revisor.request');
});

Route::middleware(['auth', 'isRevisor'])->group(function () {
    Route::get('/revisor/index', [RevisorController::class, 'index'])
        ->name('revisor.index');

    Route::patch('/accept/{article}', [RevisorController::class, 'accept'])
        ->name('accept');

    Route::patch('/reject/{article}', [RevisorController::class, 'reject'])
        ->name('reject');

    Route::patch('/revisor/undo', [RevisorController::class, 'undoLastAction'])
        ->name('revisor.undo');
});