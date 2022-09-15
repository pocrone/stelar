<?php

namespace App\Http\Controllers\Siswa\Secretary;

use App\Models\Autograph;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SecretaryDashboard extends Controller
{
    public function index()
    {
        return view('siswa.secretary.dashboard')->with('nama', auth()->user()->name);
    }
}
