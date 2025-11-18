<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('mainpage');
});

Route::get('/quizzes', function () {
    return view('quizlist');
});