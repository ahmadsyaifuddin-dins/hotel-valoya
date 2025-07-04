@extends('layouts.booking')

@section('container')

@if ($tipe_kamar->stok > 1)

<div class="container">
    <form action="/booking" method="POST" enctype="multipart/form-data">
        @if(session('debug'))
        <div class="alert alert-info">
            <strong>Debug Info:</strong>
            <pre>{{ session('debug') }}</pre>
        </div>
        @endif
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <div class="mb-3" style="margin-top: 30px; width: 100%;">
            <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
            <input type="text" class="form-control @error('nama_pemesan') is-invalid @enderror" name="nama_pemesan"
                id="nama_pemesan" value="{{ old('nama_pemesan') }}" required autofocus>
            @error('nama_pemesan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3" style="width: 100%;">
            <label for="no_hp" class="form-label">Nomor Handphone</label>
            <input type="number" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" id="no_hp"
                value="{{ old('no_hp') }}" required>
            @error('no_hp')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3" style="width: 100%;">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                value="{{ old('email', auth()->user()->email) }}" required readonly>
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3" style="width: 100%;">
            <input type="hidden" name="tipe_kamar_id" value="{{ old('tipe_kamar_id', $tipe_kamar->id) }}">
            @error('tipe_kamar_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
            <input type="hidden" name="harga" value="{{ old('harga', $tipe_kamar->harga) }}">
            <label for="nama_kamar" class="form-label">Nama Kamar</label>
            <input type="text" class="form-control @error('nama_kamar') is-invalid @enderror" name="nama_kamar"
                id="nama_kamar" value="{{ old('nama_kamar', $tipe_kamar->nama) }}" required readonly>
            @error('nama_kamar')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3" style="width: 100%;">
            <input type="hidden" name="stok" value="{{ old('stok', $tipe_kamar->stok) }}">
            <input type="hidden" name="onbook" value="{{ old('onbook', $tipe_kamar->onbook) }}">
            <label for="jml_kamar" class="form-label">Jumlah Kamar</label>
            <input type="number" class="form-control @error('jml_kamar') is-invalid @enderror" name="jml_kamar"
                id="jml_kamar" value="{{ old('jml_kamar') }}" min="1" max="{{ $tipe_kamar->stok }}" required>
            @error('jml_kamar')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <!-- Metode Pembayaran -->
        <div class="mb-3" style="width: 100%;">
            <label for="payby" class="form-label">Pilih Metode Pembayaran</label>
            <select class="form-control" name="payby" id="payby" required>
                <option value="ONSITE" {{ old('payby')=='ONSITE' ? 'selected' : '' }}>ONSITE</option>
                <option value="ONLINE" {{ old('payby')=='ONLINE' ? 'selected' : '' }}>ONLINE</option>
            </select>
        </div>

        <!-- Upload Bukti Pembayaran (Khusus ONLINE) -->
        <div class="mb-3" id="bukti-pembayaran" style="display: none;">
            <label for="bukti" class="form-label">Upload Bukti Pembayaran</label>
            <input type="file" class="form-control @error('bukti') is-invalid @enderror" name="bukti" accept="image/*">
            @error('bukti')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md d-flex">
                <div class="form-group align-self-stretch d-flex align-items-end">
                    <div class="wrap align-self-stretch">
                        <label for="tgl_checkin">Tanggal Check-in</label>
                        <input type="date" class="form-control" name="tgl_checkin" id="tgl_checkin"
                            placeholder="Tanggal Check-in" required>
                        @error('tgl_checkin')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md d-flex">
                <div class="form-group align-self-stretch d-flex align-items-end">
                    <div class="wrap align-self-stretch">
                        <label for="tgl_checkout">Tanggal Check-out</label>
                        <input type="date" class="form-control" name="tgl_checkout" id="tgl_checkout" required>
                        @error('tgl_checkout')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <small class="mb-3">Booking kamar minimal 1 hari sebelum tanggal check-in, misal hari ini 1 juli 2025 maka
                check-in harus diisi minimal 3 juli 2025</small>
        </div>
        <button type="submit" class="btn btn-primary" id="submit" style="margin-bottom: 20px; width: 300px;">Booking
            Kamar</button>
    </form>
</div>


@else
<center>
    <h1 class="mt-5"> <span class="text-danger">Maaf seluruh Kamar {{ $tipe_kamar->nama }} telah dipesan! </span></h1>
</center>
<center>
    <a href="/tipeKamar" class="btn btn-primary">Pesan Kamar Lain <i class="bi bi-arrow-right"></i></a>
</center>
@endif


<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
            stroke="#F96D00" />
    </svg></div>

<script>
    $(document).ready(function () {
            function toggleBukti() {
                if ($('#payby').val() === 'ONLINE') {
                    $('#bukti-pembayaran').show();
                } else {
                    $('#bukti-pembayaran').hide();
                }
            }
    
            $('#payby').on('change', toggleBukti);
            toggleBukti(); // trigger awal saat page load
        });
</script>

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