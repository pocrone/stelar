<?php

namespace App\Http\Controllers\Guru;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Group;
use App\Models\Classroom;
use App\Models\Assignments;
use Illuminate\Http\Request;
use App\Models\GroupAssignments;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Guru_AssignmentRequest;


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

        $class = User::find(Auth::id())->first();

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
    public function show(Request $request, $classroom_id, $assignment_id)
    {
        $group = Group::where('classroom_id', $classroom_id)->get();
        foreach ($group as $array) {
            $array->value = "";
            if ($this->checkValue($assignment_id, $array->id)) {
                $array->value = $this->getValue($assignment_id, $array->id);
                $array->comment = $this->getComment($assignment_id, $array->id);
            } else {
                $array->value = NULL;
                $array->comment = NULL;
            }
        }

        if ($request->ajax()) {

            return Datatables::of($group)
                ->addColumn('value', function ($group) {
                    $val = $group->value;
                    return $val;
                })
                ->addColumn('comment', function ($group) {
                    $val = $group->comment;
                    return $val;
                })
                ->addColumn('action', function ($group) {
                    $btn = '<a href=' .
                        route('progress', ['group_id' => $group->id]) .
                        '>Lihat Progress</a>';
                    return $btn;
                })
                ->addIndexColumn()
                ->make(true);
        }
        $data = [
            'nama' => auth()->user()->name,
            'id' => $classroom_id,
            'assignment_id' => $assignment_id,
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
    private function checkValue($assignment_id, $group_id)
    {
        $check = GroupAssignments::where('assignments_id', $assignment_id)
            ->where('group_id', $group_id)->exists();
        return $check;
    }
    private function getValue($assignment_id, $group_id)
    {
        $value = GroupAssignments::where('assignments_id', $assignment_id)
            ->where('group_id', $group_id)->first()->value;
        return $value;
    }
    private function getComment($assignment_id, $group_id)
    {
        $comment = GroupAssignments::where('assignments_id', $assignment_id)
            ->where('group_id', $group_id)->first()->comment;
        return $comment;
    }
}
