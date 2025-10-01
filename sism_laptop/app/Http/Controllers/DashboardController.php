<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Support\Facades\Auth;
use App\Models\Perizinan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        // Data for bar chart: perizinans per month for the current year
        $year = Carbon::now()->year;
        $monthlyData = [];
        for ($month = 1; $month <= 12; $month++) {
            $count = History::whereYear('tanggal_izin', $year)
                ->whereMonth('tanggal_izin', $month)
                ->count();
            $monthlyData[] = $count;
        }

        // Data for donut chart: perizinans status for this month
        $currentMonth = Carbon::now()->month;
        $donutData = [
            'disetujui' => History::whereYear('tanggal_izin', $year)
                ->whereMonth('tanggal_izin', $currentMonth)
                ->where('persetujuan', 'disetujui')
                ->count(),
            'ditolak' => Perizinan::whereYear('tanggal_izin', $year)
                ->whereMonth('tanggal_izin', $currentMonth)
                ->where('persetujuan', 'ditolak')
                ->count(),
            'menunggu' => Perizinan::whereYear('tanggal_izin', $year)
                ->whereMonth('tanggal_izin', $currentMonth)
                ->where('persetujuan', 'menunggu')
                ->count(),
        ];
        return view('home.admin', ['monthlyData'=>$monthlyData, 'donutData'=>$donutData]);
    }

    public function muridDashboard()
    {
        $user = Auth::user();
        $murid = $user->murid;

        if (!$murid) {
            abort(403, 'Anda tidak memiliki akses ke dashboard murid.');
        }

        $perizinans = Perizinan::with('user', 'guru')
            ->where('murid_id', $murid->id)
            ->get();

        return view('home.murid', compact('perizinans', 'murid'));
    }

    public function guruDashboard()
    {
        $user = Auth::user();
        $guru = $user->guru;

        if (!$guru) {
            abort(403, 'Anda tidak memiliki akses ke dashboard guru.');
        }

        $perizinans = Perizinan::with('user', 'murid')
            ->where('guru_id', $guru->id)
            ->get();

        return view('home.guru', compact('perizinans', 'guru'));
    }
}
