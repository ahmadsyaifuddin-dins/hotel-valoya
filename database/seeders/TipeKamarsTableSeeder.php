<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipeKamarsTableSeeder extends Seeder
{
    public function run()
    {
        $tipe_kamars = [
            [
                'nama' => 'Standard Room',
                'harga' => 500000,
                'stok' => 10,
                'onbook' => 0,
                'onuse' => 0,
                'img' => 'standard.jpg'
            ],
            [
                'nama' => 'Superior Room',
                'harga' => 750000,
                'stok' => 8,
                'onbook' => 0,
                'onuse' => 0,
                'img' => 'superior.jpg'
            ],
            [
                'nama' => 'Deluxe Room',
                'harga' => 1000000,
                'stok' => 6,
                'onbook' => 0,
                'onuse' => 0,
                'img' => 'deluxe.jpg'
            ],
            [
                'nama' => 'Suite Room',
                'harga' => 1500000,
                'stok' => 4,
                'onbook' => 0,
                'onuse' => 0,
                'img' => 'suite.jpg'
            ]
        ];

        foreach ($tipe_kamars as $tipe) {
            DB::table('tipe_kamars')->insert(array_merge($tipe, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }
    }
}