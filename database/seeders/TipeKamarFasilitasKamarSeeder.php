<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipeKamarFasilitasKamarSeeder extends Seeder
{
    public function run()
    {
        // Assign facilities to room types
        $assignments = [
            // Standard Room gets facilities 1-5
            ['tipe_kamar_id' => 1, 'fasilitas_kamar_id' => 1],
            ['tipe_kamar_id' => 1, 'fasilitas_kamar_id' => 2],
            ['tipe_kamar_id' => 1, 'fasilitas_kamar_id' => 3],
            ['tipe_kamar_id' => 1, 'fasilitas_kamar_id' => 4],
            ['tipe_kamar_id' => 1, 'fasilitas_kamar_id' => 5],
            
            // Superior Room gets facilities 1-7
            ['tipe_kamar_id' => 2, 'fasilitas_kamar_id' => 1],
            ['tipe_kamar_id' => 2, 'fasilitas_kamar_id' => 2],
            ['tipe_kamar_id' => 2, 'fasilitas_kamar_id' => 3],
            ['tipe_kamar_id' => 2, 'fasilitas_kamar_id' => 4],
            ['tipe_kamar_id' => 2, 'fasilitas_kamar_id' => 5],
            ['tipe_kamar_id' => 2, 'fasilitas_kamar_id' => 6],
            ['tipe_kamar_id' => 2, 'fasilitas_kamar_id' => 7],
            
            // Deluxe Room gets facilities 1-9
            ['tipe_kamar_id' => 3, 'fasilitas_kamar_id' => 1],
            ['tipe_kamar_id' => 3, 'fasilitas_kamar_id' => 2],
            ['tipe_kamar_id' => 3, 'fasilitas_kamar_id' => 3],
            ['tipe_kamar_id' => 3, 'fasilitas_kamar_id' => 4],
            ['tipe_kamar_id' => 3, 'fasilitas_kamar_id' => 5],
            ['tipe_kamar_id' => 3, 'fasilitas_kamar_id' => 6],
            ['tipe_kamar_id' => 3, 'fasilitas_kamar_id' => 7],
            ['tipe_kamar_id' => 3, 'fasilitas_kamar_id' => 8],
            ['tipe_kamar_id' => 3, 'fasilitas_kamar_id' => 9],
            
            // Suite Room gets all facilities
            ['tipe_kamar_id' => 4, 'fasilitas_kamar_id' => 1],
            ['tipe_kamar_id' => 4, 'fasilitas_kamar_id' => 2],
            ['tipe_kamar_id' => 4, 'fasilitas_kamar_id' => 3],
            ['tipe_kamar_id' => 4, 'fasilitas_kamar_id' => 4],
            ['tipe_kamar_id' => 4, 'fasilitas_kamar_id' => 5],
            ['tipe_kamar_id' => 4, 'fasilitas_kamar_id' => 6],
            ['tipe_kamar_id' => 4, 'fasilitas_kamar_id' => 7],
            ['tipe_kamar_id' => 4, 'fasilitas_kamar_id' => 8],
            ['tipe_kamar_id' => 4, 'fasilitas_kamar_id' => 9],
            ['tipe_kamar_id' => 4, 'fasilitas_kamar_id' => 10],
        ];

        DB::table('tipe_kamars_fasilitas_kamars')->insert($assignments);
    }
}