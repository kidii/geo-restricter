<?php

use App\Http\Middleware\BlockCaliforniaUsers;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('welcome');
})->name('test')->middleware(middleware: BlockCaliforniaUsers::class);
