<?php

namespace App\Http\Controllers;

use App\Models\bidang;
use App\Models\guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=guru::with('bidang','user')->get();
        
            return view('guru.index',['dataGuru'=>$data]);
    }

    

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $guru = guru::find($id);
        $bidang = bidang::all();
        return view('guru.edit',['guru'=>$guru,'dataBidang'=>$bidang]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        
        $validate = $request->validate([
            'name_guru' => 'required',
            'nip'=> 'required',
            'bidang_id' => 'required'
        ]);

        $c = guru::find($id)->update($validate);
        if($c){
            return redirect()->route('guru.index');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
}
