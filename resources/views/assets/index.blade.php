@extends('layouts.app')
@section('title', 'Manajemen Aset')

@section('content')

{{-- ── HEADER ── --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <div class="page-title">
            <i class="fas fa-layer-group me-2 text-accent"></i>Manajemen Aset
        </div>
        <div class="page-sub">Kelola seluruh inventaris aset kantor General Affairs</div>
    </div>
    <a href="{{ route('assets.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Aset
    </a>
</div>

{{-- ── STAT CARDS ── --}}
@php
    $total    = $assets->count();
    $tersedia = $assets->where('status','Tersedia')->count();
    $dipakai  = $assets->where('status','Dipakai')->count();
    $lowstock = $assets->where('stock','<=',5)->count();
@endphp

<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="stat-icon purple"><i class="fas fa-boxes"></i></div>
            <div class="stat-info">
                <div class="stat-value">{{ $total }}</div>
                <div class="stat-label">Total Aset</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="stat-icon green"><i class="fas fa-check-circle"></i></div>
            <div class="stat-info">
                <div class="stat-value">{{ $tersedia }}</div>
                <div class="stat-label">Tersedia</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="stat-icon yellow"><i class="fas fa-user-check"></i></div>
            <div class="stat-info">
                <div class="stat-value">{{ $dipakai }}</div>
                <div class="stat-label">Sedang Dipakai</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="stat-icon red"><i class="fas fa-exclamation-triangle"></i></div>
            <div class="stat-info">
                <div class="stat-value">{{ $lowstock }}</div>
                <div class="stat-label">Stok Menipis</div>
            </div>
        </div>
    </div>
</div>

{{-- ── FILTER ── --}}
<div class="card mb-4">
    <div class="card-body" style="padding:16px 20px;">
        <form action="{{ route('assets.index') }}" method="GET">
            <div class="row g-2 align-items-end">
                <div class="col-md-5">
                    <label class="form-label"><i class="fas fa-search me-1"></i> Cari Aset</label>
                    <input type="text" name="search" class="form-control"
                           placeholder="Nama barang atau serial number..."
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label"><i class="fas fa-filter me-1"></i> Kategori</label>
                    <select name="category_id" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-fill">
                            <i class="fas fa-search me-1"></i> Cari
                        </button>
                        <a href="{{ route('assets.index') }}" class="btn btn-secondary px-3"
                           title="Reset">
                            <i class="fas fa-rotate-left"></i>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- ── TABLE ── --}}
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span style="font-weight:600; color:var(--text-heading); font-size:13.5px;">
            <i class="fas fa-table me-2 text-accent"></i>
            Daftar Aset
            <span style="color:var(--text-muted); font-weight:400; margin-left:6px;">
                ({{ $assets->count() }} item)
            </span>
        </span>
    </div>

    <div style="overflow-x:auto;">
        <table class="table">
            <thead>
                <tr>
                    <th style="width:44px;">#</th>
                    <th>Nama Aset</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Stok</th>
                    <th>Pemegang</th>
                    <th style="text-align:right; width:90px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($assets as $i => $asset)
                <tr class="{{ $asset->stock <= 5 ? 'row-danger' : '' }}">

                    {{-- No --}}
                    <td style="color:var(--text-sub); font-size:12px;">{{ $i + 1 }}</td>

                    {{-- Nama --}}
                    <td>
                        <div style="font-weight:600; color:var(--text-heading); font-size:13.5px;">
                            {{ $asset->name }}
                        </div>
                        @if($asset->brand)
                        <div style="font-size:11.5px; color:var(--text-muted); margin-top:2px;">
                            <i class="fas fa-tag" style="font-size:10px; margin-right:3px;"></i>
                            {{ $asset->brand }}
                        </div>
                        @endif
                        @if($asset->serial_number)
                        <div style="font-size:11px; color:var(--text-sub); font-family:monospace; margin-top:1px;">
                            SN: {{ $asset->serial_number }}
                        </div>
                        @endif
                    </td>

                    {{-- Kategori --}}
                    <td>
                        <span class="badge badge-blue">{{ $asset->category->name }}</span>
                    </td>

                    {{-- Status --}}
                    <td>
                        @if($asset->status == 'Tersedia')
                            <span class="badge badge-green">
                                <i class="fas fa-circle" style="font-size:7px; margin-right:4px;"></i>Tersedia
                            </span>
                        @elseif($asset->status == 'Dipakai')
                            <span class="badge badge-yellow">
                                <i class="fas fa-circle" style="font-size:7px; margin-right:4px;"></i>Dipakai
                            </span>
                        @else
                            <span class="badge badge-red">
                                <i class="fas fa-circle" style="font-size:7px; margin-right:4px;"></i>Rusak
                            </span>
                        @endif
                    </td>

                    {{-- Stok --}}
                    <td>
                        <div style="font-weight:700; font-size:16px;
                             color: {{ $asset->stock <= 5 ? '#f87171' : 'var(--text-heading)' }};">
                            {{ $asset->stock }}
                        </div>
                        @if($asset->stock <= 5)
                        <div style="font-size:10.5px; color:#f87171; margin-top:1px;">
                            <i class="fas fa-triangle-exclamation" style="font-size:9px;"></i> Menipis
                        </div>
                        @endif
                    </td>

                    {{-- Pemegang --}}
                    <td style="color:var(--text-muted); font-size:13px;">
                        {{ $asset->held_by ?? '—' }}
                    </td>

                    {{-- Aksi --}}
                    <td style="text-align:right;">
                        <div class="d-flex gap-1 justify-content-end">
                            <a href="{{ route('assets.edit', $asset->id) }}"
                               class="btn btn-icon btn-icon-edit" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <button type="button"
                                    class="btn btn-icon btn-icon-del btn-delete"
                                    data-id="{{ $asset->id }}" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <form id="delete-form-{{ $asset->id }}"
                              action="{{ route('assets.destroy', $asset->id) }}"
                              method="POST" style="display:none;">
                            @csrf @method('DELETE')
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center; padding:56px 0; color:var(--text-muted);">
                        <i class="fas fa-box-open" style="font-size:32px; display:block; margin-bottom:10px; color:var(--text-sub);"></i>
                        <div style="font-size:15px; color:var(--text-muted);">Tidak ada data aset</div>
                        <div style="font-size:12px; color:var(--text-sub); margin-top:4px;">
                            Coba ubah filter atau tambah aset baru
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            Swal.fire({
                title: 'Hapus aset ini?',
                text: 'Data akan dihapus permanen dan tidak bisa dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-trash me-1"></i> Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#374151',
                background: '#111827',
                color: '#f1f5f9',
                iconColor: '#f87171',
                reverseButtons: true
            }).then(r => {
                if (r.isConfirmed) document.getElementById('delete-form-' + id).submit();
            });
        });
    });
});
</script>
