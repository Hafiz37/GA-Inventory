<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Http\Resources\AssetResource;

class AssetApiController extends Controller
{
    public function index()
    {
        $assets = Asset::with('category')->get();
        // Mengembalikan data dalam format JSON melalui Resource
        return AssetResource::collection($assets);
    }
}
