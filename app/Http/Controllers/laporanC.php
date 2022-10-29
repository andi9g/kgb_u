<?php

namespace App\Http\Controllers;

use App\Models\pegawai;
use App\Models\pkgbM;
use PDF;
use Illuminate\Http\Request;

class laporanC extends Controller
{
    public function keseluruhan()
    {
        try{

            $pkgb = pkgbM::first();

            $ambil = pegawai::orderBy('skcpns', 'asc')->first();
            $tahun_awal = (int) date("Y", strtotime($ambil->skcpns)) + 2;
            $tahun_akhir = (int) $pkgb->tahunakhir;
            $selisih = ((int)($tahun_akhir)) - ((int)($tahun_awal));
 
            $pegawai = pegawai::orderBy('nama','asc')->get();
    
            $pdf = PDF::loadView('laporan.laporankgbkeseluruhan', [
                'pegawai' => $pegawai,
                'tahun_awal' => $tahun_awal,
                'tahun_akhir' => $tahun_akhir,
                'selisih' => $selisih,
                'pkgb' => $pkgb,
            ])->setPaper('a4', 'landscape');
            
            return $pdf->stream();
        }catch(\Throwable $th){
            return redirect('kgb')->with('toast_error', 'Terjadi kesalahan');
        }
    }

    public function satuan(Request $request, $nik)
    {
        try{
            $pkgb = pkgbM::first();
            $pegawai = pegawai::where('nik',$nik)->first();
    
            $pdf = PDF::loadView('laporan.laporankgbsatuan', [
                'pegawai' => $pegawai,
                'pkgb' => $pkgb,
            ])->setPaper('a4');

            return $pdf->stream();
        }catch(\Throwable $th){
            return redirect('kgb')->with('toast_error', 'Terjadi kesalahan');
        }
    }
}
