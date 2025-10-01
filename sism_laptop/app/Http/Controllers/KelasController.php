<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = kelas::all();
        return view('kelas.index',['dataKelas'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'name_kelas'=>'required'
        ]);
        $a = kelas::create($validasi);
        if ($a) {
            return redirect()->route('kelas.index');
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        $data = kelas::find($id);
        return view('kelas.edit',['dataKelas'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name_kelas'=>'required'
        ]);
        $a = kelas::find($id)->update($validate);
        if ($a) {
            return redirect()->route('kelas.index');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $a = kelas::find($id)->delete();
         if ($a) {
            return redirect()->route('kelas.index');
        }
        return redirect()->back();
    }
}
