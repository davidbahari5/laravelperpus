<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penerbit;
use App\Models\Buku;
use App\Models\Pengarang;
use App\Models\Pesan;
use Carbon\Carbon;

class StaffController extends Controller
{    
    public function buku(){
        $data = Buku::where('soft_delete', 0)
            ->with('Pengarang', 'Penerbit')
            ->orderBy('id_buku', 'DESC')
            ->get();

        $pengarang = Pengarang::where('soft_delete', 0)
        ->get();
        $penerbit = Penerbit::where('soft_delete', 0)
        ->get();
            
        return view('dashboard', [
            'data' => $data,
            'pengarang' => $pengarang,
            'penerbit' => $penerbit,
        ]);
    }

    public function tambahBuku(Request $request){
        $judul = $request->input('judul');
        $pengarang = $request->input('pengarang');
        $penerbit = $request->input('penerbit');
        $keterangan = $request->input('keterangan');
        $stock = $request->input('stock');
        $status = $request->input('status');
        $gambar = $request->file('gambar');

        $data = new Buku();
        $data->judul = $judul;
        $data->id_pengarang = $pengarang;
        $data->id_penerbit = $penerbit;
        $data->keterangan = $keterangan;
        $data->stock = $stock;
        $data->status = $status;
        $nama_file = time() . "_" . $gambar->getClientOriginalName();

        //isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'uploads/thumbnail/';
        //upload file
        $gambar->move($tujuan_upload, $nama_file);

        $data->gambar = $tujuan_upload . $nama_file;

        $data->save();
        return redirect('/dashboard');
    }

    public function editBuku(Request $request){
        $id_buku = $request->input('id_buku');
        $judul = $request->input('judul');
        $pengarang = $request->input('pengarang');
        $penerbit = $request->input('penerbit');
        $keterangan = $request->input('keterangan');
        $stock = $request->input('stock');
        $status = $request->input('status'); 
        $gambar = $request->file('gambar') ?? null;

        $data = Buku::find($id_buku);
        $data->judul = $judul;
        $data->id_pengarang = $pengarang;
        $data->id_penerbit = $penerbit;
        $data->keterangan = $keterangan;
        $data->stock = $stock;
        $data->status = $status;
        if($gambar){
            $nama_file = time() . "_" . $gambar->getClientOriginalName();

            //isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'uploads/gambar/';
            //upload file
            $gambar->move($tujuan_upload, $nama_file);

            $data->gambar = $tujuan_upload . $nama_file;
        }    

        $data->save();
        return redirect('/dashboard');
    }

    public function hapusBuku($id){
        $data = Buku::find($id);
        $data->soft_delete = 1;
        
        $data->save();
        return redirect('/dashboard');
    }

    public function pengarang(){
        $data = Pengarang::where('soft_delete', 0)
            ->orderBy('id_pengarang', 'DESC')
            ->get();

        return view('pengarang', ['data' => $data]);
    }

    public function tambahPengarang(Request $request){
        $nama = $request->input('nama');
        $nama_pena = $request->input('nama_pena');
        $email = $request->input('email');
        $alamat = $request->input('alamat');

        $data = new Pengarang();
        $data->nama = $nama;
        $data->nama_pena = $nama_pena;
        $data->email = $email;
        $data->alamat = $alamat;

        $data->save();
        return redirect('/pengarang');
    }

    public function editPengarang(Request $request){
        $id_pengarang = $request->input('id_pengarang');
        $nama = $request->input('nama');
        $nama_pena = $request->input('nama_pena');
        $email = $request->input('email');
        $alamat = $request->input('alamat');        

        $data = Pengarang::find($id_pengarang);
        $data->nama = $nama;
        $data->nama_pena = $nama_pena;
        $data->email = $email;
        $data->alamat = $alamat;

        $data->save();
        return redirect('/pengarang');
    }

    public function hapusPengarang($id){
        $data = Pengarang::find($id);
        $data->soft_delete = 1;
        
        $data->save();
        return redirect('/pengarang');
    }

    public function penerbit(){
        $data = Penerbit::where('soft_delete', 0)
            ->orderBy('id_penerbit', 'DESC')
            ->get();

        return view('penerbit', ['data' => $data]);
    }

    public function tambahPenerbit(Request $request){
        $nama = $request->input('nama');
        $email = $request->input('email');        
        $alamat = $request->input('alamat');        

        $data = new Penerbit();
        $data->nama = $nama;
        $data->email = $email;        
        $data->alamat = $alamat;
        
        $data->save();
        return redirect('/penerbit');
    }

    public function editPenerbit(Request $request){
        $id_penerbit = $request->input('id_penerbit');
        $nama = $request->input('nama');
        $email = $request->input('email');        
        $alamat = $request->input('alamat');        

        $data = Penerbit::find($id_penerbit);
        $data->nama = $nama;
        $data->email = $email;        
        $data->alamat = $alamat;                   

        $data->save();
        return redirect('/penerbit');
    }

    
    public function hapusPenerbit($id){
        $data = Penerbit::find($id);
        $data->soft_delete = 1;
        
        $data->save();
        return redirect('/penerbit');
    }    

    public function konfirmasi(){
        $data = Pesan::where('soft_delete', 0)
            ->with('Buku', 'Anggota')
            ->orderBy('id_pesan', 'DESC')
            ->get();

        return view('konfirmasi', ['data' => $data]);
    }       

    public function konfirmasiPembelian($id){
        $pesan = Pesan::find($id);
        $pesan->status = 1;        
        $pesan->save();
        return redirect('/konfirmasi');
    }
}
