<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutUsController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/category', [AdminController::class, 'insert']);

// Contoh endpoint untuk menangani penghapusan kategori berdasarkan ID
Route::delete('/category/{id}', [AdminController::class, 'delete']);



Route::get('/aboutus', [AboutUsController::class, 'index'])->name('aboutus.index');
Route::get('/aboutus/create', [AboutUsController::class, 'create'])->name('aboutus.create');
Route::post('/aboutus', [AboutUsController::class, 'store'])->name('aboutus.store');
Route::get('/aboutus/{id}', [AboutUsController::class, 'show'])->name('aboutus.show');
Route::get('/aboutus/{id}/edit', [AboutUsController::class, 'edit'])->name('aboutus.edit');
Route::put('/aboutus/{id}', [AboutUsController::class, 'update'])->name('aboutus.update');
Route::delete('/aboutus/{id}', [AboutUsController::class, 'destroy'])->name('aboutus.destroy');
