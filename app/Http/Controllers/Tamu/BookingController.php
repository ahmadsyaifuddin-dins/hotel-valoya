<?php

namespace App\Http\Controllers\Tamu;

use App\Http\Controllers\Controller;
use App\Models\BookingList;
use App\Models\TipeKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class BookingController extends Controller
{
    public function createID(TipeKamar $id)
    {
        return view('booking.createId', [
            "title" => "Booking",
            "tipe_kamar" => $id,
        ]);
    }

    public function create()
    {
        return view('booking.create', [
            "title" => "Booking",
            "tipe_kamars" => TipeKamar::all(),
        ]);
    }

    public function store(Request $request)
    {
        // Debug: Log semua request data
        Log::info('=== BOOKING DEBUG START ===');
        Log::info('Request Data:', $request->all());
        
        try {
            // Validasi dasar
            $validatedData = $request->validate([
                "nama_pemesan" => "required|max:255",
                "no_hp" => "required|numeric",
                "email" => "required|email",
                "jml_kamar" => "required|integer|min:1",
                'tgl_checkin' => 'required|date|after:today',
                'tgl_checkout' => 'required|date|after:tgl_checkin',
                'payby' => 'required|in:ONSITE,ONLINE',
            ]);
            
            Log::info('Validation passed:', $validatedData);

            // Validasi kondisional untuk bukti pembayaran
            if ($request->payby === 'ONLINE') {
                $buktiValidation = $request->validate([
                    'bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Ubah ke nullable
                ]);
                Log::info('Bukti validation passed:', $buktiValidation);
            }

            // Cek apakah tipe kamar ada
            $tipeKamar = TipeKamar::find($request->tipe_kamar_id);
            if (!$tipeKamar) {
                Log::error('Tipe kamar not found:', ['tipe_kamar_id' => $request->tipe_kamar_id]);
                return redirect()->back()->with('failed', 'Tipe kamar tidak ditemukan!');
            }
            
            Log::info('Tipe Kamar found:', $tipeKamar->toArray());

            // Fix jumlah_total jika kosong atau 0
            if ($tipeKamar->jumlah_total <= 0) {
                $tipeKamar->jumlah_total = $tipeKamar->stok;
                $tipeKamar->save();
                Log::info('Fixed jumlah_total:', ['new_jumlah_total' => $tipeKamar->jumlah_total]);
            }

            // Hitung kamar yang sedang dibooking
            $onbookSaatIni = BookingList::where('tipe_kamar_id', $tipeKamar->id)
                ->whereIn('status', ['DISETUJUI', 'DIBAYAR'])
                ->sum('jml_kamar');

            Log::info('Availability check:', [
                'onbook_saat_ini' => $onbookSaatIni,
                'request_jml_kamar' => $request->jml_kamar,
                'jumlah_total' => $tipeKamar->jumlah_total,
                'akan_melebihi' => ($onbookSaatIni + $request->jml_kamar) > $tipeKamar->jumlah_total
            ]);

            // Cek ketersediaan kamar
            if (($onbookSaatIni + $request->jml_kamar) > $tipeKamar->jumlah_total) {
                return redirect()->back()
                    ->withInput()
                    ->with('failed', 'Kamar tidak mencukupi! Tersedia: ' . ($tipeKamar->jumlah_total - $onbookSaatIni) . ' kamar');
            }

            // Mulai database transaction
            DB::beginTransaction();

            // Siapkan data untuk disimpan
            $validatedData["user_id"] = $request->user_id;
            $validatedData["tipe_kamar_id"] = $request->tipe_kamar_id;
            $validatedData["total"] = $this->jarakHari($request->tgl_checkin, $request->tgl_checkout) * $tipeKamar->harga * $request->jml_kamar;

            Log::info('Total calculated:', ['total' => $validatedData["total"]]);

            // Set payment data berdasarkan metode pembayaran
            if ($request->payby == "ONSITE") {
                $validatedData["PayBy"] = "ONSITE";
                $validatedData["PayEnd"] = 0;
                $validatedData["status"] = "DISETUJUI";
                $validatedData['bukti'] = null; // Explicit null untuk ONSITE
            } else {
                $validatedData["PayBy"] = "ONLINE";
                $validatedData["PayEnd"] = 1;
                $validatedData["status"] = "DIBAYAR";
                
                // Upload bukti pembayaran
                if ($request->hasFile('bukti')) {
                    $validatedData['bukti'] = $request->file('bukti')->store('bukti-pembayaran', 'public');
                    Log::info('File uploaded:', ['bukti' => $validatedData['bukti']]);
                } else {
                    $validatedData['bukti'] = null; // Null jika tidak ada file
                    Log::info('No file uploaded for ONLINE payment');
                }
            }

            // Generate kode booking
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $validatedData["kode_booking"] = date('dmy') . $this->generate_string($permitted_chars, 6) . date('His');
            
            Log::info('Final data to save:', $validatedData);

            // Simpan booking
            $booking = BookingList::create($validatedData);

            if (!$booking) {
                throw new Exception('Gagal menyimpan data booking');
            }
            
            Log::info('Booking created successfully:', ['booking_id' => $booking->id]);

            // Update stok dan onbook
            $onbookBaru = BookingList::where('tipe_kamar_id', $tipeKamar->id)
                ->whereIn('status', ['DISETUJUI', 'DIBAYAR'])
                ->sum('jml_kamar');

            $updateResult = $tipeKamar->update([
                'onbook' => $onbookBaru,
                'stok' => $tipeKamar->jumlah_total - $onbookBaru,
            ]);

            if (!$updateResult) {
                throw new Exception('Gagal mengupdate stok kamar');
            }
            
            Log::info('Stok updated successfully:', ['onbook' => $onbookBaru, 'stok' => $tipeKamar->jumlah_total - $onbookBaru]);

            // Commit transaction
            DB::commit();
            
            Log::info('=== BOOKING SUCCESS ===');

            return redirect('/mybookinglist/' . $request->user_id)->with('success', 'Booking Berhasil! Simpan Kartu Pesanan ini!');

        } catch (Exception $e) {
            // Rollback transaction jika ada error
            DB::rollback();
            
            // Log error untuk debugging
            Log::error('=== BOOKING ERROR ===');
            Log::error('Error Message: ' . $e->getMessage());
            Log::error('Stack Trace: ' . $e->getTraceAsString());
            Log::error('Request Data: ', $request->all());

            return redirect()->back()
                ->withInput()
                ->with('failed', 'Terjadi kesalahan saat memproses booking. Silakan coba lagi. Error: ' . $e->getMessage());
        }
    }

    public function batalkan(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            $today = time();
            $tgl = explode('-', $request->tgl_checkin);
            $jam = (int)((mktime(0, 0, 0, $tgl[1], $tgl[2], $tgl[0]) - $today) / 3600);

            if ($jam < 24) {
                return redirect('/mybookinglist/' . auth()->user()->id)
                    ->with('failed', 'Tidak bisa membatalkan booking. Maksimal pembatalan sebelum h-1 tanggal check-in.');
            }

            $result = BookingList::where('kode_booking', $request->kode)
                ->update(['status' => "DIBATALKAN"]);

            if (!$result) {
                return redirect('/mybookinglist/' . auth()->user()->id)
                    ->with('failed', 'Booking tidak ditemukan atau sudah dibatalkan.');
            }

            return redirect('/mybookinglist/' . auth()->user()->id)
                ->with('success', 'Pembatalan booking berhasil.');

        } catch (Exception $e) {
            Log::error('Cancellation Error: ' . $e->getMessage());
            return redirect('/mybookinglist/' . auth()->user()->id)
                ->with('failed', 'Terjadi kesalahan saat membatalkan booking.');
        }
    }

    public function jarakHari($tgl_checkin, $tgl_checkout)
    {
        $tgl1 = strtotime($tgl_checkin);
        $tgl2 = strtotime($tgl_checkout);
        $jarak = $tgl2 - $tgl1;
        $hari = $jarak / 60 / 60 / 24;
        return $hari;
    }

    public function konfersiOnbook($onbook)
    {
        if ($onbook == null) {
            return 0;
        } else {
            return $onbook;
        }
    }

    public function generate_string($input, $strength = 16)
    {
        $input_length = strlen($input);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        return $random_string;
    }
}