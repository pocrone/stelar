<?php

namespace App\Http\Controllers\Siswa\Leader;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeaderDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('siswa.leader.dashboard')->with('nama', auth()->user()->name);
    }
}
