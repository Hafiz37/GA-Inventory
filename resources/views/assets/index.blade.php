@extends('layouts.app')
@section('title', 'Daftar Aset')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="fas fa-warehouse me-2"></i> Manajemen Inventaris</h3>
    <a href="{{ route('assets.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Aset</a>
</div>

<div class="card mb-4 border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('assets.index') }}" method="GET" class="row g-3">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control" placeholder="Cari nama barang atau SN..." value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <select name="category_id" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-grid">
                <button type="submit" class="btn btn-secondary">Cari & Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Nama Aset</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($assets as $asset)
                <tr class="{{ $asset->stock <= 5 ? 'table-danger' : '' }}">
                    <td>
                        <strong>{{ $asset->name }}</strong><br>
                        <small class="text-muted">SN: {{ $asset->serial_number ?? '-' }}</small>
                    </td>
                    <td><span class="badge bg-info text-dark">{{ $asset->category->name }}</span></td>
                    <td>
                        <span class="badge {{ $asset->status == 'Tersedia' ? 'bg-success' : 'bg-warning' }}">
                            {{ $asset->status }}
                        </span>
                    </td>
                    <td>
                        {{ $asset->stock }}
                        @if($asset->stock <= 5)
                            <i class="fas fa-exclamation-triangle text-danger" title="Stok Menipis!"></i>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-sm btn-outline-danger btn-delete" data-id="{{ $asset->id }}">
                                <i class="fas fa-trash"></i>
                            </button>

                            <form id="delete-form-{{ $asset->id }}" action="{{ route('assets.destroy', $asset->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">Data tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection


<script>
    // Tunggu sampai semua elemen selesai dimuat
    document.addEventListener('DOMContentLoaded', function() {

        // Ambil semua tombol yang punya class .btn-delete
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const assetId = this.getAttribute('data-id'); // Ambil ID barang

                // Munculkan Pop-up SweetAlert2
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data aset ini akan dihapus permanen dari sistem!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika klik Ya, jalankan form hapus yang sesuai ID-nya
                        document.getElementById('delete-form-' + assetId).submit();
                    }
                });
            });
        });

    });
</script>
