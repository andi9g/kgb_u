<?php

namespace App\Http\Controllers;

use App\Models\adminM;
use Hash;
use Illuminate\Http\Request;

class aksesC extends Controller
{
    public function login()
    {
        return view('pages.pageslogin');
    }

    public function proses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        try{
            $username = $request->username;
            $password = $request->password;

            $cek = adminM::where('username', $username);

            if($cek->count() === 1) {
                if (Hash::check($password, $cek->first()->password)) {
                    $nama = $cek->first()->nama;
                    $username = $cek->first()->username;
                    $request->session()->put('login', true);
                    $request->session()->put('nama', $nama);
                    $request->session()->put('username', $username);
                    $request->session()->put('posisi', "admin");

                    return redirect('home')->with('success', 'Welcome');
                }
            }
            return redirect('login')->with('warning', 'Username atau password tidak benar');

        }catch(\Throwable $th){
            return redirect('login')->with('warning', 'Username atau password tidak benar');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('login');
    }
}
