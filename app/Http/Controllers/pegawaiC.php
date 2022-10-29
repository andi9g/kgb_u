<?php

namespace App\Http\Controllers;

use App\Models\pegawai;
use Illuminate\Http\Request;

class pegawaiC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = empty($request->keyword)?"":$request->keyword;

        $pegawai = pegawai::where(function ($query) use ($keyword) {
            $query->where('nama', 'like', "%$keyword%")
                  ->orWhere('nik', 'like', "$keyword%");
        })->paginate(15);

        $pegawai->appends($request->only(['limit', 'keyword']));

        return view('pages.pagesPegawai',[
            'pegawai' => $pegawai,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'jk' => 'required',
            'skcpns' => 'required',
        ]);
        
        
        // try{
            $nik = $request->nik;
            $nama = $request->nama;
            $jk = $request->jk;
            $skcpns = $request->skcpns;
        
            $store = new pegawai;
            $store->nik = $nik;
            $store->nama = $nama;
            $store->jk = $jk;
            $store->skcpns = $skcpns;
            $store->save();
            if($store) {
                return redirect('pegawai')->with('toast_success', 'success');
            }
        // }catch(\Throwable $th){
        //     return redirect('pegawai')->with('toast_error', 'Terjadi kesalahan');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(pegawai $pegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idpegawai)
    {
        $request->validate([
            'nama' => 'required',
            'jk' => 'required',
            'skcpns' => 'required',
        ]);
        
        try{
            $nama = $request->nama;
            $jk = $request->jk;
            $skcpns = $request->skcpns;
        
            $update = pegawai::where('idpegawai', $idpegawai)->update([
                'nama' => $nama,
                'jk' => $jk,
                'skcpns' => $skcpns,
            ]);
            if($update) {
                return redirect('pegawai')->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect('pegawai')->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy($idpegawai)
    {
        try{
            $destroy = pegawai::where('idpegawai', $idpegawai)->delete();
            if($destroy) {
                return redirect('pegawai')->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect('pegawai')->with('toast_error', 'Terjadi kesalahan');
        }
    }
}
