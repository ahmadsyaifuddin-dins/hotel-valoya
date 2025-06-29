@extends('layouts.booking')

@section('container')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white py-3">
                    <h3 class="mb-0"><i class="bi bi-calendar-check me-2"></i> Form Pemesanan Kamar</h3>
                </div>
                <div class="card-body p-4">
                    <form action="/booking" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                        <!-- Customer Information Section -->
                        <div class="mb-4">
                            <h5 class="text-primary mb-3"><i class="bi bi-person-circle me-2"></i> Informasi Pemesan</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nama_pemesan" class="form-label">Nama Lengkap</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" class="form-control @error('nama_pemesan') is-invalid @enderror" 
                                               name="nama_pemesan" id="nama_pemesan" value="{{ old('nama_pemesan') }}" required autofocus>
                                    </div>
                                    @error('nama_pemesan')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="no_hp" class="form-label">Nomor Handphone</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                        <input type="tel" class="form-control @error('no_hp') is-invalid @enderror" 
                                               name="no_hp" id="no_hp" value="{{ old('no_hp') }}" required>
                                    </div>
                                    @error('no_hp')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                
                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required readonly>
                                    </div>
                                    @error('email')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Room Selection Section -->
                        <div class="mb-4">
                            <h5 class="text-primary mb-3"><i class="bi bi-door-open me-2"></i> Pilihan Kamar</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="tipe_kamar" class="form-label">Tipe Kamar</label>
                                    <select class="form-select @error('tipe_kamar_id') is-invalid @enderror" name="tipe_kamar_id" id="tipe_kamar">
                                        @foreach ($tipe_kamars as $tipe_kamar)
                                        <option value="{{ $tipe_kamar->id }}" data-harga="{{ $tipe_kamar->harga }}" data-stok="{{ $tipe_kamar->stok }}">
                                            {{ $tipe_kamar->nama }} - @rupiah($tipe_kamar->harga)/malam
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('tipe_kamar_id')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                    @enderror
                                    <input type="hidden" name="harga" id="harga" value="{{ old('harga', $tipe_kamars[0]->harga) }}">
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="jml_kamar" class="form-label">Jumlah Kamar</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-building"></i></span>
                                        <input type="number" class="form-control @error('jml_kamar') is-invalid @enderror" 
                                               name="jml_kamar" id="jml_kamar" value="{{ old('jml_kamar', 1) }}" 
                                               min="1" max="{{ $tipe_kamars[0]->stok }}" required>
                                    </div>
                                    <small class="text-muted">Tersedia: <span id="stok-info">{{ $tipe_kamars[0]->stok }}</span> kamar</small>
                                    @error('jml_kamar')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                    @enderror
                                    <input type="hidden" name="stok" id="stok" value="{{ old('stok', $tipe_kamars[0]->stok) }}">
                                    <input type="hidden" name="onbook" value="{{ old('onbook', $tipe_kamars[0]->onbook) }}">
                                </div>
                            </div>
                        </div>

                        <!-- Payment & Dates Section -->
                        <div class="mb-4">
                            <h5 class="text-primary mb-3"><i class="bi bi-credit-card me-2"></i> Pembayaran & Tanggal</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="payby" class="form-label">Metode Pembayaran</label>
                                    <select class="form-select" name="payby" id="payby" required>
                                        <option value="ONSITE" {{ old('payby') == 'ONSITE' ? 'selected' : '' }}>Bayar di Tempat (ONSITE)</option>
                                        <option value="ONLINE" {{ old('payby') == 'ONLINE' ? 'selected' : '' }}>Pembayaran Online</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">Durasi Menginap</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                        <input type="date" class="form-control @error('tgl_checkin') is-invalid @enderror" 
                                               name="tgl_checkin" id="tgl_checkin" value="{{ old('tgl_checkin') }}" required>
                                        <span class="input-group-text bg-light">sampai</span>
                                        <input type="date" class="form-control @error('tgl_checkout') is-invalid @enderror" 
                                               name="tgl_checkout" id="tgl_checkout" value="{{ old('tgl_checkout') }}" required>
                                    </div>
                                    @error('tgl_checkin')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                    @enderror
                                    @error('tgl_checkout')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                    @enderror
                                    <small class="text-muted">Booking minimal 1 hari sebelum check-in, misal hari ini 1 juli 2025 maka check-in harus diisi minimal 3 juli 2025</small>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg py-3">
                                <i class="bi bi-check-circle me-2"></i> Konfirmasi Pemesanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Dynamic Room Selection -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roomSelect = document.getElementById('tipe_kamar');
        const hargaInput = document.getElementById('harga');
        const stokInput = document.getElementById('stok');
        const stokInfo = document.getElementById('stok-info');
        const jmlKamarInput = document.getElementById('jml_kamar');

        roomSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const harga = selectedOption.getAttribute('data-harga');
            const stok = selectedOption.getAttribute('data-stok');
            
            hargaInput.value = harga;
            stokInput.value = stok;
            stokInfo.textContent = stok;
            jmlKamarInput.max = stok;
            
            // Reset jumlah kamar if exceeds new max
            if(parseInt(jmlKamarInput.value) > parseInt(stok)) {
                jmlKamarInput.value = stok;
            }
        });

        // Date validation - check-out must be after check-in
        const checkinInput = document.getElementById('tgl_checkin');
        const checkoutInput = document.getElementById('tgl_checkout');
        
        checkinInput.addEventListener('change', function() {
            if(this.value && checkoutInput.value && checkoutInput.value <= this.value) {
                checkoutInput.value = '';
            }
            checkoutInput.min = this.value;
        });
    });
</script>

<style>
    .card {
        border-radius: 15px;
        overflow: hidden;
    }
    .card-header {
        border-radius: 15px 15px 0 0 !important;
    }
    .form-control, .form-select {
        border-radius: 8px;
        padding: 10px 15px;
    }
    .form-control:focus, .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    .input-group-text {
        background-color: #f8f9fa;
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

<script src="/js/jquery.min.js"></script>
<script src="/js/jquery-migrate-3.0.1.min.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.easing.1.3.js"></script>
<script src="/js/jquery.waypoints.min.js"></script>
<script src="/js/jquery.stellar.min.js"></script>
<script src="/js/owl.carousel.min.js"></script>
<script src="/js/jquery.magnific-popup.min.js"></script>
<script src="/js/aos.js"></script>
<script src="/js/jquery.animateNumber.min.js"></script>
<script src="/js/bootstrap-datepicker.js"></script>
<script src="/js/scrollax.min.js"></script>
<script src="/js/google-map.js"></script>
<script src="/js/main.js"></script>

@endsection