<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Group;
use App\Models\MailConcept;
use App\Models\UserGroup;
use App\Models\Assignments;
use App\Models\GroupAssignments;
use App\Http\Requests\Guru_EvaluateRequest;
use App\Models\Classroom;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($group_id)
    {
        // SELECT * FROM `assignments` INNER JOIN groups ON groups.classroom_id=assignments.classroom_id LEFT OUTER JOIN group_assignments ON group_assignments.group_id=groups.id WHERE groups.id=2;
        $classroom_id = Group::find($group_id)->classroom_id;
        $group_list = Group::where('classroom_id', $classroom_id)->get();
        $assignment_results = Assignments::select('assignments.*', 'groups.*', 'assignments.id as result_id')
            ->join('groups', 'groups.classroom_id', '=', 'assignments.classroom_id')
            ->where('assignments.classroom_id', $classroom_id)
            ->where('groups.id', $group_id)
            ->get();

        foreach ($assignment_results as $array) {
            $array->value = "";
            if ($this->checkValue($array->result_id, $group_id)) {
                $array->value = $this->getValue($array->result_id, $group_id);
                $array->comment = $this->getComment($array->result_id, $group_id);
            } else {
                $array->value = NULL;
                $array->comment = NULL;
            }
        }


        $user_group = UserGroup::select('*', 'users.id as user_id')
            ->join('users', 'user_groups.user_id', '=', 'users.id')
            ->join('groups', 'groups.id', '=', 'user_groups.group_id')
            ->where('user_groups.group_id', $group_id)
            ->get();
        $data = [
            'nama' => auth()->user()->name,
            'group' => Group::find($group_id),
            'group_id' => $group_id,
            'user_group' => $user_group,
            'assignment_results' => $assignment_results,
            'group_list' => $group_list
        ];
        return view('guru.progres.index', $data);
    }
    public function evaluate(Guru_EvaluateRequest $request)
    {
        $group_id = $request->input('group_id');
        $assignment_id = $request->input('assignment_id');
        if ($this->checkValue($assignment_id, $group_id)) {
            # update
            GroupAssignments::where('group_id', $group_id)
                ->where('assignments_id', $assignment_id)
                ->update(
                    [
                        'value' => $request->input('value'),
                        'comment' => $request->input('comment')
                    ]
                );
        } else {
            # insert
            GroupAssignments::insert(
                [
                    'group_id' => $group_id,
                    'assignments_id' => $assignment_id,
                    'value' => $request->input('value'),
                    'comment' => $request->input('comment')
                ]
            );
        }
        return \redirect('guru/progress/' . $group_id);
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
