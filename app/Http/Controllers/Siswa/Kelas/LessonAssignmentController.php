<?php

namespace App\Http\Controllers\Siswa\Kelas;

use App\Models\User;
use App\Models\Lessons;
use App\Models\Classroom;
use App\Models\UserGroup;
use App\Models\Assignments;
use Illuminate\Http\Request;
use App\Models\GroupAssignments;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LessonAssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function tugas($id_tugas)
    {
        $group_id = UserGroup::select('group_id')->where('user_id', Auth::id())->first();
        $classroom = Classroom::join('users', 'users.classroom_id', '=', 'classrooms.id')
            ->where('users.id', Auth::user()->id)->first();
        $assignments = Assignments::find($id_tugas);
        $score = GroupAssignments::where(['assignments_id' => $id_tugas, 'group_id' => $group_id->group_id])->first();



        return view('siswa.kelas.tugas')
            ->with('classroom', $classroom)
            ->with('assignment', $assignments)
            ->with('score', $score)
            ->with('nama', auth()->user()->name);
    }
    public function download_tugas($assignment_id)
    {
        $fileName = Assignments::find($assignment_id)->attachment;
        return Storage::download('public/assignments/' . $fileName);
    }
    public function materi($id_materi)
    {
        $classroom = Classroom::join('users', 'users.classroom_id', '=', 'classrooms.id')
            ->where('users.id', Auth::user()->id)->first();
        $lesson = Lessons::find($id_materi);

        return view('siswa.kelas.materi')
            ->with('classroom', $classroom)
            ->with('lesson', $lesson)
            ->with('nama', auth()->user()->name);
    }
    public function download_materi($lesson_id)
    {
        $fileName = Lessons::find($lesson_id)->attachment;
        return Storage::download('public/lessons/' . $fileName);
    }
}
