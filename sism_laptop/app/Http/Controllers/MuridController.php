<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\murid;
use Illuminate\Http\Request;

class MuridController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=murid::with('kelas','user')->get();
        

        return view('murid.index',['dataMurid'=>$data]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $murid = murid::find($id);
        $kelas = kelas::all();
        return view('murid.edit',['murid'=>$murid,'dataKelas'=>$kelas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        
        $validate = $request->validate([
            'name_murid' => 'required',
            'nis'=> 'required',
            'kelas_id' => 'required'
        ]);

        $c = murid::find($id)->update($validate);
        if($c){
            return redirect()->route('murid.index');
        }
        return redirect()->back();
    }
}
