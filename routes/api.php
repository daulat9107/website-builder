<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostShowController;
use App\Http\Controllers\PostIndexController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/posts', PostIndexController::class)->middleware('auth:sanctum');
Route::get('/posts/{post:slug}', PostShowController::class)->middleware('auth:sanctum');
