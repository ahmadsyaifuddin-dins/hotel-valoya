<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\BookingList;
use App\Models\TipeKamar;
use Illuminate\Http\Request;

class BookingListController extends Controller
{
    public function index()
    {
        return view('dashboard.resepsionis.index', [
            "search" => false,
        ]);
    }

    public function search(Request $request)
    {
        return view('dashboard.resepsionis.index', [
            "search" => true,
            "pesanan" => BookingList::with(['tipeKamars'])->where('kode_booking', $request->kode)->get(),
            "kode" => $request->kode,
        ]);
    }

    public function bayar(Request $request)
    {
        $booking = BookingList::where('kode_booking', $request->kode)->first();
        $booking->update([
            'PayEnd' => 1,
            'status' => "DIBAYAR"
        ]);

        // Recalculate stok & onbook
        $tipeKamar = TipeKamar::find($booking->tipe_kamar_id);
        $this->refreshStokOnbook($tipeKamar);

        $request->session()->flash('success', 'Pembayaran berhasil!');

        return view('dashboard.resepsionis.index', [
            "search" => true,
            "pesanan" => BookingList::with(['tipeKamars'])->where('kode_booking', $request->kode)->get(),
            "kode" => $request->kode,
        ]);
    }

    public function checkin(Request $request)
    {
        date_default_timezone_set('Asia/Makassar');
        if (date('Y-m-d', strtotime("now")) == $request->tgl_checkin) {

            $onbook = $this->konfersiOnbook($request->onbook);
            $onuse = $this->konfersiOnuse($request->onuse);

            $jml_onbook = $onbook - $request->jml_kamar;
            $jml_onuse = $onuse + $request->jml_kamar;

            BookingList::where('kode_booking', $request->kode)
                ->update([
                    'status' => "CHECKIN"
                ]);

            TipeKamar::where('id', $request->id_kamar)
                ->update([
                    'onbook' => $jml_onbook,
                    'onuse' => $jml_onuse
                ]);

            $request->session()->flash('success', 'Check-in berhasil!');

            return view('dashboard.resepsionis.index', [
                "search" => true,
                "pesanan" => BookingList::with(['tipeKamars'])->where('kode_booking', $request->kode)->get(),
                "kode" => $request->kode,
            ]);
        } else {
            $request->session()->flash('failed', 'Maaf hari ini bukan tanggal check-in Anda.');

            return view('dashboard.resepsionis.index', [
                "search" => true,
                "pesanan" => BookingList::with(['tipeKamars'])->where('kode_booking', $request->kode)->get(),
                "kode" => $request->kode,
            ]);
        }
    }

    public function checkout(Request $request)
    {
        $onuse = $this->konfersiOnuse($request->onuse);
        $jml_onuse = $onuse - $request->jml_kamar;

        $stok = $request->stok + $request->jml_kamar;

        BookingList::where('kode_booking', $request->kode)
            ->update([
                'status' => "SUKSES"
            ]);

        TipeKamar::where('id', $request->id_kamar)
            ->update([
                'onuse' => $jml_onuse,
                'stok' => $stok,
            ]);

        $request->session()->flash('success', 'Check-out berhasil! Terimakasih atas kunjungannya!');

        return view('dashboard.resepsionis.index', [
            "search" => true,
            "pesanan" => BookingList::with(['tipeKamars'])->where('kode_booking', $request->kode)->get(),
            "kode" => $request->kode,
        ]);
    }

    public function verifikasiPembayaran(Request $request)
    {
        $booking = BookingList::where('kode_booking', $request->kode)->first();
        $booking->update([
            'status' => 'DISETUJUI'
        ]);

        $tipeKamar = TipeKamar::find($booking->tipe_kamar_id);
        $this->refreshStokOnbook($tipeKamar);

        $request->session()->flash('success', 'Pembayaran online berhasil diverifikasi!');

        return view('dashboard.resepsionis.index', [
            "search" => true,
            "pesanan" => BookingList::with(['tipeKamars'])->where('kode_booking', $request->kode)->get(),
            "kode" => $request->kode,
        ]);
    }


    public function tolakPembayaran(Request $request)
    {
        $booking = BookingList::where('kode_booking', $request->kode)->first();
        if (!$booking) {
            return redirect('/resepsionis')->with('failed', 'Booking tidak ditemukan.');
        }

        $booking->update(['status' => 'DITOLAK']);

        $tipeKamar = TipeKamar::find($booking->tipe_kamar_id);
        $this->refreshStokOnbook($tipeKamar);

        $request->session()->flash('failed', 'Pembayaran online berhasil ditolak!');

        return view('dashboard.resepsionis.index', [
            "search" => true,
            "pesanan" => BookingList::with(['tipeKamars'])->where('kode_booking', $request->kode)->get(),
            "kode" => $request->kode,
        ]);
    }


    public function konfersiOnbook($onbook)
    {
        if ($onbook == null) {
            return 0;
        } else {
            return $onbook;
        }
    }

    public function konfersiOnuse($onuse)
    {
        if ($onuse == null) {
            return 0;
        } else {
            return $onuse;
        }
    }

    private function refreshStokOnbook($tipeKamar)
    {
        $jumlahOnbook = BookingList::where('tipe_kamar_id', $tipeKamar->id)
            ->whereIn('status', ['DISETUJUI', 'DIBAYAR'])
            ->sum('jml_kamar');

        $tipeKamar->update([
            'onbook' => $jumlahOnbook,
            'stok' => $tipeKamar->jumlah_total - $jumlahOnbook,
        ]);
    }
}
