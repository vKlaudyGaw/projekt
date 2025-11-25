<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

Route::get('/', function () {
    return view('mainpage');
});

Route::get('/quiz', [QuizController::class, 'show'])->name('quiz.show');
Route::post('/quiz', [QuizController::class, 'store'])->name('quiz.store');