@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="bi bi-plus-circle-fill text-primary me-2"></i>
        Tambah Fasilitas Kamar Baru
    </h1>
    <a href="/admin/fasilitas-kamar" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="col-lg-8">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="/admin/fasilitas-kamar" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-4">
                    <label for="nama" class="form-label fw-semibold">Nama Fasilitas Kamar</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                           name="nama" id="nama" value="{{ old('nama') }}" 
                           placeholder="Contoh: AC, TV LED 32\", Kamar Mandi" required autofocus>
                    @error('nama')
                    <div class="invalid-feedback d-block">
                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="img" class="form-label fw-semibold">Foto Fasilitas Kamar</label>
                    
                    <div class="border rounded p-3 mb-3 text-center bg-light" style="max-width: 400px">
                        <img class="img-preview img-fluid rounded" style="max-height: 200px; display: none;">
                        <div class="no-image-placeholder">
                            <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mb-0">Preview gambar akan muncul di sini</p>
                        </div>
                    </div>
                    
                    <input type="file" name="img" id="img" class="form-control @error('img') is-invalid @enderror" 
                           onchange="previewImage()" accept="image/*">
                    <div class="form-text">Format: JPG, PNG, JPEG (Maksimal 2MB)</div>
                    @error('img')
                    <div class="invalid-feedback d-block">
                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <button type="reset" class="btn btn-outline-secondary me-md-2">
                        <i class="bi bi-x-circle me-1"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Simpan Fasilitas
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
                placeholder.style.display = "none";
            }
            
            reader.readAsDataURL(image.files[0]);
        } else {
            imgPreview.style.display = "none";
            placeholder.style.display = "block";
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
</style>

@endsection