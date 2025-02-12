<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ToDoListController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('/list', ToDoListController::class);

    Route::prefix('list/{listN}')->group(function () {
        Route::resource('task', TaskController::class)->except('index');
        Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
    });
});
