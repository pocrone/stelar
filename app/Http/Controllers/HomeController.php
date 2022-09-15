<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (Auth::user()->role == '2') {
            $data = ['nama' => auth()->user()->name];
            return view('siswa.gates', $data);
        } elseif (Auth::user()->role == '1') {
            $data = ['nama' => auth()->user()->name];
            return view('guru.gates', $data);
        }
    }
}
