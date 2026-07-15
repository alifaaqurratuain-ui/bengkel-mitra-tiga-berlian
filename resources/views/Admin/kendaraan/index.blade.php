@extends('layouts.admin')

@section('title', 'Daftar Kendaraan - Mitra Tiga Berlian')
@section('page-title', 'Daftar Kendaraan')
@section('page-subtitle', 'Kelola data kendaraan')

@section('content')
<style>
    .card {
        background: #fff;
        border-radius: 16px;
        padding: 22px 24px;
        box-shadow: 0 1px 2px rgba(16,24,40,.04), 0 4px 10px rgba(16,24,40,.05);
    }
    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
        flex-wrap: wrap;
        gap: 12px;
    }
    .card-header .title {
        font-size: 15.5px;
        font-weight: 700;
        color: #16213a;
    }
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 18px;
        border: none;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .btn-gold {
        background: linear-gradient(135deg, #d3b15c, #b08c3c);
        color: #2c2410;
    }
    .btn-gold:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(205,160,74,0.3);
    }
    .btn-success {
        background: #28a745;
        color: #fff;
    }
    .btn-success:hover {
        background: #218838;
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(40,167,69,0.3);
    }
    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
        border-radius: 8px;
    }
    .btn-edit {
        background: rgba(59,130,246,0.1);
        color: #3B82F6;
    }
    .btn-edit:hover {
        background: #3B82F6;
        color: #fff;
    }
    .btn-delete {
        background: rgba(239,68,68,0.1);
        color: #EF4444;
    }
    .btn-delete:hover {
        background: #EF4444;
        color: #fff;
    }
    .table-wrap {
        overflow-x: auto;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    th {
        text-align: left;
        padding: 10px 12px;
        color: #9aa1ae;
        font-weight: 700;
        font-size: 11.5px;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        border-bottom: 1px solid #eceef2;
    }
    td {
        padding: 10px 12px;
        border-bottom: 1px solid #f3f4f7;
        color: #16213a;
    }
    tr:hover td {
        background: #f8f9fb;
    }
    .status-badge {
        display: inline-block;
        padding: 3px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }
    .status-tersedia {
        background: #d1fae5;
        color: #065f46;
    }
    .status-disewa {
        background: #fef3c7;
        color: #92400e;
    }
    .status-service {
        background: #fee2e2;
        color: #991b1b;
    }
    .empty-state {
        text-align: center;
        padding: 40px 20px;
    }
    .empty-state i {
        font-size: 34px;
        color: #cfd3da;
        display: block;
        margin-bottom: 14px;
    }
    .empty-state .headline {
        font-size: 14px;
        font-weight: 700;
        color: #5d6472;
        margin: 0;
    }
    .empty-state .hint {
        font-size: 12.5px;
        color: #9aa1ae;
        margin: 6px 0 0;
    }
    .alert-success {
        background: #d1fae5;
        color: #065f46;
        padding: 12px 16px;
        border-radius: 10px;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* ===== SEARCH BAR ===== */
    .search-bar {
        display: flex;
        gap: 10px;
        margin-bottom: 16px;
        align-items: center;
        flex-wrap: wrap;
    }
    .search-bar form {
        flex: 1;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .search-bar input {
        flex: 1;
        padding: 10px 16px;
        border: 1.5px solid #e2e5eb;
        border-radius: 10px;
        font-size: 14px;
        outline: none;
        transition: all 0.3s ease;
        font-family: 'Inter', sans-serif;
        min-width: 200px;
    }
    .search-bar input:focus {
        border-color: #cda04a;
        box-shadow: 0 0 0 4px rgba(205, 160, 74, 0.1);
    }
    .btn-primary {
        background: linear-gradient(135deg, #d3b15c, #b08c3c);
        color: #2c2410;
        padding: 10px 20px;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(205, 160, 74, 0.3);
    }
    .btn-outline {
        background: #fff;
        border: 1.5px solid #e2e5eb;
        color: #6b7280;
        padding: 10px 16px;
        border-radius: 10px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-outline:hover {
        border-color: #cda04a;
        color: #cda04a;
    }
    .search-info {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 12px;
        padding: 8px 12px;
        background: #f8f9fb;
        border-radius: 8px;
        display: inline-block;
    }

    @media (max-width: 760px) {
        table { font-size: 12px; }
        th, td { padding: 8px 10px; }
        .card { padding: 16px; }
        .btn-sm { padding: 4px 8px; font-size: 11px; }
        .card-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .search-bar form {
            flex-direction: column;
        }
        .search-bar input {
            width: 100%;
        }
        .btn-primary, .btn-outline {
            justify-content: center;
        }
    }
</style>

<div class="card">
    <div class="card-header">
        <div class="title"><i class="fa-solid fa-car" style="color:#a9842f;margin-right:8px;"></i> Kendaraan</div>
        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <a href="{{ route('admin.kendaraan.create') }}" class="btn btn-gold">
                <i class="fa-solid fa-plus"></i> Tambah Kendaraan
            </a>
            <a href="{{ route('admin.kendaraan.export') }}" class="btn btn-success">
                <i class="fa-solid fa-file-excel"></i> Export Excel
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert-success">
        <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <!-- ===== SEARCH BAR ===== -->
    <div class="search-bar">
        <form action="{{ route('admin.kendaraan.index') }}" method="GET">
            <input type="text" name="search" placeholder="Cari kendaraan (plat nomor, merk, model)..." 
                   value="{{ request('search') }}">
            <button type="submit" class="btn-primary">
                <i class="fa-solid fa-search"></i> Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.kendaraan.index') }}" class="btn-outline">
                    <i class="fa-solid fa-times"></i> Reset
                </a>
            @endif
        </form>
    </div>

    @if(request('search'))
    <div class="search-info">
        <i class="fa-solid fa-filter"></i> Menampilkan hasil pencarian untuk: <strong>"{{ request('search') }}"</strong>
    </div>
    @endif

    <div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Plat Nomor</th>
                <th>Merk</th>
                <th>Model</th>
                <th>Tahun</th>
                <th>Tipe</th>
                <th style="text-align:center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kendaraans as $kendaraan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><strong>{{ $kendaraan->plat_nomor }}</strong></td>
                <td>{{ $kendaraan->merk }}</td>
                <td>{{ $kendaraan->model }}</td>
                <td>{{ $kendaraan->tahun }}</td>
                <td>{{ ucfirst($kendaraan->tipe) }}</td>
                <td style="text-align:center;">
                    <a href="{{ route('admin.kendaraan.edit', $kendaraan->id) }}" class="btn btn-edit btn-sm">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                    <form action="{{ route('admin.kendaraan.destroy', $kendaraan->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete btn-sm" onclick="return confirm('Yakin hapus kendaraan ini?')">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">
                    <div class="empty-state">
                        <i class="fa-solid fa-car"></i>
                        <p class="headline">
                            @if(request('search'))
                                Tidak ada kendaraan dengan kata kunci <strong>"{{ request('search') }}"</strong>
                            @else
                                Belum ada kendaraan
                            @endif
                        </p>
                        <p class="hint">
                            @if(request('search'))
                                <a href="{{ route('admin.kendaraan.index') }}" style="color:#cda04a;font-weight:600;text-decoration:none;">
                                    <i class="fa-solid fa-arrow-left"></i> Kembali ke daftar
                                </a>
                            @else
                                Klik <strong>Tambah Kendaraan</strong> untuk menambahkan
                            @endif
                        </p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

    @if($kendaraans->count() > 0 && request('search'))
    <div style="margin-top:12px; font-size:13px; color:#6b7280;">
        <i class="fa-solid fa-database"></i> Menampilkan {{ $kendaraans->count() }} data dari total pencarian
    </div>
    @endif
</div>
@endsection