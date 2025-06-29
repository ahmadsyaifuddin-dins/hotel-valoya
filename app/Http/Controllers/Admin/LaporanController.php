<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingList;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        return view('dashboard.laporan.index', [
            "booking_lists" => BookingList::with(['tipeKamars'])->latest()->where('status', 'SUKSES')->get()
        ]);
    }

    public function exportPDF()
    {
        // Set timezone to WITA (Central Indonesia Time)
        date_default_timezone_set('Asia/Makassar');
        
        $booking_lists = BookingList::with(['tipeKamars'])
            ->latest()
            ->where('status', 'SUKSES')
            ->get();

        // Get current date in Indonesian format
        $months = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember'
        ];
        
        $waktuCetak = Carbon::now()->translatedFormat('d F Y H:i');
        $waktuCetak = str_replace(array_keys($months), array_values($months), $waktuCetak);

        $pdf = Pdf::loadView('dashboard.laporan.pdf', compact('booking_lists', 'waktuCetak'));

        return $pdf->download('laporan-transaksi.pdf');
    }
}