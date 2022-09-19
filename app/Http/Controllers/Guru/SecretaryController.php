<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Group;
use App\Models\Classification;
use App\Models\MailConcept;
use App\Models\Disposition;
use App\Models\InboxMail;
use App\Models\OutboxMail;
use App\Models\UserGroup;
use App\Models\Assignments;
use App\Models\GroupAssignments;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SecretaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function x(Request $request, $group_id)
    {


        $data = InboxMail::select('inbox_mails.id', 'mail_number', 'date', 'mail_about', 'retention_status', 'sender',  'active_year', 'inactive_year', 'mail_location', 'class', 'sub_class')
            ->leftjoin('classifications', 'classifications.id', '=', 'classification_id')
            ->join('groups', 'groups.id', '=', 'inbox_mails.group_id')
            ->join('users', 'users.id', '=', 'inbox_mails.user_id')
            ->where('inbox_mails.group_id', $group_id)->get();

        return Datatables::of($data)->make(true);
    }
    public function inbox_retention(Request $request, $group_id)
    {
        if ($request->ajax()) {

            $data = InboxMail::select('inbox_mails.id', 'mail_number', 'date', 'mail_about', 'retention_status', 'sender',  'active_year', 'inactive_year', 'mail_location', 'class', 'sub_class')
                ->leftjoin('classifications', 'classifications.id', '=', 'classification_id')
                ->join('groups', 'groups.id', '=', 'inbox_mails.group_id')
                ->join('users', 'users.id', '=', 'inbox_mails.user_id')
                ->where('inbox_mails.group_id', $group_id)->get();

            return Datatables::of($data)->make(true);
        }


        $classroom_id = Group::find($group_id)->classroom_id;
        $group_list = Group::where('classroom_id', $classroom_id)->get();
        return view('guru.progres.secretary.retention_inbox')
            ->with('group_id', $group_id)
            ->with('group', Group::find($group_id))
            ->with('group_list', $group_list)
            ->with('nama', auth()->user()->name);
    }
    public function outbox_retention(Request $request, $group_id)
    {
        if ($request->ajax()) {
            $data = OutboxMail::select('outbox_mails.id', 'outboxmail_number', 'mail_date', 'mail_about', 'retention_status',  'active_year', 'inactive_year', 'save_location', 'class', 'sub_class')
                ->leftjoin('classifications', 'classifications.id', '=', 'classification_id')
                ->join('groups', 'groups.id', '=', 'outbox_mails.group_id')
                ->join('users', 'users.id', '=', 'outbox_mails.user_id')
                ->where('outbox_mails.group_id', $group_id)->get();


            return Datatables::of($data)->make(true);
        }
        $classroom_id = Group::find($group_id)->classroom_id;
        $group_list = Group::where('classroom_id', $classroom_id)->get();
        return view('guru.progres.secretary.retention_outbox')
            ->with('group_id', $group_id)
            ->with('group', Group::find($group_id))
            ->with('group_list', $group_list)
            ->with('nama', auth()->user()->name);
    }

    public function disposition(Request $request, $group_id)
    {
        $data = Disposition::select('dispositions.sender as sender_dispo', 'recevier', 'instruction', 'dispositions.date as date_dispo')
            ->join('inbox_mails', 'inbox_mails.id', '=', 'inbox_mail_id')
            ->where('group_id', $group_id)
            ->where('inbox_mail_id', $request->id)
            ->get(); # code...

        return Datatables::of($data)->make(true);
    }
    public function inbox_detail(Request $request, $id, $group_id)
    {
        $mail = InboxMail::where('inbox_mails.id', $id)
            ->join('dispositions', 'dispositions.inbox_mail_id', '=', 'inbox_mails.id')
            ->where('dispositions.status', 1)
            ->exists();

        if ($mail == 1) {
            $mail_data = InboxMail::where('inbox_mails.id', $id)->first();
            $mail_data['status_disposition'] = 1;
        } else {
            $mail_data = InboxMail::where('inbox_mails.id', $id)->first();
            $mail_data['status_disposition'] = 0;
        }
        $classroom_id = Group::find($group_id)->classroom_id;
        $group_list = Group::where('classroom_id', $classroom_id)->get();
        return view('guru.progres.secretary.inbox_detail')
            ->with('group_id', $group_id)
            ->with('group', Group::find($group_id))
            ->with('group_list', $group_list)
            ->with('data', $mail_data)
            ->with('nama', auth()->user()->name);
    }
    public function inbox(Request $request, $group_id)
    {
        if ($request->ajax()) {
            $data = InboxMail::select('inbox_mails.*', 'name')
                ->join('groups', 'groups.id', '=', 'inbox_mails.group_id')
                ->join('users', 'users.id', '=', 'inbox_mails.user_id')
                ->where('group_id', $group_id)
                ->get();


            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn =
                        '<div class="row">' .
                        '<a target="_blank" href="' . route("inbox_detail_secretary", ['id' => $data->id, 'group_id' => $data->group_id]) . '" class=" btn-success mx-auto text-white btn-sm">
                <i class="mdi mdi-folder-outline icon-sm"></i> </a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $classroom_id = Group::find($group_id)->classroom_id;
        $group_list = Group::where('classroom_id', $classroom_id)->get();
        return view('guru.progres.secretary.inbox')
            ->with('group_id', $group_id)
            ->with('group', Group::find($group_id))
            ->with('group_list', $group_list)
            ->with('nama', auth()->user()->name);
    }

    public function concept(Request $request, $group_id)
    {

        if ($request->ajax()) {
            $data = MailConcept::select('mail_concepts.user_id', 'name', 'mail_concept', 'status', 'mail_concepts.id as conceptID')
                ->join('users', 'users.id', '=', 'mail_concepts.user_id')
                ->where('group_id', $group_id)
                ->get();


            return Datatables::of($data)->addIndexColumn()

                ->make(true);
            return $data;
        }
        $classroom_id = Group::find($group_id)->classroom_id;
        $group_list = Group::where('classroom_id', $classroom_id)->get();
        return view('guru.progres.secretary.concept')
            ->with('group_id', $group_id)
            ->with('group', Group::find($group_id))
            ->with('group_list', $group_list)
            ->with('nama', auth()->user()->name);
    }
    public function getOutboxID($id)
    {
        $outbox_id = OutboxMail::select('id')->where('mail_concept_id', $id)->first();
        return $outbox_id->id;
    }


    public function classification(Request $request, $group_id)
    {
        $classroom_id = Group::find($group_id)->classroom_id;
        $group_list = Group::where('classroom_id', $classroom_id)->get();
        if ($request->ajax()) {
            // $group_id = UserGroup::select('group_id')->where('user_id', Auth::id())->first();
            $data = Classification::select('classifications.*')
                // ->groupBy('classifications.class')
                ->orderBy('id', 'asc')
                ->where('group_id', $group_id)
                ->get();

            return Datatables::of($data)->addIndexColumn()
                //     ->addColumn('action', function ($data) {
                //         $btn = '<div class="row">' .
                //             '<button data-toggle="modal"  onclick="getclick_2(' . $data->id . ')"  data-target="#editKlasifikasi"  id="edit_button" class=" btn-primary p-0">
                //         <i class="mdi mdi-lead-pencil icon-sm"></i></button>' .

                //             '<form action="' . route("delete_classification", $data->id) . '" method="post">' .
                //             @csrf_field() . '
                // <button type="submit"    class="  btn-danger btn-sm">
                // <i class="mdi mdi-delete icon-sm"></button></form>' .
                //             '</div>';

                //         return $btn;
                //     })
                //     ->rawColumns(['action'])
                ->make(true);
        }

        return view('guru.progres.secretary.classification')
            ->with('group_id', $group_id)
            ->with('group', Group::find($group_id))
            ->with('group_list', $group_list)
            ->with('nama', auth()->user()->name);
    }
}
