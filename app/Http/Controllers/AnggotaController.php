<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Log;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Pesan;

class AnggotaController extends Controller
{
    public function katalog(){
        $data = Buku::where('soft_delete', 0)
            ->orderBy('id_buku', 'DESC')
            ->get();
        return view('katalog', ['data' => $data]);
    }

    public function sewaBuku(Request $request){
        $id_anggota = Session::get('id_anggota');
        $anggota = Anggota::find($id_anggota);
        $email_penyewa = $anggota->email;
        $id_buku = $request->input('id_buku');
        $buku = Buku::where('id_buku', $id_buku)
            ->first();
        $stock_lama = $buku->stock;        
        $stock_baru = (int)$stock_lama - 1;                
        $buku->stock = $stock_baru;
        
        
        $data = new Pesan();
        $data->id_anggota = $id_anggota;
        $data->id_buku = $id_buku;
        $data->email_penyewa = $email_penyewa;
        
        $buku->save();
        $data->save();
        return redirect('/history');
    }

    public function history(){
        $data = Pesan::where('soft_delete', 0)
            ->where('id_anggota', Session::get('id_anggota'))
            ->with('Buku')
            ->orderBy('id_pesan', 'DESC')
            ->get();

        return view('history', ['data' => $data]);
    }
}
