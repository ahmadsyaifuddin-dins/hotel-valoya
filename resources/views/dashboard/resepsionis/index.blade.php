@extends('dashboard.layouts.main')

@section('container')

<style>
    .group {
        display: flex;
        line-height: 28px;
        align-items: center;
        position: relative;
        max-width: 190px;
    }

    .input {
        width: 100%;
        height: 40px;
        line-height: 28px;
        padding: 0 1rem;
        padding-left: 2.5rem;
        border: 2px solid transparent;
        border-radius: 8px;
        outline: none;
        background-color: #fff;
        color: #0d0c22;
        transition: .3s ease;
    }

    .input::placeholder {
        color: #9e9ea7;
    }

    .input:focus,
    input:hover {
        outline: none;
        border-color: rgba(234, 76, 137, 0.4);
        background-color: #fff;
        box-shadow: 0 0 0 4px rgb(234 76 137 / 10%);
    }

    .icon {
        position: absolute;
        left: 1rem;
        fill: #9e9ea7;
        width: 1rem;
        height: 1rem;
    }
</style>

@if (!$search)
<div class="row mb-3 border-bottom">
    <div class="col-md-12">
        <h1 class="h2 text-center mt-2">Cari Booking</h1>
    </div>
    <div class="col-md-12 my-3">
        <form action="/resepsionis" method="POST">
            @csrf
            <div class="row">
                <label for="kode" class="col-sm-2 col-form-label">Booking ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="kode" id="kode" placeholder="Search">
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>

