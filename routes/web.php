<?php

use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/tasks', function () {
    return view('tasks', ['tasks' => Task::latest()->paginate(5)]);
});

Route::get('/messages', function () {
    return view('messages');
});
