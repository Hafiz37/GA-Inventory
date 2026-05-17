@extends('layouts.app')
@section('title', 'Tambah Aset')

@section('content')

<div class="d-flex align-items-center mb-4" style="gap:12px;">
    <a href="{{ route('assets.index') }}"
       style="width:34px;height:34px;border-radius:8px;background:var(--bg-card-2);
              border:1px solid var(--border);display:flex;align-items:center;
              justify-content:center;color:var(--text-muted);">
        <i class="fas fa-arrow-left" style="font-size:13px;"></i>
    </a>
    <div>
        <div class="page-title">Tambah Aset Baru</div>
        <div class="page-sub">Isi formulir di bawah untuk mendaftarkan aset</div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <span style="font-weight:600; color:var(--text-heading); font-size:13.5px;">
                    <i class="fas fa-clipboard-list me-2 text-accent"></i>Form Data Aset
                </span>
            </div>
            <div class="card-body" style="padding:24px;">
                <form action="{{ route('assets.store') }}" method="POST">
                    @csrf

                    {{-- Baris 1 --}}
                    <div class="row g-3 mb-3">
                        <div class="col-md-7">
                            <label class="form-label">
                                Nama Barang <span style="color:#f87171;">*</span>
                            </label>
                            <input type="text" name="name" class="form-control"
                                   placeholder="Contoh: Router MikroTik RB4011" required>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Brand / Merk</label>
                            <input type="text" name="brand" class="form-control"
                                   placeholder="Contoh: MikroTik">
                        </div>
                    </div>

                    {{-- Baris 2 --}}
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">
                                Kategori <span style="color:#f87171;">*</span>
                            </label>
                            <select name="category_id" class="form-select" required>
                                <option value="">— Pilih Kategori —</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Serial Number</label>
                            <input type="text" name="serial_number" class="form-control"
                                   placeholder="Contoh: MT-990123">
                        </div>
                    </div>

                    {{-- Baris 3 --}}
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label">
                                Status <span style="color:#f87171;">*</span>
                            </label>
                            <select name="status" class="form-select" required>
                                <option value="Tersedia">Tersedia</option>
                                <option value="Dipakai">Dipakai</option>
                                <option value="Rusak">Rusak</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">
                                Jumlah Stok <span style="color:#f87171;">*</span>
                            </label>
                            <input type="number" name="stock" class="form-control"
                                   value="1" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pemegang / Lokasi</label>
                            <input type="text" name="held_by" class="form-control"
                                   placeholder="Nama staf / ruangan">
                        </div>
                    </div>

                    {{-- Baris 4 --}}
                    <div class="mb-4">
                        <label class="form-label">Catatan Tambahan</label>
                        <textarea name="notes" class="form-control" rows="3"
                                  placeholder="Kondisi barang, asal pengadaan, dll..."></textarea>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('assets.index') }}" class="btn btn-secondary px-4">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>Simpan Aset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
