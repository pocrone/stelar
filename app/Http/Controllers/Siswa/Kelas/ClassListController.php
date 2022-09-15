<?php

namespace App\Http\Controllers\Siswa\Kelas;

use App\Models\User;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomsRequest;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;

class ClassListController extends Controller
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
        $get_kelas = User::where('id', auth()->user()->id)->first();

        $list_kelas = Classroom::select('classrooms.*')
            ->get();

        $status = [];
        if ($get_kelas['classroom_id'] == null) {
            $status['status'] = 0;
            $choose_class = [];
        } else {
            $choose_class = Classroom::select('classrooms.*')->where('id', $get_kelas['classroom_id'])->first();
            $status['status'] = 1;
        }

        return view('siswa.kelas.classlist')
            ->with('list', $list_kelas)
            ->with($status)
            ->with('class', $choose_class)
            ->with('nama', auth()->user()->name);
    }

    public function joinClass(ClassroomsRequest $request)
    {
        $data = Classroom::where('class_code', $request->class_code)->first();


        if (!empty($data)) {
            $update_data = [
                'classroom_id' => $data['id']
            ];
            $query = User::where('id', auth()->user()->id)->update($update_data);
            return redirect()->back();
        } else {
            return redirect('/siswa/daftar_kelas')
                ->with('gagal', 'Kode kelas yang kamu tulis tidak ditemukan atau tidak ada');
        }
    }
}
