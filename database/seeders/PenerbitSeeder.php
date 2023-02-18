<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenerbitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('penerbit')->insert([
            [
                "nama" => "Gramedia Pustaka Utama",            
                "email" => "gramedia@gmail.com",
                "alamat" => "Jakarta",
            ],
            [
                "nama" => "Inari",            
                "email" => "Naskah.Inari@gmail.com",
                "alamat" => "Jakarta",
            ],
            [
                "nama" => "Erlangga",            
                "email" => "erlangga@gmail.com",
                "alamat" => "Jakarta",
            ],
        ]);
    }
}
