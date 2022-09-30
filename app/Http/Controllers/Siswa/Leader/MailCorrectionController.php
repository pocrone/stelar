<?php

namespace App\Http\Controllers\Siswa\Leader;

use App\Models\InboxMail;
use App\Models\UserGroup;

use App\Models\OutboxMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Autograph;
use App\Models\MailCorrection;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class MailCorrectionController extends Controller
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

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $group_id = UserGroup::select('group_id')->where('user_id', Auth::id())->first();
            $data = OutboxMail::select('outbox_mails.*', 'name')
                ->join('groups', 'groups.id', '=', 'outbox_mails.group_id')
                ->join('users', 'users.id', '=', 'outbox_mails.user_id')

                ->where('group_id', $group_id->group_id)
                ->get();


            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn =
                        '<div class="row">' .
                        '<a href="' . route('leader_detail_outbox', $data->id) . '" class=" btn-success mx-auto text-white btn-sm">
                    <i class="mdi mdi-folder-outline icon-sm"></i> </a>';

                    return $btn;
                })
                ->addColumn('status_koreksi', function ($data) {
                    $cek_status = $this->getstatus_koreksi($data->id);
                    if ($data->autograph_status == 1) {
                        return    'Revisi Sudah Selesai';
                    } else {
                        return 'Masih Perlu Revisi';
                    }
                })
                ->rawColumns(['status_koreksi'])
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('siswa.leader.mail_correction')->with('nama', auth()->user()->name);
    }

    public function getstatus_koreksi($id)
    {
        $data = MailCorrection::where('status_koreksi', 1)->where('outbox_mail_id', $id)->exists();
        return $data;
    }

    public function viewMail(Request $request)
    {
        $koreksi_surat = MailCorrection::where('outbox_mail_id', $request->id)->get();

        $cek_status = $this->getstatus_koreksi($request->id);
        $data = OutboxMail::where('outbox_mails.id', $request->id)
            ->leftjoin('classifications', 'classifications.id', '=', 'outbox_mails.classification_id')
            ->select('outbox_mails.*', 'outbox_mails.id as outboxID', 'classifications.*')
            ->first();
        $autograph = Autograph::where('autographs.id', $data->autograph_id)
            ->join('users', 'users.id', '=', 'autographs.user_id')
            ->first();
        return view('siswa.leader.view_mail')
            ->with('mail', $data)
            ->with('ttd', $autograph)
            ->with('status_koreksi', $cek_status)
            ->with('data_koreksi', $koreksi_surat)
            ->with('nama', auth()->user()->name);
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
        $mail_correct = new MailCorrection();
        $mail_correct->isi_koreksi = $request->isi_instruksi;
        $mail_correct->outbox_mail_id = $request->outbox_id;
        $mail_correct->date = date('Y-m-d');
        $mail_correct->status_koreksi = $request->status_koreksi;
        $mail_correct->save();

        return redirect()->back();
    }

    public function approveAutograph(Request $request)
    {

        $outbox_data = OutboxMail::where('id', $request->id)->first();
        $sign_id =  Autograph::where('user_id', auth()->user()->id)->first();
        $check_sign = Autograph::where('user_id', auth()->user()->id)->exists();
        if ($check_sign == true) {
            $data = ['autograph_status' => 1, 'autograph_id' => $sign_id->id];
            $update  = OutboxMail::where('id', $request->id)->update($data);

            return redirect()->back();
        } else {
            return back()->with('gagal', 'Kamu belum menginputkan TTD Kamu');
        }
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
