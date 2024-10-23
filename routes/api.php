<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostShowController;
use App\Http\Controllers\PostIndexController;
use App\Http\Controllers\ThemeShowController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/posts', PostIndexController::class)->middleware('auth:sanctum');
Route::get('/posts/{post:slug}', PostShowController::class)->middleware('auth:sanctum');
Route::get('/theme', ThemeShowController::class)->middleware('auth:sanctum');

