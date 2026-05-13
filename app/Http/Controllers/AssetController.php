<?php

namespace App\Http\Controllers;

use App\Models\Asset; // Penting: untuk memanggil Model Asset
use Illuminate\Http\Request;
use App\Models\Category; // Penting: untuk memanggil Model Category

class AssetController extends Controller
{
    public function index(Request $request)
    {
        $query = Asset::with('category');

        // Fitur Search (Berdasarkan Nama atau Serial Number)
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('serial_number', 'like', '%' . $request->search . '%');
        }

        // Fitur Filter Kategori
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $assets = $query->latest()->get();
        $categories = \App\Models\Category::all(); // Untuk dropdown filter

        return view('assets.index', compact('assets', 'categories'));
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
