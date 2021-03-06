<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get(
    '/',
    [\App\Http\Controllers\TempController::class, 'index']
)->name('index');
Route::get(
    '/expences_table',
    [\App\Http\Controllers\TempController::class, 'expencesTable']
)->name('expences.table');
Route::post(
    '/',
    [\App\Http\Controllers\TempController::class, 'store']
)->name('store');
