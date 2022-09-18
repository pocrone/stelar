<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guru_LessonRequest;
use App\Models\Classroom;
use App\Models\Lessons;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id)
    {
    }
    public function create($id)
    {
        $data = [
            'nama' => auth()->user()->name,
            'id' => $id,
            'class_name' => Classroom::find($id)->class_name

        ];
        return view('guru.materi.create', $data);
    }
    public function insert(Guru_LessonRequest $request)
    {
        $id =  $request->input('classroom_id');

        if ($request->file()) {

            $ext = $request->file('attachment')->extension();
            $fileName = 'materi_' . uniqid() . '.' . $ext;
            $filePath = $request->file('attachment')->storeAs('lessons', $fileName, 'public');

            $lesson_id = Lessons::insertGetId(
                [
                    'title' => $request->input('title'),
                    'content' => $request->input('content'),
                    'classroom_id'  => $id,
                    'attachment' => $fileName,
                    'created_at' => Carbon::now()
                ],
            );
        } else {
            $lesson_id = Lessons::insertGetId(
                [
                    'title' => $request->input('title'),
                    'content' => $request->input('content'),
                    'classroom_id'  => $id,
                    'attachment' => "",
                    'created_at' => Carbon::now()
                ],
            );
        }
        return redirect('guru/show_lesson/' . $id . '/' . $lesson_id);
    }
    public function show($classroom_id, $lesson_id)
    {
        $data = [
            'nama' => auth()->user()->name,
            'id' => $classroom_id,
            'lesson' => Lessons::find($lesson_id),
            'class_name' => Classroom::find($classroom_id)->class_name

        ];
        return view('guru.materi.index', $data);
    }
    public function download($lesson_id)
    {
        $fileName = Lessons::find($lesson_id)->attachment;
        return Storage::download('public/lessons/' . $fileName);
    }
    public function delete($lesson_id)
    {
        $classroom_id = Lessons::find($lesson_id)->classroom_id;
        //delete from storage
        $fileName = Lessons::find($lesson_id)->attachment;
        if ($fileName != "") {
            Storage::delete('public/lessons/' . $fileName);
        }

        //update DB
        Lessons::where('id', $lesson_id)->delete();
        return redirect('guru/course/' . $classroom_id);
    }
    public function edit($lesson_id)
    {
        $classroom_id = Lessons::find($lesson_id)->classroom_id;
        $data = [
            'nama' => auth()->user()->name,
            'id' => $classroom_id,
            'lesson' => Lessons::find($lesson_id),
            'class_name' => Classroom::find($classroom_id)->class_name


        ];
        return view('guru.materi.edit', $data);
    }
    public function update(Guru_LessonRequest $request)
    {
        $lesson_id = $request->input('lesson_id');
        $classroom_id = Lessons::find($lesson_id)->classroom_id;
        if ($request->file()) {
            //delete old file from storage
            $old_fileName = Lessons::find($lesson_id)->attachment;
            Storage::delete('public/lessons/' . $old_fileName);

            //store
            $ext = $request->file('attachment')->extension();
            $fileName = 'materi_' . uniqid() . '.' . $ext;
            $filePath = $request->file('attachment')->storeAs('lessons', $fileName, 'public');
            //update DB
            Lessons::where('id', $lesson_id)->update(
                [
                    'title' => $request->input('title'),
                    'content' => $request->input('content'),
                    'attachment' => $fileName,
                    'updated_at' => Carbon::now()
                ],
            );
        } else {
            Lessons::where('id', $lesson_id)->update(
                [
                    'title' => $request->input('title'),
                    'content' => $request->input('content'),
                    'updated_at' => Carbon::now()
                ],
            );
        }
        return  redirect('guru/show_lesson/' . $classroom_id . '/' . $lesson_id);
    }
    public function delete_attachment($lesson_id)
    {
        //delete from storage
        $fileName = Lessons::find($lesson_id)->attachment;
        Storage::delete('public/lessons/' . $fileName);
        //update DB
        Lessons::where('id', $lesson_id)->update([
            'attachment' => ''
        ]);
        return redirect('guru/edit_lesson/' . $lesson_id);
    }
}
