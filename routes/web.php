<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ContactController;

Route::get('/contacts', [ContactController::class, 'showForm'])->name('contacts.form');
Route::post('/contacts', [ContactController::class, 'submitForm'])->name('contacts.submit');

Route::get('/register', action: [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

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
Route::delete('/tasks/{id}', [TasksController::class, 'destroy'])->name('tasks.destroy');


Route::get('/projects', function () {
    return view('page3');
});


// Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
// });


Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/projects', [UserController::class, 'manageUsers'])->name('users.manage');


Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');


