<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\Staff;
use App\Models\Anggota;

class AuthController extends Controller
{
    public function login(){
        if(Session::has('logged')){
            if(Session::get('logged') == 'staff') return redirect('/buku');
            else return redirect('/katalog');

        }else{
            return view('login');
        }
    }

    public function register(){
        return view('register');
    }

    public function authenticate(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');        

        if($username == "staff" && $password == "staff"){
            Session::put('logged', 'staff');
            return redirect('/dashboard');
        }else{
            $anggota = Anggota::where('username', $username)
                ->where('password', $password)
                ->where('soft_delete', 0)
                ->first();

            if($anggota){
                Session::put('logged', 'anggota');
                Session::put('id_anggota', $anggota->id_anggota);
                return redirect('/katalog');

            }else{
                return redirect()->back()->with('error', 'Data anggota tidak ditemukan');
            }
        }
    }

    public function tambahAnggota(Request $request){
        $nama = $request->input('nama');
        $email = $request->input('email');        
        $alamat = $request->input('alamat');
        $username = $request->input('username');
        $password = $request->input('password');        

        $data = new Anggota();
        $data->nama = $nama;
        $data->email = $email;        
        $data->alamat = $alamat;
        $data->username = $username;
        $data->password = $password;        

        $data->save();
        return redirect('/');
    }

    public function logout(){
        Session::flush();
        return redirect('/');
    }
}
