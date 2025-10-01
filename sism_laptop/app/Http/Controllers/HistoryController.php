<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{
    public function index()
    {
        $historyData = History::orderBy('tanggal_izin', 'desc')->paginate(20);
        return view('history.index', compact('historyData'));
    }
}
