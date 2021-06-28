<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/**
 * Authentification Routes
 */
Route::get('user', 'AuthController@user');
Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::post('logout', 'AuthController@logout');

/**
 * API Routes
 */

Route::apiResource('list', 'ApiListController')->middleware("auth:sanctum");
Route::apiResource('transactions', 'TransactionLogController')->middleware("auth:sanctum");;
Route::get('{path}', function ($path) {
    return redirect("https://www.youtube.com/watch?v=dQw4w9WgXcQ");
})->where('path', '[-a-z0-9_\s]+');
