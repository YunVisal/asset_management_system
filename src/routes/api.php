<?php

use App\Http\Controllers\AssetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'jsonResponse'], function () {
    Route::apiResource('/assets', AssetController::class);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
