<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::resource('tasks', TaskController::class);

Route::get('/messages', function () {
    return view('messages');
});
