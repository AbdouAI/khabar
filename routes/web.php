<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SubmissionController;
use App\Http\Middleware\EnsureArticleBelongsToWriter;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureUserIsNotWriter;
use App\Http\Middleware\EnsureUserIsWriter;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'index'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/search', [SearchController::class, 'search'])->withoutMiddleware('auth')->name('search');
    Route::get('/filtre/{filtre}', [SearchController::class, 'filtre'])->withoutMiddleware('auth')->name('filtre');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/articles', [ArticleController::class, 'index'])->name('article.index');
    Route::post('/articles', [ArticleController::class, 'store'])->middleware(EnsureUserIsWriter::class)->name('article.store');
    Route::get('/createArticle', [ArticleController::class, 'create'])->middleware(EnsureUserIsWriter::class)->name('article.create');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->middleware(EnsureUserIsWriter::class)->name('article.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->middleware(EnsureUserIsWriter::class)->name('article.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->middleware(EnsureUserIsWriter::class)->name('article.destroy');
    Route::get('/articles/{article}', [ArticleController::class, 'show'])->withoutMiddleware('auth')->name('article.show');


    Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->withoutMiddleware('auth')->name('comment.store');
    Route::get('/articles/{article}/comments/{comment}/votes/{vote}', [CommentController::class, 'vote'])->withoutMiddleware('auth')->name('comment.vote');


    Route::get('/submissions/create', [SubmissionController::class, 'create'])->middleware(EnsureUserIsNotWriter::class)->name('submission.create');
    Route::post('/submissions', [SubmissionController::class, 'store'])->middleware(EnsureUserIsNotWriter::class)->name('submission.store');
    Route::get('/submissions/{submission}', [SubmissionController::class, 'show'])->middleware(EnsureUserIsAdmin::class)->name('submission.show');
    Route::post('/submissions/{submission}/accept', [SubmissionController::class, 'accept'])->middleware(EnsureUserIsAdmin::class)->name('submission.accept');
    Route::post('/submissions/{submission}/reject', [SubmissionController::class, 'reject'])->middleware(EnsureUserIsAdmin::class)->name('submission.reject');



    Route::get('/adminPannel', [AdminController::class, 'pannel'])->middleware(EnsureUserIsAdmin::class)->name('admin.pannel');
    Route::get('/adminPannel/articles', [AdminController::class, 'articles'])->middleware(EnsureUserIsAdmin::class)->name('admin.articles');
    Route::get('/adminPannel/articles/search', [AdminController::class, 'search'])->middleware(EnsureUserIsAdmin::class)->name('admin.search');



    Route::get('/adminPannel/users', [RegisteredUserController::class, 'index'])->middleware(EnsureUserIsAdmin::class)->name('user.index');
    Route::post('/adminPannel/users/{user}/revokeWriter', [RegisteredUserController::class, 'revokeWriter'])->middleware(EnsureUserIsAdmin::class)->name('user.revokeWriter');
    Route::post('/adminPannel/users/{user}/grantWriter', [RegisteredUserController::class, 'grantWriter'])->middleware(EnsureUserIsAdmin::class)->name('user.grantWriter');
    Route::get('/adminPannel/submissions', [SubmissionController::class, 'index'])->middleware(EnsureUserIsAdmin::class)->name('submission.index');

    Route::get('/adminPannel/categories', [CategoryController::class, 'index'])->middleware(EnsureUserIsAdmin::class)->name('category.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->middleware(EnsureUserIsAdmin::class)->name('category.create');
    Route::post('/categories', [CategoryController::class, 'store'])->middleware(EnsureUserIsAdmin::class)->name('category.store');
    Route::delete('/adminPannel/categories/{category}', [CategoryController::class, 'destroy'])->middleware(EnsureUserIsAdmin::class)->name('category.destroy');
    Route::delete('/adminPannel/users/{user}', [ProfileController::class, 'destroy'])->name('user.destroy');


});

require __DIR__.'/auth.php';
