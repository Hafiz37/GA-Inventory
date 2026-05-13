<?php

namespace App\Http\Controllers;

use App\Models\Asset; // Penting: untuk memanggil Model Asset
use Illuminate\Http\Request;
use App\Models\Category; // Penting: untuk memanggil Model Category

class AssetController extends Controller
{
    public function index()
    {
        // Mengambil semua data aset beserta kategorinya (Eager Loading)
        $assets = Asset::with('category')->get();

        // Mengirim data ke view 'assets.index'
        return view('assets.index', compact('assets'));
    }

    public function create() {
        $categories = Category::all();
        return view('assets.create', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'stock' => 'required|integer'
        ]);

        Asset::create($request->all());
        return redirect()->route('assets.index')->with('success', 'Baru berhasil ditambah!');
    }

    public function edit(Asset $asset) {
    $categories = Category::all();
    return view('assets.edit', compact('asset', 'categories'));
    }

    public function update(Request $request, Asset $asset) {
        $asset->update($request->all());
        return redirect()->route('assets.index')->with('success', 'Data diperbarui!');
    }

    public function destroy(Asset $asset) {
        $asset->delete();
        return redirect()->route('assets.index')->with('success', 'Barang dihapus!');
    }
}
