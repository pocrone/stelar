<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Group;
use App\Models\UserGroup;
use App\Models\Classroom;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\Request;

class StudentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request, $classroom_id)
    {
        if ($request->ajax()) {
            $students = User::select('users.*')->where('classroom_id', $classroom_id)->get();
            return Datatables::of($students)->addIndexColumn()
                ->addColumn('action', function ($students) {
                    $btn = '<a href=' .
                        route('delete_student', ['user_id' => $students->id]) .
                        '>Keluarkan dari kelas</a>';
                    return $btn;
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        $data = [
            'nama' => auth()->user()->name,
            'id' => $classroom_id,
            'class_name' => Classroom::find($classroom_id)->class_name,
            'count_students' => User::where('classroom_id', $classroom_id)->count(),
        ];
        return view('guru.siswa.index', $data);
    }
    public function delete($user_id)
    {
        $classroom_id = User::find($user_id)->classroom_id;
        User::where('id', $user_id)->update([
            'classroom_id' => NULL
        ]);
        return redirect('guru/students/' . $classroom_id);
    }
    public function groups(Request $request, $classroom_id)
    {
        $group = Group::select('*', 'groups.id as idg')->join('users', 'users.id', '=', 'groups.LeaderGroupID')->where('users.classroom_id', $classroom_id)->get();

        if ($request->ajax()) {

            return Datatables::of($group)
                ->addColumn('count', function ($group) {
                    $student_count = UserGroup::where('group_id', $group->idg)->count()  . '/4';
                    return $student_count;
                })
                ->addColumn('action', function ($group) {
                    $btn = '<a href="' . route('progress', ['group_id' => $group->idg]) . '">Lihat Progress</a>';
                    return $btn;
                })
                ->addIndexColumn()
                ->make(true);
        }
        $data = [
            'nama' => auth()->user()->name,
            'id' => $classroom_id,
            'class_name' => Classroom::find($classroom_id)->class_name,
            'count_students' => User::where('classroom_id', $classroom_id)->count(),
        ];
        return view('guru.siswa.groups', $data);
    }
}
