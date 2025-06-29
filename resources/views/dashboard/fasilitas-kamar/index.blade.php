@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Fasilitas Kamar</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="table-responsive col-lg-12">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="/admin/fasilitas-kamar/create" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Fasilitas Baru
        </a>
        <div class="text-muted small">Total: {{ $fkamars->count() }} fasilitas</div>
    </div>
    
    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th scope="col" style="width: 5%">#</th>
                <th scope="col" style="width: 30%">Gambar</th>
                <th scope="col" style="width: 40%">Nama Fasilitas</th>
                <th scope="col" style="width: 25%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fkamars as $fkamar)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if ($fkamar->img)
                    <div style="max-height: 200px; max-width: 300px; overflow: hidden;" class="rounded border">
                        <img src="{{ asset('storage/' . $fkamar->img) }}" class="img-fluid" alt="{{ $fkamar->nama }}" style="object-fit: cover; width: 100%; height: 100%;">
                    </div>
                    @else
                    <div class="bg-light p-2 rounded border text-center">
                        <i class="bi bi-image text-secondary" style="font-size: 3rem;"></i>
                        <p class="small text-muted mb-0">No image available</p>
                    </div>
                    @endif
                </td>
                <td class="fw-semibold">{{ $fkamar->nama }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="/admin/fasilitas-kamar/{{ $fkamar->id }}/edit" class="btn btn-sm btn-warning flex-grow-1">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </a>
                        <form action="/admin/fasilitas-kamar/{{ $fkamar->id }}" method="POST" class="d-inline flex-grow-1">
                            @method('delete')
                            @csrf
                            <button class="btn btn-sm btn-danger w-100" onclick="return confirm('Hapus fasilitas ini?')">
                                <i class="bi bi-trash me-1"></i> Hapus
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
    .table th, .table td {
        vertical-align: middle;
    }
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
</style>

@endsection