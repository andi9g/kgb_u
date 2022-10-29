<?php

namespace App\Http\Controllers;

use App\Models\pkgbM;
use Illuminate\Http\Request;

class pengaturanC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pkgb = pkgbM::first();
        return view('pages.pagesPengaturanKGB', [
            'pkgb' => $pkgb,
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
            'tahunakhir' => 'required|numeric',
            'pertahun' => "required|numeric",
        ]);
        
        
        try{
            $tahunakhir = $request->tahunakhir;
            $pertahun = $request->pertahun;
            
            pkgbM::truncate();

            $store = new pkgbM;
            $store->tahunakhir = $tahunakhir;
            $store->pertahun = $pertahun;
            $store->save();
            if($store) {
                return redirect('pengaturan')->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect('pengaturan')->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pkgbM  $pkgbM
     * @return \Illuminate\Http\Response
     */
    public function show(pkgbM $pkgbM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pkgbM  $pkgbM
     * @return \Illuminate\Http\Response
     */
    public function edit(pkgbM $pkgbM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pkgbM  $pkgbM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pkgbM $pkgbM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pkgbM  $pkgbM
     * @return \Illuminate\Http\Response
     */
    public function destroy(pkgbM $pkgbM)
    {
        //
    }
}
