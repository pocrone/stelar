<?php

namespace App\Http\Controllers\Siswa\Leader;

use DataTables;
use App\Models\Inboxmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Outboxmail;
use Illuminate\Support\Facades\Auth;

class LeaderRetention extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('siswa.leader.inbox_retention');
    }
    public function inbox_retention()
    {
        $data = Inboxmail::select('inboxmails.id', 'mail_number', 'date', 'mail_about', 'retention_status', 'sender',  'active_year', 'inactive_year', 'mail_location', 'class', 'sub_class')
            ->join('classifications', 'classifications.id', '=', 'classification_id')
            ->join('classrooms', 'classrooms.id', '=', 'inboxmails.classroom_id')
            ->where('classrooms.id', auth()->user()->classroom_id)
            ->get();

        return Datatables::of($data)

            ->make(true);
    }
    public function outbox_retention()
    {
        $data = Outboxmail::select('id', 'mail_number', 'date', 'mail_about', 'sender', 'active_year', 'inactive_year')
            ->get();

        return Datatables::of($data)

            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
