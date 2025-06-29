@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tipe Kamar</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="table-responsive">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="/admin/tipe-kamar/create" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Kamar Baru
        </a>
        <div class="text-muted small">Total: {{ $tipe_kamars->count() }} tipe kamar</div>
    </div>
    
    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th scope="col" style="width: 3%">#</th>
                <th scope="col" style="width: 15%">Gambar</th>
                <th scope="col" style="width: 15%">Nama Kamar</th>
                <th scope="col" style="width: 20%">Fasilitas</th>
                <th scope="col" style="width: 10%">Harga</th>
                <th scope="col" style="width: 8%">Stok</th>
                <th scope="col" style="width: 8%">Booking</th>
                <th scope="col" style="width: 8%">Digunakan</th>
                <th scope="col" style="width: 13%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tipe_kamars as $tipe_kamar)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if ($tipe_kamar->img)
                    <div class="room-image-container">
                        <img src="{{ asset('storage/' . $tipe_kamar->img) }}" class="img-thumbnail" alt="{{ $tipe_kamar->nama }}">
                    </div>
                    @else
                    <div class="bg-light p-2 rounded border text-center">
                        <i class="bi bi-image text-secondary" style="font-size: 2rem;"></i>
                        <p class="small text-muted mb-0">No image</p>
                    </div>
                    @endif
                </td>
                <td class="fw-semibold">{{ $tipe_kamar->nama }}</td>
                <td>
                    <ul class="list-unstyled mb-0 small">
                        @foreach($tipe_kamar->fasilitasKamars as $fkamar)
                        <li class="d-flex align-items-center mb-1">
                            <i class="bi bi-check-circle-fill text-success me-2" style="font-size: 0.75rem;"></i>
                            {{ $fkamar->nama }}
                        </li>
                        @endforeach
                    </ul>
                </td>
                <td class="text-nowrap">@rupiah($tipe_kamar->harga)</td>
                <td>
                    <span class="badge bg-{{ $tipe_kamar->stok > 0 ? 'success' : 'danger' }}">
                        {{ $tipe_kamar->stok }}
                    </span>
                </td>
                <td>
                    <span class="badge bg-warning text-dark">
                        {{ $tipe_kamar->onbook ?? 0 }}
                    </span>
                </td>
                <td>
                    <span class="badge bg-info text-dark">
                        {{ $tipe_kamar->onuse ?? 0 }}
                    </span>
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="/admin/tipe-kamar/{{ $tipe_kamar->id }}/edit" class="btn btn-sm btn-warning flex-grow-1">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="/admin/tipe-kamar/{{ $tipe_kamar->id }}" method="POST" class="d-inline flex-grow-1">
                            @method('delete')
                            @csrf
                            <button class="btn btn-sm btn-danger w-100" onclick="return confirm('Hapus tipe kamar ini?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
    .room-image-container {
        width: 150px;
        height: 100px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .room-image-container img {
        object-fit: cover;
        width: 100%;
        height: 100%;
    }
    .table th, .table td {
        vertical-align: middle;
        padding: 0.75rem;
    }
    .badge {
        font-size: 0.85em;
        padding: 0.35em 0.65em;
    }
    .btn-sm {
        padding: 0.25rem 0.5rem;
        min-width: 32px;
    }
</style>

@endsection