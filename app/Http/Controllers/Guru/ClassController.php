<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Guru_ClassroomRequest;
use App\Models\Classroom;
use App\Models\User;
use App\Models\Lessons;
use App\Models\Assignments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClassController extends Controller
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
    public function index($id)
    {
        $data = [
            'nama' => auth()->user()->name,
            'course' => Classroom::find($id),
            'jumlah_siswa' => User::where('classroom_id', $id)->count(),
            'lessons' => Lessons::where('classroom_id', $id)->get(),
            'count_lesson' => Lessons::where('classroom_id', $id)->count(),
            'assignments' => Assignments::where('classroom_id', $id)->get(),
            'count_assignments' => Assignments::where('classroom_id', $id)->count(),
            'id' => $id,
            'class_name' => Classroom::find($id)->class_name

        ];
        return view('guru.kelas.course', $data);
    }

    public function createClass()
    {
        $data = ['nama' => auth()->user()->name];
        return view('guru.kelas.create', $data);
    }


    public function store(Guru_ClassroomRequest $request)
    {
        $classroom_id = Classroom::insertGetId(
            [
                'class_name' => $request->input('class_name'),
                'user_id' => Auth::id(),
                'class_code' => $this->generateCode()
            ]
        );
        return  redirect('guru/course/' . $classroom_id);
    }
    private function generateCode()
    {
        $random_code = Str::random(5);
        $random_code = Str::upper($random_code);
        if (Classroom::where('class_code', $random_code)->exists()) {
            $this->generateCode();
        }
        return $random_code;
    }


    public function edit($id)
    {
        $data = [
            'nama' => auth()->user()->name,
            'classroom' => Classroom::find($id),
            'id' => $id,
            'class_name' => Classroom::find($id)->class_name

        ];
        return view('guru.kelas.edit', $data);
    }

    public function update(Guru_ClassroomRequest $request)
    {
        $id = $request->input('id');
        $class_name = $request->input('class_name');
        Classroom::where('id', $id)->update(['class_name' => $class_name]);
        return  redirect('guru/course/' . $id);
    }

    public function delete($id)
    {
        Classroom::where('id', $id)->delete();
        return redirect('home');
    }
}
