<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Auth;


Route::get('/login', function () {
    return view(view: 'index');
})->name('login.form');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login')->with('success', 'You have successfully logged out.');
})->name('logout');


Route::get('/home', function () {
    return view('index');
})->middleware('auth')->name('home');

Route::get('/tasks', [TasksController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [TasksController::class, 'store'])->name('tasks.store');
Route::put('/tasks/update', [TasksController::class, 'update'])->name('tasks.update');


Route::get('/projects', function () {
    return view('page3');
});

Route::get('/contacts', function () {
    return view('page4');
});
