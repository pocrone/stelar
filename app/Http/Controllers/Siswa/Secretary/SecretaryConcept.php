<?php

namespace App\Http\Controllers\Siswa\Secretary;

use App\Models\UserGroup;

use App\Models\MailConcept;
use Illuminate\Http\Request;
use App\Models\Classification;
use App\Http\Controllers\Controller;
use App\Models\OutboxMail;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SecretaryConcept extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $group_id = UserGroup::select('group_id')->where('user_id', Auth::id())->first();
            $data = MailConcept::select('mail_concepts.user_id', 'name', 'mail_concept', 'status', 'mail_concepts.id as conceptID')
                ->join('users', 'users.id', '=', 'mail_concepts.user_id')
                // // ->join('classrooms', 'classrooms.id', '=', 'users.classroom_id')
                ->where('group_id', $group_id->group_id)
                // ->where('classrooms.id', auth()->user()->classroom_id)
                ->get();


            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    if ($data->status == 1) {
                        $btn = '<div class="row mx-auto">' .
                            '<a  href="' . route('viewMail', $this->getOutboxID($data->conceptID)) . '" class="btn-secondary btn-sm mx-auto">
                        <i class="mdi mdi-folder-outline icon-sm"></i></a>';
                        return $btn;
                    } else {
                        $btn = '<div class="row mx-auto">' .
                            '<a  href="' . route('create_outbox', $data['conceptID']) . '" class="mx-auto btn-primary btn-sm">
                        <i class="mdi mdi-lead-pencil icon-sm"></i></a>';
                        return $btn;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
            // return $data;
        }

        return view('siswa.secretary.concept')->with('nama', auth()->user()->name);
    }

    public function getOutboxID($id)
    {
        $outbox_id = OutboxMail::select('id')->where('mail_concept_id', $id)->first();
        return $outbox_id->id;
    }
    public function dataConcept()
    {
        $data = MailConcept::select('mail_concepts.user_id', 'name', 'mail_concept', 'status', 'mail_concepts.id as conceptID')
            ->join('users', 'users.id', '=', 'mail_concepts.user_id')
            ->join('classrooms', 'classrooms.id', '=', 'users.classroom_id')
            ->where('classrooms.id', auth()->user()->classroom_id)
            ->get();


        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function ($data) {

                $btn = '<div class="row">' .
                    '<a  href="' . route('create_outbox', $data['conceptID']) . '" class="col-6 btn-primary btn-sm">
        <i class="ti-pencil
         text-white fa-sm"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        return $data;
    }
}
