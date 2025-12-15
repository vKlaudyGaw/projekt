<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminQuizController;
use App\Http\Controllers\QuizController; 
use App\Http\Controllers\AdminQuestionController;

// |--------------------------------------------------------------------------
// | TRASY DLA ADMINA (Panel Zarządzania)
// |--------------------------------------------------------------------------

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    
    Route::get('/', function () {
        return redirect()->route('admin.quizzes.index');
    });

    Route::get('/quizzes', [AdminQuizController::class, 'index'])->name('admin.quizzes.index');
    
    Route::get('/quizzes/create', [AdminQuizController::class, 'create'])->name('admin.quizzes.create');
    Route::post('/quizzes', [AdminQuizController::class, 'store'])->name('admin.quizzes.store');
    
    Route::get('/quizzes/{quiz}/edit', [AdminQuizController::class, 'edit'])->name('admin.quizzes.edit');
    Route::put('/quizzes/{quiz}', [AdminQuizController::class, 'update'])->name('admin.quizzes.update');
    
    Route::delete('/quizzes/{quiz}', [AdminQuizController::class, 'destroy'])->name('admin.quizzes.destroy');

    Route::get('/quizzes/{quiz}/questions/create', [AdminQuestionController::class, 'create'])->name('admin.questions.create');
    Route::post('/quizzes/{quiz}/questions', [AdminQuestionController::class, 'store'])->name('admin.questions.store');
    Route::get('/questions/{question}/edit', [AdminQuestionController::class, 'edit'])->name('admin.questions.edit');
    Route::put('/questions/{question}', [AdminQuestionController::class, 'update'])->name('admin.questions.update');
    Route::delete('/questions/{question}', [AdminQuestionController::class, 'destroy'])->name('admin.questions.destroy');
});

//|--------------------------------------------------------------------------
//| TRASY PUBLICZNE (Rozwiązywanie Quizów)
//|--------------------------------------------------------------------------

Route::get('/', [QuizController::class, 'index'])->name('home');

Route::get('/quiz/{slug}', [QuizController::class, 'show'])->name('quiz.show');

Route::post('/quiz', [QuizController::class, 'store'])->name('quiz.store');

Route::get('/quiz', function () {
    return redirect()->route('home');
});



// |--------------------------------------------------------------------------
// | TRASY UŻYTKOWNIKA (Logowanie, Profil - Laravel Breeze)
// |--------------------------------------------------------------------------

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';