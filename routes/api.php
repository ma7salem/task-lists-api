<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\UserRegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function(){
    Route::apiResource('todo-lists', TodoListController::class)->parameters(['todo-lists' => 'list']);
    Route::apiResource('todo-lists.tasks', TaskController::class, ['names' => 'tasks'])->shallow()->parameters(['todo-lists' => 'list']);
});


Route::post('register', UserRegisterController::class)->name('user.register');
Route::post('login', UserLoginController::class)->name('user.login');

