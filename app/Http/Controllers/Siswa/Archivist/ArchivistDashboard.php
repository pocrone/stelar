<?php

namespace App\Http\Controllers\Siswa\Archivist;

use App\Models\Autograph;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ArchivistDashboard extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('siswa.archivist.dashboard')->with('nama', auth()->user()->name);
    }
}
