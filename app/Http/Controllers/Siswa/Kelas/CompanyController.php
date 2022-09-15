<?php

namespace App\Http\Controllers\Siswa\Kelas;

use DataTables;
use App\Models\Group;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CompanyRequest;

class CompanyController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (UserGroup::where('user_id', Auth::id())->exists()) {

            $group_id = UserGroup::select('group_id')->where('user_id', Auth::id())->first();
            $data['info'] = UserGroup::select('groupname', DB::raw('count(*) as total'), 'name', 'LeaderGroupID')
                ->join('groups', 'groups.id', '=', 'user_groups.group_id')
                ->join('users', 'users.id', '=', 'groups.LeaderGroupID')
                ->groupBy('groupname', 'name', 'LeaderGroupID')
                ->where('groups.id', $group_id->group_id)->first();

            $data['member'] = UserGroup::select('*')
                ->join('users', 'users.id', '=', 'user_groups.user_id')
                ->where('user_groups.group_id', $group_id->group_id)->get();

            $data['group_id'] = $group_id;
            $data['userID'] = Auth::id();

            return view('siswa.kelas.company')->with('data', $data)->with('nama', auth()->user()->name);
        } else {
            return view('siswa.kelas.company')->with('nama', auth()->user()->name);
        }
    }
    public function dataCompany()
    {

        $data = UserGroup::select('groupname', DB::raw('count(*) as total'), 'name', 'LeaderGroupID', 'group_id')
            ->join('groups', 'groups.id', '=', 'user_groups.group_id')
            ->join('users', 'users.id', '=', 'groups.LeaderGroupID')
            ->groupBy('groupname', 'name', 'LeaderGroupID', 'group_id');

        return Datatables::of($data)

            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                if ($row->total < 4) {
                    $status = route('joinCompany', $row->group_id);
                    $class = 'btn-primary';
                } else {

                    $status = 'javascript:void(0)';
                    $class = 'btn-secondary';
                }
                $btn = '<a href="' . $status . '" class="edit btn btn-primary btn-sm ' . $class . '" >Join</a>';

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
    public function createCompany(CompanyRequest $request)
    {
        $company = new Group();
        $company->groupname = $request->groupname;
        $company->LeaderGroupID = Auth::id();
        $company->save();
        $id = DB::getPdo()->lastInsertId();
        $user_group = new UserGroup();
        $user_group->group_id = $id;
        $user_group->user_id = Auth::id();
        $user_group->save();

        return redirect('/siswa/company')->with('success', 'Kamu telah berhasil membuat perusahaan/kelompok baru');
    }

    public function joinCompany(Request $request)
    {
        $user_group = new UserGroup();
        $user_group->group_id = $request->id;
        $user_group->user_id = Auth::id();
        $user_group->save();
        return redirect('/siswa/company')->with('success', 'Kamu telah berhasil join perusahaan/kelompok');
    }

    public function leaveGroup(Request $request)
    {
        UserGroup::where('user_id', $request->user_id)
            ->delete();
        return redirect('/siswa/company')->with('warn', 'Kamu telah berhasil keluar perusahaan/kelompok');
    }

    public function deleteGroup(Request $request)
    {
        Group::where('id', $request->group_id)->delete();

        UserGroup::where('group_id', $request->group_id)->delete();
        return redirect('/siswa/company')->with('warn', 'Kamu telah berhasil menghapus  perusahaan/kelompok');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
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
