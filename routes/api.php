<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\CustomerController;

//Rutas Customer
Route::get('customers', [CustomerController::class, 'index']);
Route::get('customers/{id}', [CustomerController::class, 'show']);
Route::post('customers', [CustomerController::class, 'store']);
Route::put('customers/{id}', [CustomerController::class, 'update']);
Route::delete('customers/{id}', [CustomerController::class, 'destroy']);

//Rutas Document
Route::get('documents',[DocumentController::class, 'index']);
Route::get('documents/{id}', [DocumentController::class, 'show']);
Route::post('documents', [DocumentController::class, 'store']);
Route::put('documents/{id}', [DocumentController::class, 'update']);
Route::delete('documents/{id}', [DocumentController::class, 'destroy']);
