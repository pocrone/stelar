<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Classroom;
use App\Models\User;
use App\Models\Group;
use App\Models\UserGroup;


class HomeController extends Controller
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
        if (Auth::user()->role == '2') {
            $id_user = Auth::user()->id;
            $classroom = User::join('classrooms', 'classrooms.id', '=', 'users.classroom_id')
                ->where('users.id', $id_user)->first();
            $teacher = User::where('id', $classroom->user_id)->first()->name;
            $user_group_status = UserGroup::where('user_id', $id_user)->exists();
            // SELECT * FROM `groups` INNER JOIN user_groups ON user_groups.group_id=groups.id WHERE user_groups.user_id=32;
            $user_group_data = Group::join('user_groups', 'user_groups.group_id', '=', 'groups.id')
                ->where('user_groups.user_id', $id_user)
                ->first();
            $data = [
                'nama' => auth()->user()->name,
                'classroom' => $classroom,
                'teacher' => $teacher,
                'user_group_status' => $user_group_status,
                'group' => $user_group_data
            ];
            return view('siswa.gates', $data);
        } elseif (Auth::user()->role == '1') {
            $data = [
                'nama' => auth()->user()->name,
                'classroom' => Classroom::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get()
            ];
            return view('guru.gates', $data);
        }
    }
}
