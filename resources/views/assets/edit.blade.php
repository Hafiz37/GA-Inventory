@extends('layouts.app')

@section('title', 'Edit Aset')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i> Edit Aset: {{ $asset->name }}</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('assets.update', $asset->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="name" class="form-control" value="{{ $asset->name }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Brand/Merk</label>
                            <input type="text" name="brand" class="form-control" value="{{ $asset->brand }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="category_id" class="form-select" required>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $cat->id == $asset->category_id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Serial Number (SN)</label>
                            <input type="text" name="serial_number" class="form-control" value="{{ $asset->serial_number }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="Tersedia" {{ $asset->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="Dipakai" {{ $asset->status == 'Dipakai' ? 'selected' : '' }}>Dipakai</option>
                                <option value="Rusak" {{ $asset->status == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jumlah Barang (Stok)</label>
                            <input type="number" name="stock" class="form-control" value="{{ $asset->stock }}" required min="0">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pemegang/Lokasi</label>
                        <input type="text" name="held_by" class="form-control" value="{{ $asset->held_by }}" placeholder="Contoh: Meja Admin atau Nama Staf">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catatan Tambahan</label>
                        <textarea name="notes" class="form-control" rows="3">{{ $asset->notes }}</textarea>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('assets.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Update Data Aset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
