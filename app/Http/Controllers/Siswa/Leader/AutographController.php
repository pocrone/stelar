<?php


namespace App\Http\Controllers\Siswa\Leader;

use App\Models\Autograph;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Siswa\Leader\Autograph as LeaderAutograph;

class AutographController extends Controller
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
        $filename = Autograph::select('autograph')
            ->join('users', 'users.id', '=', 'autographs.user_id')
            ->where('user_id', auth()->user()->id)
            ->first();


        return view('siswa.leader.autograph')
            ->with('nama', auth()->user()->name)
            ->with('autograph', $filename);
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
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlx,jpg,png|max:2048'
        ]);
        $fileModel = new Autograph();
        if ($request->file()) {

            $extension =  $request->file('file')->extension();

            $fileName = 'TTD' . '_' . auth()->user()->name . '.' . $extension;
            $filePath = $request->file('file')->storeAs('autograph', $fileName, 'public');
            $save = Autograph::updateOrCreate(['user_id' => auth()->user()->id], ['autograph' => $fileName]);
            return back()
                ->with('success', 'File has been uploaded.')
                ->with('autograph', $fileName);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Autograph  $autograph
     * @return \Illuminate\Http\Response
     */
    public function show(Autograph $autograph)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Autograph  $autograph
     * @return \Illuminate\Http\Response
     */
    public function edit(Autograph $autograph)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Autograph  $autograph
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Autograph $autograph)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Autograph  $autograph
     * @return \Illuminate\Http\Response
     */
    public function destroy(Autograph $autograph)
    {
        //
    }
}
