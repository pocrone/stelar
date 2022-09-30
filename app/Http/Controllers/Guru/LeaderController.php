<?php

namespace App\Http\Controllers\Guru;

use App\Models\User;
use App\Models\Group;
use App\Models\Autograph;
use App\Models\InboxMail;
use App\Models\UserGroup;
use App\Models\OutboxMail;
use App\Models\Assignments;
use App\Models\Disposition;
use App\Models\MailConcept;
use Illuminate\Http\Request;
use App\Models\MailCorrection;
use App\Models\GroupAssignments;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class LeaderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function leader_concept_data($group_id)
    {
        $data = MailConcept::select('mail_concepts.user_id', 'name', 'mail_concept', 'status', 'mail_concepts.id as conceptID')
            ->join('users', 'users.id', '=', 'mail_concepts.user_id')
            ->join('groups', 'groups.id', '=', 'mail_concepts.group_id')
            ->where('groups.id', $group_id)
            ->get();

        return Datatables::of($data)->addIndexColumn()

            ->rawColumns(['action'])
            ->make(true);
    }
    public function leader_concept($group_id)
    {
        $classroom_id = Group::find($group_id)->classroom_id;
        $group_list = Group::where('classroom_id', $classroom_id)->get();
        $data = [
            'nama' => auth()->user()->name,
            'group' => Group::find($group_id),
            'group_list' => $group_list,
            'group_id' => $group_id,
        ];
        return view('guru.progres.leader.leader_concept', $data);
    }
    public function leader_inbox_data($group_id)
    {
        $data = InboxMail::select('inbox_mails.*', 'name')
            ->join('groups', 'groups.id', '=', 'inbox_mails.group_id')
            ->join('users', 'users.id', '=', 'inbox_mails.user_id')
            ->where('group_id', $group_id)
            ->get();


        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function ($data) {
                $btn =
                    '<div class="row">' .
                    '<a target="_blank" href="' . route('leader_detail_inbox', ['id' => $data->id, 'group_id' => $data->group_id]) . '" class=" btn-success mx-auto text-white btn-sm">
                    <i class="mdi mdi-folder-outline icon-sm"></i> </a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function leader_inbox(Request $request, $group_id)
    {
        $classroom_id = Group::find($group_id)->classroom_id;
        $group_list = Group::where('classroom_id', $classroom_id)->get();
        $data = [
            'nama' => auth()->user()->name,
            'group' => Group::find($group_id),
            'group_id' => $group_id,
            'group_list' => $group_list
        ];
        return view('guru.progres.leader.leader_inbox', $data);
    }
    public function leader_detail_inbox(Request $request, $id, $group_id)
    {
        $classroom_id = Group::find($group_id)->classroom_id;
        $group_list = Group::where('classroom_id', $classroom_id)->get();
        // $group_id =  InboxMail::where('inbox_mails.id', $request->id)->first();
        $mail = InboxMail::where('inbox_mails.id', $request->id)
            ->join('dispositions', 'dispositions.inbox_mail_id', '=', 'inbox_mails.id')
            ->where('dispositions.status', 1)
            ->exists();

        if ($mail == 1) {
            $mail_data = InboxMail::where('inbox_mails.id', $request->id)->select('inbox_mails.*', 'inbox_mails.id as inboxID', 'classifications.*', 'inbox_mails.group_id as groupID')
                ->leftjoin('classifications', 'classifications.id', '=', 'inbox_mails.classification_id')->first();
            $mail_data['status_disposition'] = 1;
        } else {
            $mail_data = InboxMail::where('inbox_mails.id', $request->id)->select('inbox_mails.*', 'inbox_mails.id as inboxID', 'classifications.*', 'inbox_mails.group_id as groupID')
                ->leftjoin('classifications', 'classifications.id', '=', 'inbox_mails.classification_id')->first();
            $mail_data['status_disposition'] = 0;
        }

        return view('guru.progres.leader.leader_detail_inbox')
            ->with('data', $mail_data)
            ->with('nama', auth()->user()->name)
            ->with('group_id', $group_id)
            ->with('group_list', $group_list)
            ->with('group', Group::find($group_id));
        // return     $mail_data;
    }
    public function disposition(Request $request)
    {
        $data = Disposition::select('dispositions.sender as sender_dispo', 'recevier', 'instruction', 'dispositions.date as date_dispo', 'group_id', 'inbox_mails.id as inboxID')
            ->join('inbox_mails', 'inbox_mails.id', '=', 'inbox_mail_id')
            ->where('group_id', $request->group_id)
            ->where('inbox_mail_id', $request->id)
            ->get(); # code...

        return Datatables::of($data)->make(true);
    }
    public function inbox_retention(Request $request, $group_id)
    {
        $classroom_id = Group::find($group_id)->classroom_id;
        $group_list = Group::where('classroom_id', $classroom_id)->get();
        if ($request->ajax()) {
            $data = InboxMail::select('inbox_mails.id', 'mail_number', 'date', 'mail_about', 'retention_status', 'sender',  'active_year', 'inactive_year', 'mail_location', 'class', 'sub_class')
                ->leftjoin('classifications', 'classifications.id', '=', 'classification_id')
                ->join('groups', 'groups.id', '=', 'inbox_mails.group_id')
                ->join('users', 'users.id', '=', 'inbox_mails.user_id')
                ->where('inbox_mails.group_id', $group_id)->get();
            return Datatables::of($data)->make(true);
        }

        return view('guru.progres.leader.retention_inbox')
            ->with('nama', auth()->user()->name)
            ->with('group_list', $group_list)
            ->with('group_id', $group_id)
            ->with('group', Group::find($group_id));
    }

    public function outbox_retention(Request $request, $group_id)
    {
        $classroom_id = Group::find($group_id)->classroom_id;
        $group_list = Group::where('classroom_id', $classroom_id)->get();
        if ($request->ajax()) {
            $data = OutboxMail::select('outbox_mails.id', 'outboxmail_number', 'mail_date', 'mail_about', 'retention_status',  'active_year', 'inactive_year', 'save_location', 'class', 'sub_class')
                ->leftjoin('classifications', 'classifications.id', '=', 'classification_id')
                ->join('groups', 'groups.id', '=', 'outbox_mails.group_id')
                ->join('users', 'users.id', '=', 'outbox_mails.user_id')
                ->where('outbox_mails.group_id', $group_id)->get();

            return Datatables::of($data)->make(true);
        }
        return view('guru.progres.leader.retention_outbox')
            ->with('nama', auth()->user()->name)
            ->with('group_list', $group_list)
            ->with('group_id', $group_id)
            ->with('group', Group::find($group_id));
    }
    public function outbox_retentionx($group_id)
    {
        $data = OutboxMail::select('outbox_mails.id', 'outboxmail_number', 'mail_date', 'mail_about', 'retention_status',  'active_year', 'inactive_year', 'save_location', 'class', 'sub_class')
            ->leftjoin('classifications', 'classifications.id', '=', 'classification_id')
            ->join('groups', 'groups.id', '=', 'outbox_mails.group_id')
            ->join('users', 'users.id', '=', 'outbox_mails.user_id')
            ->where('outbox_mails.group_id', $group_id)->get();


        return Datatables::of($data)->make(true);
    }

    public function leader_mail_correct(Request $request)
    {
        $classroom_id = Group::find($request->group_id)->classroom_id;
        $group_list = Group::where('classroom_id', $classroom_id)->get();
        if ($request->ajax()) {

            $group_id = UserGroup::select('group_id')->where('user_id', Auth::id())->first();
            $data = OutboxMail::select('outbox_mails.*', 'name')
                ->join('groups', 'groups.id', '=', 'outbox_mails.group_id')
                ->join('users', 'users.id', '=', 'outbox_mails.user_id')

                ->where('group_id', $request->group_id)
                ->get();


            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn =
                        '<div class="row">' .
                        '<a href="' . route('guru_leader_detail_outbox', ['id' => $data->id, 'group_id' => $data->group_id]) . '" class=" btn-success mx-auto text-white btn-sm">
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
        return view('guru.progres.leader.mail_correction')
            ->with('nama', auth()->user()->name)
            ->with('group_list', $group_list)
            ->with('group_id', $request->group_id)
            ->with('group', Group::find($request->group_id));
    }

    public function getstatus_koreksi($id)
    {
        $data = MailCorrection::where('status_koreksi', 1)->where('outbox_mail_id', $id)->exists();
        return $data;
    }
    public function viewMail(Request $request)
    {

        $classroom_id = Group::find($request->group_id)->classroom_id;

        $group_list = Group::where('classroom_id', $classroom_id)->get();
        $koreksi_surat = MailCorrection::where('outbox_mail_id', $request->id)->get();

        $cek_status = $this->getstatus_koreksi($request->id);
        $data = OutboxMail::where('outbox_mails.id', $request->id)
            ->leftjoin('classifications', 'classifications.id', '=', 'outbox_mails.classification_id')
            ->select('outbox_mails.*', 'outbox_mails.id as outboxID', 'classifications.*')
            ->first();
        $autograph = Autograph::where('autographs.id', $data->autograph_id)
            ->join('users', 'users.id', '=', 'autographs.user_id')
            ->first();

        return view('guru.progres.leader.view_mail')
            ->with('mail', $data)
            ->with('ttd', $autograph)
            ->with('status_koreksi', $cek_status)
            ->with('data_koreksi', $koreksi_surat)
            ->with('nama', auth()->user()->name)
            ->with('group_list', $group_list)
            ->with('group_id', $request->group_id)
            ->with('group', Group::find($request->group_id));
    }
}
