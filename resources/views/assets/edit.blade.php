@extends('layouts.app')
@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-info text-white"><h5>Edit Aset: {{ $asset->name }}</h5></div>
    <div class="card-body">
        <form action="{{ route('assets.update', $asset->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label>Nama Barang</label>
                <input type="text" name="name" class="form-control" value="{{ $asset->name }}" required>
            </div>
            <div class="mb-3">
                <label>Kategori</label>
                <select name="category_id" class="form-select">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $cat->id == $asset->category_id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Update Data</button>
            <a href="{{ route('assets.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
