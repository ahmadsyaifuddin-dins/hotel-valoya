@extends('layouts.booking')

@section('container')

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-primary mb-3">
            <i class="bi bi-journal-text me-2"></i> My Booking Lists
        </h1>
        <h3 class="text-dark">Halo, {{ $user->nama }}</h3>
    </div>

    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show col-lg-8 mx-auto" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session()->has('failed'))
    <div class="alert alert-danger alert-dismissible fade show col-lg-8 mx-auto" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('failed') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if($booking_lists->isEmpty())
    <div class="text-center py-5">
        <div class="card border-0 shadow-sm py-5">
            <i class="bi bi-calendar-x text-muted" style="font-size: 3rem;"></i>
            <h3 class="text-muted mt-3">No Bookings Found</h3>
            <p class="text-muted">You haven't made any bookings yet</p>
            <a href="/" class="btn btn-primary mt-3">
                <i class="bi bi-search me-2"></i> Find Rooms
            </a>
        </div>
    </div>
    @else
    <div class="row g-4">
        @foreach ($booking_lists as $booking)
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-sm overflow-hidden">
                <div class="card-header p-0">
                    <div class="d-flex justify-content-between align-items-center bg-primary text-white p-3">
                        <span class="badge bg-white text-primary fs-6">
                            ID: {{ $booking->kode_booking }}
                        </span>
                        <span class="badge 
                            @if($booking->status == 'DISETUJUI') bg-info
                            @elseif($booking->status == 'SUKSES') bg-success
                            @elseif($booking->status == 'DIBAYAR') bg-secondary text-dark
                            @elseif($booking->status == 'DITOLAK') bg-danger
                            @elseif($booking->status == 'CHECKIN') bg-info text-danger fw-bold
                            @elseif($booking->status == 'CHECKOUT') bg-info text-dark fw-bold
                            @elseif($booking->status == 'DIBATALKAN') bg-danger
                            @endif">
                            {{ $booking->status }}
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-title fw-bold mb-0">
                            {{ $booking->tipeKamars->nama }}
                            <span class="text-muted">x{{ $booking->jml_kamar }}</span>
                        </h5>
                        <h4 class="text-primary">@rupiah($booking->total)</h4>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-person-circle me-2 text-muted"></i>
                            <span>{{ $booking->nama_pemesan }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-calendar-event me-2 text-muted"></i>
                            <span>
                                {{ date('d M Y', strtotime($booking->tgl_checkin)) }} - 
                                {{ date('d M Y', strtotime($booking->tgl_checkout)) }}
                                ({{ \Carbon\Carbon::parse($booking->tgl_checkin)->diffInDays($booking->tgl_checkout) }} malam)
                            </span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-credit-card me-2 text-muted"></i>
                            <span>Payment: {{ $booking->PayBy }}</span>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="/mybookinglist-print/{{ $booking->id }}" class="btn btn-outline-primary">
                            <i class="bi bi-printer me-2"></i> Print Receipt
                        </a>

                        @if ($booking->status == "DISETUJUI" || $booking->status == "DIBAYAR")
                        <form action="/booking/batalkan" method="post" class="mt-1">
                            @csrf
                            <input type="hidden" name="kode" value="{{ $booking->kode_booking }}">
                            <input type="hidden" name="tgl_checkin" value="{{ $booking->tgl_checkin }}">

                            @if (date('Y-m-d') == $booking->tgl_checkin)
                            <button class="btn btn-outline-danger w-100" type="submit" disabled>
                                <i class="bi bi-x-circle me-2"></i> Cancel Booking
                            </button>
                            @else
                            <button class="btn btn-outline-danger w-100" type="submit"
                                onclick="return confirm('Are you sure you want to cancel this booking?')">
                                <i class="bi bi-x-circle me-2"></i> Cancel Booking
                            </button>
                            @endif
                            <small class="d-block text-muted text-center mt-2">
                                <i class="bi bi-info-circle me-1"></i> Max cancellation 1 day before check-in
                            </small>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

<style>
    .card {
        border-radius: 12px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .badge {
        font-size: 0.85em;
        padding: 0.5em 0.8em;
        font-weight: 500;
    }
    .btn-outline-primary, .btn-outline-danger{
        border-width: 2px;
    }
</style>

<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
            stroke="#F96D00" />
    </svg></div>


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