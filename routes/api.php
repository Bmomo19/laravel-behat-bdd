<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/hello', function (Request $request) {
    return response()->json([
        'message' => 'Bonjour ' . $request->input('name')
    ]);
});

