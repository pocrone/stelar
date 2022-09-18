<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guru_AssignmentRequest;
use App\Models\Assignments;
use App\Models\Classroom;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create($classroom_id)
    {
        $data = [
            'nama' => auth()->user()->name,
            'id' => $classroom_id,
            'class_name' => Classroom::find($classroom_id)->class_name
        ];
        return view('guru.tugas.create', $data);
    }
    public function insert(Guru_AssignmentRequest $request)
    {
        $id =  $request->input('classroom_id');

        if ($request->file()) {

            $ext = $request->file('attachment')->extension();
            $fileName = 'tugas_' . uniqid() . '.' . $ext;
            $filePath = $request->file('attachment')->storeAs('assignments', $fileName, 'public');

            $assignment_id = Assignments::insertGetId(
                [
                    'title' => $request->input('title'),
                    'content' => $request->input('content'),
                    'classroom_id'  => $id,
                    'attachment' => $fileName,
                    'created_at' => Carbon::now()
                ],
            );
        } else {
            $assignment_id = Assignments::insertGetId(
                [
                    'title' => $request->input('title'),
                    'content' => $request->input('content'),
                    'classroom_id'  => $id,
                    'attachment' => "",
                    'created_at' => Carbon::now()
                ],
            );
        }
        return redirect('guru/show_assignment/' . $id . '/' . $assignment_id);
    }
    public function show($classroom_id, $assignment_id)
    {
        $data = [
            'nama' => auth()->user()->name,
            'id' => $classroom_id,
            'assignment' => Assignments::find($assignment_id),
            'class_name' => Classroom::find($classroom_id)->class_name


        ];
        return view('guru.tugas.index', $data);
    }
    public function download($assignment_id)
    {
        $fileName = Assignments::find($assignment_id)->attachment;
        return Storage::download('public/assignments/' . $fileName);
    }
    public function delete($assignment_id)
    {
        $classroom_id = Assignments::find($assignment_id)->classroom_id;
        //delete from storage
        $fileName = Assignments::find($assignment_id)->attachment;
        if ($fileName != "") {
            Storage::delete('public/assignments/' . $fileName);
        }

        //update DB
        Assignments::where('id', $assignment_id)->delete();
        return redirect('guru/course/' . $classroom_id);
    }
    public function edit($assignment_id)
    {
        $classroom_id = Assignments::find($assignment_id)->classroom_id;
        $data = [
            'nama' => auth()->user()->name,
            'id' => $classroom_id,
            'assignment' => Assignments::find($assignment_id),
            'class_name' => Classroom::find($classroom_id)->class_name


        ];
        return view('guru.tugas.edit', $data);
    }
    public function update(Guru_AssignmentRequest $request)
    {
        $assignment_id = $request->input('assignment_id');
        $classroom_id = Assignments::find($assignment_id)->classroom_id;
        if ($request->file()) {
            //delete old file from storage
            $old_fileName = Assignments::find($assignment_id)->attachment;
            Storage::delete('public/assignments/' . $old_fileName);

            //store
            $ext = $request->file('attachment')->extension();
            $fileName = 'materi_' . uniqid() . '.' . $ext;
            $filePath = $request->file('attachment')->storeAs('assignments', $fileName, 'public');
            //update DB
            Assignments::where('id', $assignment_id)->update(
                [
                    'title' => $request->input('title'),
                    'content' => $request->input('content'),
                    'attachment' => $fileName,
                    'updated_at' => Carbon::now()
                ],
            );
        } else {
            Assignments::where('id', $assignment_id)->update(
                [
                    'title' => $request->input('title'),
                    'content' => $request->input('content'),
                    'updated_at' => Carbon::now()
                ],
            );
        }
        return  redirect('guru/show_assignment/' . $classroom_id . '/' . $assignment_id);
    }
    public function delete_attachment($assignment_id)
    {
        //delete from storage
        $fileName = Assignments::find($assignment_id)->attachment;
        Storage::delete('public/assignments/' . $fileName);
        //update DB
        Assignments::where('id', $assignment_id)->update([
            'attachment' => ''
        ]);
        return redirect('guru/edit_assignment/' . $assignment_id);
    }
}
