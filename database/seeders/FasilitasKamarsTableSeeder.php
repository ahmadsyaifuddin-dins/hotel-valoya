<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FasilitasKamarsTableSeeder extends Seeder
{
    public function run()
    {
        $fasilitas = [
            ['nama' => 'AC', 'img' => 'ac.jpg'],
            ['nama' => 'TV LED 32"', 'img' => 'tv.jpg'],
            ['nama' => 'Kamar Mandi', 'img' => 'kamar-mandi.jpg'],
            ['nama' => 'Shower Panas/Dingin', 'img' => 'shower.jpg'],
            ['nama' => 'Free WiFi', 'img' => 'wifi.jpg'],
            ['nama' => 'Minibar', 'img' => 'minibar.jpg'],
            ['nama' => 'Televisi Kabel', 'img' => 'tv-kabel.jpg'],
            ['nama' => 'Telepon', 'img' => 'telepon.jpg'],
            ['nama' => 'Brankas', 'img' => 'brankas.jpg'],
            ['nama' => 'Pengering Rambut', 'img' => 'hair-dryer.jpg'],
        ];

        foreach ($fasilitas as $item) {
            DB::table('fasilitas_kamars')->insert([
                'nama' => $item['nama'],
                'img' => $item['img'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}