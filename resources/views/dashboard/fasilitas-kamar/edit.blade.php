@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="bi bi-pencil-square text-primary me-2"></i>
        Edit Fasilitas Kamar
    </h1>
    <a href="/admin/fasilitas-kamar" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="col-lg-8">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="/admin/fasilitas-kamar/{{ $fkamar->id }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                
                <div class="mb-4">
                    <label for="nama" class="form-label fw-semibold">Nama Fasilitas Kamar</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-card-heading"></i></span>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                               name="nama" id="nama" value="{{ old('nama', $fkamar->nama) }}" 
                               placeholder="Contoh: AC, TV LED 32\", Kamar Mandi" required autofocus>
                    </div>
                    @error('nama')
                    <div class="invalid-feedback d-block">
                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="img" class="form-label fw-semibold">Foto Fasilitas Kamar</label>
                    <input type="hidden" name="oldImage" value="{{ $fkamar->img }}">
                    
                    <div class="border rounded p-3 mb-3 text-center bg-light" style="max-width: 400px">
                        @if ($fkamar->img)
                            <img src="{{ asset('storage/' . $fkamar->img) }}" 
                                 class="img-preview img-fluid rounded" 
                                 style="max-height: 200px; display: block;">
                        @else
                            <img class="img-preview img-fluid rounded" 
                                 style="max-height: 200px; display: none;">
                            <div class="no-image-placeholder">
                                <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted mb-0">Tidak ada gambar</p>
                            </div>
                        @endif
                    </div>
                    
                    <input type="file" name="img" id="img" 
                           class="form-control @error('img') is-invalid @enderror" 
                           onchange="previewImage()" accept="image/*">
                    <div class="form-text">Format: JPG, PNG, JPEG (Maksimal 2MB)</div>
                    @error('img')
                    <div class="invalid-feedback d-block">
                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="reset" class="btn btn-outline-secondary px-3 py-2">
                        <i class="bi bi-x-circle me-1"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary px-4 py-2">
                        <i class="bi bi-save me-1"></i> Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage() {
        const image = document.querySelector("#img");
        const imgPreview = document.querySelector(".img-preview");
        const placeholder = document.querySelector(".no-image-placeholder");

        if (image.files && image.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                imgPreview.src = e.target.result;
                imgPreview.style.display = "block";
                if(placeholder) placeholder.style.display = "none";
            }
            
            reader.readAsDataURL(image.files[0]);
        } else {
            imgPreview.style.display = "none";
            if(placeholder) placeholder.style.display = "block";
        }
    }
</script>

<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    .no-image-placeholder {
        padding: 2rem 0;
    }
    .btn-primary {
        background-color: #0d6efd;
        border: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #0b5ed7;
        transform: translateY(-2px);
    }
    .input-group-text {
        background-color: #f8f9fa;
    }
</style>

@endsection