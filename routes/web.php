<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\TasksController;

Route::get('/tasks', [TasksController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [TasksController::class, 'store'])->name('tasks.store');


Route::get('/home', function () {
    return view('index');
});

// Route::get('/tasks11', function () {
//     return view('page2');
// });

Route::get('/projects', function () {
    return view('page3');
});

Route::get('/contacts', function () {
    return view('page4');
});


// Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/tasks', [TasksController::class, 'index'])->name('tasks.index');
// Route::get('/projects', [ProjectsController::class, 'index'])->name('projects.index');
// Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts.index');
