<?php

namespace App\Http\Controllers\Siswa\Kelas;

use App\Models\User;
use App\Models\Classroom;
use App\Models\Lessons;
use App\Models\Assignments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClassDetailController extends Controller
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

    public function index()
    {
        // SELECT * FROM `classrooms` INNER JOIN users ON users.classroom_id=classrooms.id AND users.id=32;
        $classroom = Classroom::join('users', 'users.classroom_id', '=', 'classrooms.id')
            ->where('users.id', Auth::user()->id)->first();
        $lessons = Lessons::where('classroom_id', $classroom->classroom_id)->get();
        $assignments = Assignments::where('classroom_id', $classroom->classroom_id)->get();

        return view('siswa.kelas.classdetail')
            ->with('classroom', $classroom)
            ->with('lessons', $lessons)
            ->with('assignments', $assignments)
            ->with('nama', auth()->user()->name);
    }

    public function exitclass()
    {
        $student = User::where('id', Auth::id())->update(['classroom_id' => null]);
        return redirect()->route('std_list_class');
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
    public function destroy(Request $id)
    {
        $student = User::where('classroom_id', $id)->delete();
        return redirect()->route('std_classdetail');
    }
}
