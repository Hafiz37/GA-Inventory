<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AssetApiController; // Pastikan ini dipanggil


// 1. Rute bawaan untuk mengecek user yang sedang login (memerlukan token)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// 2. Rute API untuk Manajemen Aset
// Tanpa middleware agar bisa kita tes langsung di Postman dulu
Route::get('/assets', [AssetApiController::class, 'index']);

// Jika nanti kamu ingin menambahkan fitur simpan via API:
// Route::post('/assets', [AssetApiController::class, 'store']);
