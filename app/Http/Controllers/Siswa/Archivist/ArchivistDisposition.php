<?php

namespace App\Http\Controllers\Siswa\Archivist;

use App\Models\InboxMail;
use App\Models\UserGroup;
use App\Models\Disposition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\DispositionRequest;


class ArchivistDisposition extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $group_id = UserGroup::select('group_id')->where('user_id', Auth::id())->first();
        $data = Disposition::select('dispositions.sender as sender_dispo', 'recevier', 'instruction', 'dispositions.date as date_dispo')
            ->join('inbox_mails', 'inbox_mails.id', '=', 'inbox_mail_id')
            ->where('group_id', $group_id->group_id)
            ->where('inbox_mail_id', $request->id)
            ->get(); # code...

        return Datatables::of($data)->make(true);
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
    public function store(DispositionRequest $request)
    {
        $disposisi = new Disposition;
        $disposisi->sender = 'Arsiparis - ' . auth()->user()->name;
        $disposisi->recevier = $request->recevier;
        $disposisi->instruction = strip_tags($request->instruction);
        $disposisi->date = date('Y-m-d');
        $disposisi->inbox_mail_id = $request->inbox_mail_id;
        $disposisi->status = 0;
        $disposisi->save();
        return redirect()->back();
    }
}
