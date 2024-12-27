<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('registro', [AuthController::class, 'registro']);
Route::post('login', [AuthController::class, 'login'])->name("login");

Route::middleware('custom.auth')->group(function () {
    Route::get('me', [AuthController::class, 'me']); 
});