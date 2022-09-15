<?php

namespace App\Http\Controllers\Siswa\Leader;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeaderDashboard extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('siswa.leader.dashboard');
    }
}
