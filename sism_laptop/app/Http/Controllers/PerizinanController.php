<?php

namespace App\Http\Controllers;

use App\Models\perizinan;
use App\Models\Murid;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PerizinanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = perizinan::with('user','murid','guru')->get();
        return view('perizinan.index',['dataPerizinan'=>$data]);
    }

    public function show()
    {
        $data = perizinan::with('user','murid','guru')->get();
        return view('perizinan.show',['dataPerizinan'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $murids = Murid::all();
        $gurus = Guru::all();
        $currentUser = Auth::user();

        return view('perizinan.create', ['murids' => $murids,'gurus' => $gurus,'currentUser' => $currentUser]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data dari form, kecuali tanggal_izin
        $validasi = $request->validate([
            'user_id'=>'required',
            'murid_id' =>'required',
            'guru_id' =>'required',
            'alasan' =>'required',
            'sesi' =>'required|array', // Validasi sesi sebagai array
            'persetujuan' =>'required',
        ]);

        // Check if the murid has already made a perizinan today
        $existingPerizinan = perizinan::where('murid_id', $request->murid_id)
                                      ->where('tanggal_izin', Carbon::today())
                                      ->exists();

        if ($existingPerizinan) {
            return redirect()->back()->withErrors(['murid_id' => 'Murid sudah membuat perizinan hari ini.']);
        }

        // Tambahkan user_id dari user yang sedang login
        $validasi['user_id'] = Auth::id();

        // Tambahkan tanggal_izin secara otomatis (tanggal hari ini)
        $validasi['tanggal_izin'] = Carbon::today();

        // Gabungkan array sesi menjadi satu string
        $validasi['sesi'] = implode(', ', $request->sesi);

        $a = perizinan::create($validasi);
        if ($a) {
            return redirect()->route('perizinan.all');
        }
        return redirect()->back();
    }

    // ... metode lainnya tetap sama

    public function edit(string $id)
    {
        $data = perizinan::find($id);
        return view('perizinan.edit',['dataPerizinan'=>$data]);
    }

    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
        'user_id'=>'required',
        'murid_id' =>'required',
        'guru_id' =>'required',
        'alasan' =>'required',
        'tanggal_izin' =>'required',
        'sesi' =>'required',
        'persetujuan' =>'required',
        ]);
        $a = perizinan::find($id)->update($validate);
        if ($a) {
            return redirect()->route('perizinan.all');
        }
        return redirect()->back();
    }

    public function destroy(string $id)
    {
        $a = perizinan::find($id)->delete();
         if ($a) {
            return redirect()->route('perizinan.all');
        }
        return redirect()->back();
    }


    public function updateStatus(Request $request, $id)
    {
        $perizinan = perizinan::find($id);

        if ($perizinan) {
            $status = $request->input('status');
            $perizinan->persetujuan = $status;

            if ($status === 'disetujui') {
                // Move to history table
                DB::table('history')->insert([
                    'user_id' => $perizinan->user_id,
                    'murid_id' => $perizinan->murid_id,
                    'guru_id' => $perizinan->guru_id,
                    'alasan' => $perizinan->alasan,
                    'tanggal_izin' => $perizinan->tanggal_izin,
                    'sesi' => $perizinan->sesi,
                    'persetujuan' => $status,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                // Delete from perizinan table
                $perizinan->delete();
            } elseif ($status === 'ditolak') {
                // Delete rejected perizinan
                $perizinan->delete();
            } else {
                // For other statuses, just update
                $perizinan->save();
            }

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Data perizinan tidak ditemukan.'], 404);
    }
}