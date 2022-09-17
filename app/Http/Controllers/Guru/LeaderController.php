<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Group;
use App\Models\MailConcept;
use App\Models\InboxMail;
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
        $data = [
            'nama' => auth()->user()->name,
            'group' => Group::find($group_id),
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
                    '<a href="' . route("detail_inbox", $data->id) . '" class=" btn-success mx-auto text-white btn-sm">
                    <i class="mdi mdi-folder-outline icon-sm"></i> </a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function leader_inbox(Request $request, $group_id)
    {
        $data = [
            'nama' => auth()->user()->name,
            'group' => Group::find($group_id),
            'group_id' => $group_id,
        ];
        return view('guru.progres.leader.leader_inbox', $data);
    }
}
