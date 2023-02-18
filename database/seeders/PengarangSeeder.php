<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pengarang')->insert([
            [
                "nama" => "Asmarani Rosalba",
                "nama_pena" => "Asma Nadia",
                "email" => "asmarani@gmail.com",
                "alamat" => "Jakarta",
            ],
            [
                "nama" => "Darwis Tere Liye",
                "nama_pena" => "Tere Liye",
                "email" => "darwistere@gmail.com",
                "alamat" => "Jakarta",
            ],
            [
                "nama" => "Heri Hendrayana Harris",
                "nama_pena" => "Gol A Gong",
                "email" => "herihendrayana@gmail.com",
                "alamat" => "Jakarta",
            ],
    ]);
    }
}
