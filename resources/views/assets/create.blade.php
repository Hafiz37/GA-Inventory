@extends('layouts.app')
@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-dark text-white"><h5>Tambah Aset Baru</h5></div>
    <div class="card-body">
        <form action="{{ route('assets.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nama Barang</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Kategori</label>
                <select name="category_id" class="form-select">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select">
                        <option value="Tersedia">Tersedia</option>
                        <option value="Dipakai">Dipakai</option>
                        <option value="Rusak">Rusak</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Stok</label>
                    <input type="number" name="stock" class="form-control" value="1">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Barang</button>
            <a href="{{ route('assets.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
