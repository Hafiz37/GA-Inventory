<?php

use App\Http\Controllers\AssetController;
use Illuminate\Support\Facades\Route;

// Tambahkan ini supaya halaman depan tidak 404
Route::get('/', function () {
    return redirect()->route('assets.index');
});

Route::resource('assets', AssetController::class);
