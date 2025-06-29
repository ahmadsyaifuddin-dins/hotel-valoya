<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingList extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'user_id', 'tipe_kamar_id', 'nama_pemesan', 'no_hp', 'email', 
        'jml_kamar', 'tgl_checkin', 'tgl_checkout', 'total', 'PayBy', 
        'PayEnd', 'status', 'bukti', 'kode_booking'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tipeKamars()
    {
        return $this->belongsTo(TipeKamar::class, 'tipe_kamar_id');
    }
}