@else
@if (session()->has('success'))
<div class="alert alert-primary alert-dismissible fade show col-lg-12" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session()->has('failed'))
<div class="alert alert-danger alert-dismissible fade show col-lg-12" role="alert">
    {{ session('failed') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row mb-3 border-bottom">
    <div class="col-md-12">
        <h1 class="h2 text-center mt-2">Cari Booking</h1>
    </div>
    <div class="col-md-12 my-3">
        <form action="/resepsionis" method="POST">
            @csrf
            <div class="row">
                <label for="kode" class="col-sm-2 col-form-label">Booking ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="kode" id="kode" placeholder="Search"
                        value="{{ $kode }}">
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>

@foreach ($pesanan as $item)

@if (in_array($item->status, ["DISETUJUI", "DIBAYAR", "CHECKIN", "SUKSES", "DIBATALKAN", "DITOLAK"]))
<div class="card text-center mb-3">
    <div class="card-body">
        <h5 class="card-title">{{ $item->kode_booking }}</h5>
        <div class="row">
            <div class="col-sm-4">
                <p class="card-text">Pemesan : {{ $item->nama_pemesan }}</p>
                <p class="card-text">Tanggal Check-in : {{ $item->tgl_checkin }}</p>
                <p class="card-text">Tanggal Check-out : {{ $item->tgl_checkout }}</p>
            </div>
            <div class="col-sm-4">
                <p class="card-text">Status :
                    @switch($item->status)
                    @case("DISETUJUI")
                    <span class="bg-warning p-2 border rounded text-dark fw-bold">{{ $item->status }}</span>
                    @break

                    @case("DIBAYAR")
                    <span class="bg-info p-2 border rounded text-dark fw-bold">{{ $item->status }}</span>
                    @break

                    @case("CHECKIN")
                    <span class="bg-primary p-2 border rounded text-dark fw-bold">{{ $item->status }}</span>
                    @break

                    @case("SUKSES")
                    <span class="bg-success p-2 border rounded text-dark fw-bold">{{ $item->status }}</span>
                    @break

                    @case("DIBATALKAN")
                    <span class="bg-danger p-2 border rounded text-dark fw-bold">{{ $item->status }}</span>
                    @break

                    @case("DITOLAK")
                    <span class="bg-danger p-2 border rounded text-white fw-bold">{{ $item->status }}</span>
                    @break
                    @endswitch
                </p>
                <p class="card-text">Nama Kamar : {{ $item->tipeKamars->nama }}</p>
                <p class="card-text">Pay by : {{ $item->PayBy }}</p>
                <p class="card-text">Total biaya : @rupiah($item->total)</p>
            </div>
            <div class="col-sm-4">
                {{-- === STATUS DISETUJUI (ONSITE) === --}}
                @if ($item->status == "DISETUJUI" && $item->PayBy == "ONSITE")
                <form action="/resepsionis/bayar" method="POST">
                    @csrf
                    <input type="hidden" name="kode" value="{{ $item->kode_booking }}">
                    <button type="submit" class="btn btn-primary">Bayar</button>
                </form>
                <button class="btn btn-success mt-2" disabled>Check-in</button>
                @endif

                {{-- === STATUS DIBAYAR (ONLINE) === --}}
                @if ($item->status == "DIBAYAR" && $item->PayBy == "ONLINE")
                <a href="{{ asset('storage/' . $item->bukti) }}" class="btn btn-warning mb-2" target="_blank">
                    Lihat Bukti Pembayaran
                </a>
                <form action="/resepsionis/verifikasi" method="POST">
                    @csrf
                    <input type="hidden" name="kode" value="{{ $item->kode_booking }}">
                    <button type="submit" class="btn btn-success">Verifikasi</button>
                </form>
                <form action="/resepsionis/tolak" method="POST" onsubmit="return confirm('Yakin ingin menolak pembayaran ini?')">
                    @csrf
                    <input type="hidden" name="kode" value="{{ $item->kode_booking }}">
                    <button type="submit" class="btn btn-danger mt-2">Tolak</button>
                </form>
                @endif

                {{-- === STATUS DISETUJUI (ONLINE) === --}}
                @if ($item->status == "DISETUJUI" && $item->PayBy == "ONLINE")
                <form action="/resepsionis/checkin" method="POST">
                    @csrf
                    <input type="hidden" name="kode" value="{{ $item->kode_booking }}">
                    <input type="hidden" name="jml_kamar" value="{{ $item->jml_kamar }}">
                    <input type="hidden" name="tgl_checkin" value="{{ $item->tgl_checkin }}">
                    <input type="hidden" name="id_kamar" value="{{ $item->tipeKamars->id }}">
                    <input type="hidden" name="onbook" value="{{ $item->tipeKamars->onbook }}">
                    <input type="hidden" name="onuse" value="{{ $item->tipeKamars->onuse }}">
                    <button type="submit" class="btn btn-success">Check-in</button>
                </form>
                @endif

                {{-- === STATUS DIBAYAR (ONSITE) === --}}
                @if ($item->status == "DIBAYAR" && $item->PayBy == "ONSITE")
                <form action="/resepsionis/checkin" method="POST">
                    @csrf
                    <input type="hidden" name="kode" value="{{ $item->kode_booking }}">
                    <input type="hidden" name="jml_kamar" value="{{ $item->jml_kamar }}">
                    <input type="hidden" name="tgl_checkin" value="{{ $item->tgl_checkin }}">
                    <input type="hidden" name="id_kamar" value="{{ $item->tipeKamars->id }}">
                    <input type="hidden" name="onbook" value="{{ $item->tipeKamars->onbook }}">
                    <input type="hidden" name="onuse" value="{{ $item->tipeKamars->onuse }}">
                    <button type="submit" class="btn btn-success">Check-in</button>
                </form>
                @endif

                {{-- === STATUS CHECKIN === --}}
                @if ($item->status == "CHECKIN")
                <p class="card-text">Telah Check-in</p>
                <form action="/resepsionis/checkout" method="POST">
                    @csrf
                    <input type="hidden" name="kode" value="{{ $item->kode_booking }}">
                    <input type="hidden" name="jml_kamar" value="{{ $item->jml_kamar }}">
                    <input type="hidden" name="id_kamar" value="{{ $item->tipeKamars->id }}">
                    <input type="hidden" name="stok" value="{{ $item->tipeKamars->stok }}">
                    <input type="hidden" name="onuse" value="{{ $item->tipeKamars->onuse }}">
                    <button type="submit" class="btn btn-info">Check-out</button>
                </form>
                @endif

            </div>
        </div>
    </div>
</div>

@endif
@endforeach

@endif

@endsection