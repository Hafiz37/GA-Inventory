@extends('layouts.app')

@section('title', 'Daftar Aset')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Inventaris GA</h5>
        <a href="{{ route('assets.create') }}" class="btn btn-light btn-sm">+ Tambah Barang</a>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assets as $asset)
                <tr>
                    <td>{{ $asset->name }}</td>
                    <td>{{ $asset->category->name }}</td>
                    <td>
                        <span class="badge {{ $asset->status == 'Tersedia' ? 'bg-success' : 'bg-warning' }}">
                            {{ $asset->status }}
                        </span>
                    </td>
                    <td>{{ $asset->stock }}</td>
                    <td>
                        <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-sm btn-info text-white">Edit</a>
                        <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus barang ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
