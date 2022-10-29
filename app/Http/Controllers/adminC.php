<?php

namespace App\Http\Controllers;

use App\Models\adminM;
use Hash;
use Illuminate\Http\Request;

class adminC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = empty($request->keyword)?"":$request->keyword;

        $admin = adminM::where(function ($query) use ($keyword){
            $query->where('nama', 'like', "$keyword%")
                  ->orWhere('username', 'like', "$keyword%");
        })->paginate(15);

        $admin->appends($request->only(['limit', 'keyword']));

        return view('pages.pagesAdmin', [
            'admin' => $admin,
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
            'username' => 'required',
            'nama' => 'required',
            'password' => 'required',
        ]);
        
        
        try{
            $username = $request->username;
            $nama = $request->nama;
            $password = Hash::make($request->password);
        
            $store = new adminM;
            $store->username = $username;
            $store->nama = $nama;
            $store->password = $password;
            $store->save();
            if($store) {
                return redirect('admin')->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect('admin')->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\adminM  $adminM
     * @return \Illuminate\Http\Response
     */
    public function show(adminM $adminM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\adminM  $adminM
     * @return \Illuminate\Http\Response
     */
    public function edit(adminM $adminM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\adminM  $adminM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, adminM $adminM, $idadmin)
    {
        $request->validate([
            'nama' => 'required',
            'password' => 'required',
        ]);
        
        
        try{
            $nama = $request->nama;
            $password = Hash::make($request->password);
        
            $update = adminM::where('idadmin', $idadmin)->update([
                'nama' => $nama,
                'password' => $password,
            ]);
            if($update) {
                return redirect('admin')->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect('admin')->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\adminM  $adminM
     * @return \Illuminate\Http\Response
     */
    public function destroy(adminM $adminM, $idadmin)
    {
        try{
            $destroy = adminM::where('idadmin', $idadmin)->delete();
            if($destroy) {
                return redirect('admin')->with('toast_success', 'success');
            }
        }catch(\Throwable $th){
            return redirect('admin')->with('toast_error', 'Terjadi kesalahan');
        }
    }
}
