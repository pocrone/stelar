<?php


namespace App\Http\Controllers\Siswa\Secretary;

use App\Models\Autograph;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use App\Models\Classification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SecretaryClassification extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $group_id = UserGroup::select('group_id')->where('user_id', Auth::id())->first();
            $data = Classification::select('classifications.*')
                // ->groupBy('classifications.class')
                ->orderBy('id', 'asc')
                ->where('group_id', $group_id->group_id)
                ->get();

            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<div class="row mx-auto">' .
                        '<button data-toggle="modal"  onclick="getclick_2(' . $data->id . ')"data-target="#editKlasifikasi" id="edit_button" class=" btn btn-primary p-0">
                    <i class="mdi mdi-lead-pencil icon-sm"></i></button>' .

                        '<form action="' . route("delete_classification", $data->id) . '" method="post">' .
                        @csrf_field() . '
            <button type="submit"   class="  btn-danger btn-sm p-0">
            <i class="mdi mdi-delete icon-sm"></button></form>' .
                        '</div>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('siswa.secretary.classification')->with('nama', auth()->user()->name);
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
        $group_id = UserGroup::select('group_id')->where('user_id', Auth::id())->first();
        $classification = new Classification;
        $classification->class = $request->class;
        $classification->sub_class = $request->sub_class;
        $classification->group_id = $group_id->group_id;
        $classification->save();

        return redirect()->back();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data = [
            'class' => $request->class,
            'sub_class' => $request->sub_class
        ];
        $query = Classification::where('id', $request->id)->update($data);
        return redirect()->back();
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
    public function delete(Request $request)
    {
        $data = Classification::where('id', $request->id)->delete();
        return redirect()->back();
    }
}
