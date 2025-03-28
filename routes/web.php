<?php

use App\Http\Controllers\Auth\Github\{CallbackController, RedirectController};
use App\Http\Controllers\Auth\Google\{CallbackController as GoogleCallbackController, RedirectController as GoogleRedirectController};
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\{DashboardController, ProfileController, Question, QuestionController};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    // return redirect()->route('login');
    return view('welcome');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register.index');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

Route::get('/github/login', RedirectController::class)->name('github.login');
Route::get('/github/callback', CallbackController::class)->name('github.callback');
Route::get('/google/login', GoogleRedirectController::class)->name('google.login');
Route::get('/google/callback', GoogleCallbackController::class)->name('google.callback');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/chat', function () {
        return view('chat.index');
    })->name('chat');
    #region Question Routes
    Route::prefix('/question')->group(function () {
        Route::get('/', [QuestionController::class, 'index'])->name('question.index');
        Route::post('/store', [QuestionController::class, 'store'])->name('question.store');
        Route::get('/{question}/edit', [QuestionController::class, 'edit'])->name('question.edit');
        Route::put('/{question}', [QuestionController::class, 'update'])->name('question.update');
        Route::delete('/{question}', [QuestionController::class, 'destroy'])->name('question.destroy');

        Route::patch('/{question}/archive', [QuestionController::class, 'archive'])->name('question.archive');
        Route::patch('/{questionId}/restore', [QuestionController::class, 'restore'])->name('question.restore');

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
