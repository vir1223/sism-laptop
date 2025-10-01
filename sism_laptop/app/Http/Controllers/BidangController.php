<?php

namespace App\Http\Controllers;

use App\Models\bidang;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = bidang::all();
        return view('bidang.index',['dataBidang'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bidang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'name_bidang'=>'required'
        ]);
        $a = bidang::create($validasi);
        if ($a) {
            return redirect()->route('bidang.index');
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        $data = bidang::find($id);
        return view('bidang.edit',['dataBidang'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name_bidang'=>'required'
        ]);
        $a = bidang::find($id)->update($validate);
        if ($a) {
            return redirect()->route('bidang.index');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $a = bidang::find($id)->delete();
         if ($a) {
            return redirect()->route('bidang.index');
        }
        return redirect()->back();
    }
}
