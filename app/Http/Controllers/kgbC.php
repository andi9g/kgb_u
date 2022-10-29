<?php

namespace App\Http\Controllers;

use App\Models\kgbM;
use App\Models\pkgbM;
use App\Models\pegawai;
use Illuminate\Http\Request;

class kgbC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = empty($request->keyword)?"":$request->keyword;

        $pkgb = pkgbM::first();

        $pegawai = pegawai::where(function ($query) use ($keyword) {
            $query->where('nama', 'like', "%$keyword%")
                  ->orWhere('nik', 'like', "$keyword%");
        })->paginate(15);

        $pegawai->appends($request->only(['limit', 'keyword']));

        return view('pages.pagesKGB',[
            'pegawai' => $pegawai,
            'pkgb' => $pkgb,
        ]);
    }

    public function proses(Request $request, $nik, $tanggalkgb)
    {
        try{
            $data = pegawai::where('nik', $nik)->first();
            $skcpns = $data->skcpns;
            
            $pkgb = pkgbM::first();
            for ($i=((int) date('Y', strtotime($skcpns))); ($i <= ((int) $pkgb->tahunakhir)) && strtotime($i) < strtotime(date('Y')) ; $i=$i+2) { 
                $tanggallalu = $i."-".date('m-d', strtotime($skcpns));
                $cek = kgbM::where('nik', $nik)->where('tanggalkgb', $tanggallalu)->count();

                if($cek == 0) {
                    $store = new kgbM;
                    $store->nik = $nik;
                    $store->tanggalkgb = $tanggallalu;
                    $store->save();
                }

            }
        
            $store = new kgbM;
            $store->nik = $nik;
            $store->tanggalkgb = $tanggalkgb;
            $store->save();
            if($store) {
                return redirect('kgb')->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect('kgb')->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function normalkan(Request $request, $nik)
    {
        try{
            $data = pegawai::where('nik', $nik)->first();
            $skcpns = $data->skcpns;
            
            $pkgb = pkgbM::first();
            for ($i=((int) date('Y', strtotime($skcpns))); ($i <= ((int) $pkgb->tahunakhir)) && strtotime($i) < strtotime(date('Y')) ; $i=$i+2) { 
                $tanggallalu = $i."-".date('m-d', strtotime($skcpns));
                $cek = kgbM::where('nik', $nik)->where('tanggalkgb', $tanggallalu)->count();

                if($cek == 0) {
                    $store = new kgbM;
                    $store->nik = $nik;
                    $store->tanggalkgb = $tanggallalu;
                    $store->save();
                }

            }

            if($store) {
                return redirect('kgb')->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect('kgb')->with('toast_error', 'Proses Terhenti');
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kgbM  $kgbM
     * @return \Illuminate\Http\Response
     */
    public function show(kgbM $kgbM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kgbM  $kgbM
     * @return \Illuminate\Http\Response
     */
    public function edit(kgbM $kgbM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kgbM  $kgbM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kgbM $kgbM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kgbM  $kgbM
     * @return \Illuminate\Http\Response
     */
    public function destroy(kgbM $kgbM)
    {
        //
    }
}
