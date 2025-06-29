@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="bi bi-pencil-square text-primary me-2"></i>
        Edit Kamar
    </h1>
    <a href="/admin/tipe-kamar" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="col-lg-8">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="/admin/tipe-kamar/{{ $tipe_kamar->id }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                
                <div class="mb-4">
                    <label for="nama" class="form-label fw-semibold">Nama Kamar</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-door-open"></i></span>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                               name="nama" id="nama" value="{{ old('nama', $tipe_kamar->nama) }}" 
                               placeholder="Contoh: Deluxe Room, Suite VIP" required autofocus>
                    </div>
                    @error('nama')
                    <div class="invalid-feedback d-block">
                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                    @enderror
                </div>
                
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="harga" class="form-label fw-semibold">Harga Kamar</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" class="form-control @error('harga') is-invalid @enderror" 
                                   name="harga_display" id="harga_display" 
                                   value="{{ old('harga', $tipe_kamar->harga) ? number_format(old('harga', $tipe_kamar->harga), 0, ',', '.') : '' }}" 
                                   oninput="formatCurrency(this)" required>
                            <input type="hidden" name="harga" id="harga" value="{{ old('harga', $tipe_kamar->harga) }}">
                        </div>
                        @error('harga')
                        <div class="invalid-feedback d-block">
                            <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label for="stok" class="form-label fw-semibold">Stok Kamar</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-box"></i></span>
                            <input type="number" class="form-control @error('stok') is-invalid @enderror" 
                                   name="stok" id="stok" value="{{ old('stok', $tipe_kamar->stok) }}" 
                                   min="1" required>
                        </div>
                        @error('stok')
                        <div class="invalid-feedback d-block">
                            <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="fkamar" class="form-label fw-semibold">Fasilitas Kamar</label>
                    <select class="form-select js-example-basic-multiple @error('fasilitas') is-invalid @enderror" 
                            name="fasilitas[]" multiple="multiple" id="fkamar" required>
                        @foreach ($fkamars as $fkamar)
                        <option value="{{ $fkamar->id }}" 
                            @foreach ($tipe_kamar->fasilitasKamars as $value)
                                @if ($value->id == $fkamar->id) selected @endif
                            @endforeach>
                            {{ $fkamar->nama }}
                        </option>
                        @endforeach
                    </select>
                    @error('fasilitas')
                    <div class="invalid-feedback d-block">
                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                    @enderror
                    <div class="form-text">Pilih beberapa fasilitas dengan menekan tombol Ctrl/Cmd</div>
                </div>
                
                <div class="mb-4">
                    <label for="img" class="form-label fw-semibold">Foto Kamar</label>
                    <input type="hidden" name="oldImage" value="{{ $tipe_kamar->img }}">
                    
                    <div class="border rounded p-3 mb-3 text-center bg-light">
                        @if ($tipe_kamar->img)
                            <img src="{{ asset('storage/' . $tipe_kamar->img) }}" 
                                 class="img-preview img-fluid rounded" 
                                 style="max-height: 250px; display: block;">
                        @else
                            <img class="img-preview img-fluid rounded" 
                                 style="max-height: 250px; display: none;">
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
                        <i class="bi bi-save me-1"></i> Perbarui Kamar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            placeholder: "Pilih fasilitas",
            width: '100%'
        });
    });

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

    function formatCurrency(input) {
        // Remove all non-digit characters
        let value = input.value.replace(/[^\d]/g, '');
        
        // Convert to number
        let num = parseInt(value || 0);
        
        // Store raw numeric value in hidden field
        document.getElementById('harga').value = num;
        
        // Format with thousand separators (Indonesian format)
        if(num > 0) {
            input.value = num.toLocaleString('id-ID');
        } else {
            input.value = '';
        }
    }

    // Initialize formatting when page loads
    document.addEventListener('DOMContentLoaded', function() {
        const hargaDisplay = document.getElementById('harga_display');
        if(hargaDisplay.value) {
            formatCurrency(hargaDisplay);
        }
    });
</script>

<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    .form-control:focus, .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    .no-image-placeholder {
        padding: 2rem 0;
    }
    .select2-container--default .select2-selection--multiple {
        min-height: 38px;
        padding: 5px;
        border: 1px solid #ced4da;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
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
</style>

@endsection