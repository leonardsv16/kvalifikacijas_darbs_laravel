<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('index');
});

Route::get('/tasks', function () {
    return view('page2');
});

Route::get('/projects', function () {
    return view('page3');
});

Route::get('/contacts', function () {
    return view('page4');
});
