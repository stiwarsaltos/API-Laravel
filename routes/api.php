<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\documentController;
use App\Http\Controllers\customerController;

//Rutas Customer
Route::get('customers', [customerController::class, 'index']);
Route::get('customers/{id}', [customerController::class, 'show']);
Route::post('customers', [customerController::class, 'store']);
Route::put('customers/{id}', [customerController::class, 'update']);
Route::delete('customers/{id}', [customerController::class, 'destroy']);

//Rutas Document
Route::get('documents',[documentController::class, 'index']);
Route::get('documents/{id}', [documentController::class, 'show']);
Route::post('documents', [documentController::class, 'store']);
Route::put('documents/{id}', [documentController::class, 'update']);
Route::delete('documents/{id}', [documentController::class, 'destroy']);
