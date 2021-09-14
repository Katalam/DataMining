<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [Controller::class, 'index'])->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->post('/uprofile/search', [ProfileController::class, 'search'])->name('uprofile.search');
Route::middleware(['auth:sanctum', 'verified'])->get('/uprofile/statistic', [ProfileController::class, 'statistic'])->name('uprofile.statistic');
Route::middleware(['auth:sanctum', 'verified'])->get('/uprofile/{profile}', [ProfileController::class, 'show'])->name('uprofile.show');
