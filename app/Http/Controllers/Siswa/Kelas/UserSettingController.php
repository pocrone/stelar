<?php

namespace App\Http\Controllers\Siswa\Kelas;

use App\Models\User;
use App\Models\Lessons;
use App\Models\Classroom;
use App\Models\Assignments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserSettingRequest;
use App\Http\Requests\UserSettingPasswordRequest;

class UserSettingController extends Controller
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
        $data = User::find(auth()->user()->id);

        return view('siswa.kelas.usersetting')
            ->with('nama', auth()->user()->name)
            ->with('user', $data);
    }

    public function editPassword()
    {
        $data = User::find(auth()->user()->id);

        return view('siswa.kelas.usersetting_password')
            ->with('nama', auth()->user()->name)
            ->with('user', $data);
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
    public function store(UserSettingRequest $request)
    {
        $user_data = User::find(auth()->user()->id);

        if (empty($request->name)) {
            $request->name = $user_data->name;
        }


        if (empty($request->file)) {
            $account = [
                // 'email' => $request->email,
                'name' => $request->name,
            ];
            $update_data = User::where('id', auth()->user()->id)->update($account);
            return redirect()->back();
        } else {
            if ($request->file()) {
                $extension =  $request->file('file')->extension();
                $fileName = 'avatar' . '_' . auth()->user()->name . '.jpg';
                $filePath = $request->file('file')->storeAs('avatar', $fileName, 'public');
                $account = [
                    // 'email' => $request->email,
                    'name' => $request->name,
                    'avatar' => $fileName,
                ];
                $update_data = User::where('id', auth()->user()->id)->update($account);
                return redirect()->back();
            }
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function managePassword(UserSettingPasswordRequest $request)
    {
        $user_password = User::find(auth()->user()->id);
        $match = Hash::check(request('old_password'), $user_password->password);

        if ($match == true) {
            $account = [
                'password' => Hash::make($request->password),
            ];
            $update_data = User::where('id', auth()->user()->id)->update($account);
            return redirect()->back()->with('success', 'Sukses merubah password');
        } else {
            return back()->with('gagal', 'Password yang lama tidak sesuai');
        }
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
    public function destroy($id)
    {
        //
    }
}
