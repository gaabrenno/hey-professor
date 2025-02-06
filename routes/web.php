<?php

use App\Http\Controllers\{DashboardController, ProfileController, Question, QuestionController};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (app()->isLocal()) {
        auth()->loginUsingId(1);

        return to_route('dashboard');
    }

    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    #region Question Routes
    Route::prefix('/question')->group(function () {
        Route::get('/', [QuestionController::class, 'index'])->name('question.index');
        Route::post('/store', [QuestionController::class, 'store'])->name('question.store');
        Route::post('/like/{questionId}', Question\LikeController::class)->name('question.like');
        Route::post('/unlike/{questionId}', Question\UnLikeController::class)->name('question.unlike');
        Route::put('/publish/{question}', Question\PublishController::class)->name('question.publish');
    });
    #endregion

    #region Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    #endregion
});

require __DIR__ . '/auth.php';
