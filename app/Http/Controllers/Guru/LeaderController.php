<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Group;
use App\Models\MailConcept;
use App\Models\InboxMail;
use App\Models\OutboxMail;
use App\Models\UserGroup;
use App\Models\Assignments;
use App\Models\GroupAssignments;
use Illuminate\Http\Request;
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
        $data = InboxMail::select('inbox_mails.*')
            ->join('groups', 'groups.id', '=', 'inbox_mails.group_id')
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
            $mail_data = InboxMail::where('inbox_mails.id', $request->id)->first();
            $mail_data['status_disposition'] = 1;
        } else {
            $mail_data = InboxMail::where('inbox_mails.id', $request->id)->first();
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
    public function disposition(Request $request, $id, $group_id)
    {
        $data = Disposition::select('dispositions.sender as sender_dispo', 'recevier', 'instruction', 'dispositions.date as date_dispo')
            ->join('inbox_mails', 'inbox_mails.id', '=', 'inbox_mail_id')
            ->where('group_id', $group_id->group_id)
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
}
