<?php

namespace App\Http\Controllers\Siswa\Leader;

use Yajra\DataTables\Facades\DataTables;
use App\Models\UserGroup;
use App\Models\MailConcept;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MailConceptRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LeaderMailConceptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static $group_id, $classroom_id;

    public function __construct()
    {
        $this->middleware('auth');

        // self::$group_id = UserGroup::select('group_id')->find(Auth::id());;
        // self::$classroom_id = User::select('classroom_id')->find(Auth::id());
    }

    public function index()
    {
        return view('siswa.leader.mailconcept')->with('nama', auth()->user()->name);
    }

    public function mail_concept_data()
    {
        $group_id = UserGroup::select('group_id')->where('user_id', Auth::id())->first();
        $data = MailConcept::select('mail_concepts.user_id', 'name', 'mail_concept', 'status', 'mail_concepts.id as conceptID')
            ->join('users', 'users.id', '=', 'mail_concepts.user_id')
            ->join('groups', 'groups.id', '=', 'mail_concepts.group_id')
            ->where('groups.id', $group_id['group_id'])
            ->get();


        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function ($data) {

                if ($data['status'] == 1) {
                    $btn =
                        '<a  href="" class="btn-secondary btn-sm mx-auto">
        <i class="mdi mdi-folder-outline icon-sm"></i></a>';
                } elseif ($data['status'] == 0) {

                    $btn = '
                    <div class="row mx-auto">' .
                        '<button data-toggle="modal"  onclick="getclick(' . $data['conceptID'] . ')"  data-target="#editKonsep" data-ID=' . $data['conceptID'] . ' id="edit_button" class=" btn-primary p-0">
                      <i class="mdi mdi-lead-pencil icon-sm"></i></button>' .

                        '<form action="' . route('delete_concept', $data['conceptID']) . '" method="post" class="">' .
                        @csrf_field() . '
                    <button type="submit"  class=" btn-danger p-0"> <i class="mdi mdi-delete icon-sm"></i></button></form>' .
                        '</div>';
                }

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(MailConceptRequest $request)
    {
        $group_id = UserGroup::select('group_id')->where('user_id', Auth::id())->first();
        $classroom_id = User::select('classroom_id')->find(Auth::id());

        $mail_concept = new MailConcept();
        $mail_concept->mail_concept = strip_tags($request->mail_concept);
        $mail_concept->user_id = auth()->user()->id;
        $mail_concept->date = date('Y-m-d');
        $mail_concept->status = 0;
        $mail_concept->classroom_id = $classroom_id->classroom_id;
        $mail_concept->group_id = $group_id->group_id;
        $mail_concept->save();
        return redirect()->back();
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
    public function update(MailConceptRequest $request)
    {

        $edit_concept = MailConcept::find($request->id);
        $edit_concept->mail_concept = strip_tags($request->mail_concept);
        $edit_concept->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $edit_concept = MailConcept::find($request->id);
        $edit_concept->delete();
        return redirect()->back();
    }
}
