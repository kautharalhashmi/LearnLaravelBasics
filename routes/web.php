<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcomepage');
});

Route::get('/home.php', function () {
 return view('home');
});
