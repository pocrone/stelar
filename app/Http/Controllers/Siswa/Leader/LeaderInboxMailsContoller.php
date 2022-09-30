<?php

namespace App\Http\Controllers\Siswa\Leader;

// use DataTables;
use Yajra\DataTables\Facades\DataTables;
use App\Models\InboxMail;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LeaderInboxMailsContoller extends Controller
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
            $data = InboxMail::select('inbox_mails.*', 'name')
                ->join('groups', 'groups.id', '=', 'inbox_mails.group_id')
                ->join('users', 'users.id', '=', 'inbox_mails.user_id')
                ->where('group_id', $group_id->group_id)
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
        return view('siswa.leader.inbox')->with('nama', auth()->user()->name);
    }

    public function detailInbox(Request $request)
    {
        $user_group = UserGroup::select('group_id')->where('user_id', Auth::id())->first();
        $group_id =  InboxMail::where('inbox_mails.id', $request->id)->first();
        if ($group_id->group_id == $user_group->group_id) {
            $mail = InboxMail::where('inbox_mails.id', $request->id)
                ->join('dispositions', 'dispositions.inbox_mail_id', '=', 'inbox_mails.id')
                ->where('dispositions.status', 1)
                ->exists();

            if ($mail == 1) {
                $mail_data = InboxMail::where('inbox_mails.id', $request->id)
                    ->select('inbox_mails.*', 'inbox_mails.id as inboxID', 'classifications.*', 'inbox_mails.group_id as groupID')
                    ->leftjoin('classifications', 'classifications.id', '=', 'inbox_mails.classification_id')->first();
                $mail_data['status_disposition'] = 1;
            } else {
                $mail_data = InboxMail::where('inbox_mails.id', $request->id)
                    ->select('inbox_mails.*', 'inbox_mails.id as inboxID', 'classifications.*', 'inbox_mails.group_id as groupID')
                    ->leftjoin('classifications', 'classifications.id', '=', 'inbox_mails.classification_id')->first();
                $mail_data['status_disposition'] = 0;
            }

            return view('siswa.leader.inbox_detail')
                ->with('data', $mail_data)
                ->with('nama', auth()->user()->name);
        } else {
            return view('siswa.leader.inbox_invalid')
                ->with('nama', auth()->user()->name);
        }

        // return     $mail_data;
    }
}
