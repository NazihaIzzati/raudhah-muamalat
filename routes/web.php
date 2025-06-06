<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/partners', function () {
    return view('partners');
});

Route::get('/campaigns', function () {
    return view('campaigns');
});

Route::get('/news', function () {
    return view('news');
});

Route::get('/faq', function () {
    return view('faq');
});

Route::get('/donate', function () {
    return view('donate');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/example', function () {
    return view('example-page');
});
