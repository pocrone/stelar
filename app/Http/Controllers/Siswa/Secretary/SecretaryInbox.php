<?php

namespace App\Http\Controllers\Siswa\Secretary;


use App\Models\InboxMail;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SecretaryInbox extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $group_id = UserGroup::select('group_id')->where('user_id', Auth::id())->first();
            $data = InboxMail::select('inbox_mails.*', 'name')
                ->join('groups', 'groups.id', '=', 'inbox_mails.group_id')
                ->join('users', 'users.id', '=', 'inbox_mails.user_id')
                ->where('group_id', $group_id->group_id)
                ->get();


            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn =
                        '<div class="row">' .
                        '<a href="' . route("inbox_detail_secretary", $data->id) . '" class=" btn-success mx-auto text-white btn-sm">
                    <i class="mdi mdi-folder-outline icon-sm"></i> </a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('siswa.secretary.inbox')->with('nama', auth()->user()->name);
    }

    public function inbox_data()
    {
        $group_id = UserGroup::select('group_id')->where('user_id', Auth::id())->first();
        $data = InboxMail::select('inbox_mails.*', 'name')
            ->join('groups', 'groups.id', '=', 'inbox_mails.group_id')
            ->join('users', 'users.id', '=', 'inbox_mails.users_id')
            ->where('group_id', $group_id->group_id)
            ->get();

        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function ($data) {
                $btn =
                    '<div class="row">' .
                    '<a href="' . route('inbox_detail_secretary', $data->id) . '" class=" btn-success text-center text-white btn-sm">
                    <i class="ti-archive fa-lg"></i> </a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function inbox_detail(Request $request)
    {

        $user_group = UserGroup::select('group_id')->where('user_id', Auth::id())->first();
        $group_id =  InboxMail::where('inbox_mails.id', $request->id)->first();
        if ($group_id->group_id == $user_group->group_id) {
            $mail = InboxMail::where('inbox_mails.id', $request->id)
                ->join('dispositions', 'dispositions.inbox_mail_id', '=', 'inbox_mails.id')
                ->where('dispositions.status', 1)
                ->exists();

            if ($mail == 1) {
                $mail_data = InboxMail::where('inbox_mails.id', $request->id)
                    ->select('inbox_mails.*', 'inbox_mails.id as inboxID', 'classifications.*')
                    ->leftjoin('classifications', 'classifications.id', '=', 'inbox_mails.classification_id')->first();
                $mail_data['status_disposition'] = 1;
            } else {
                $mail_data = InboxMail::where('inbox_mails.id', $request->id)->select('inbox_mails.*', 'inbox_mails.id as inboxID', 'classifications.*')
                    ->leftjoin('classifications', 'classifications.id', '=', 'inbox_mails.classification_id')->first();
                $mail_data['status_disposition'] = 0;
            }

            return view('siswa.secretary.inbox_detail')
                ->with('data', $mail_data)
                ->with('nama', auth()->user()->name);
        } else {
            return view('siswa.leader.inbox_invalid')
                ->with('nama', auth()->user()->name);
        }
        // return $data;
    }

    public function store(Request $request)
    {

        if (empty($request->file)) {
            $user_group = UserGroup::select('group_id')->where('user_id', Auth::id())->first();
            $inbox = new InboxMail();
            $inbox->mail_number = $request->mail_number;
            $inbox->date = date("Y-m-d", strtotime($request->date));
            $inbox->time = date('H:i');
            $inbox->sender = $request->sender;
            $inbox->mail_attribute = $request->mail_attribute;
            $inbox->mail_about = $request->mail_about;
            $inbox->mail_summary = $request->mail_summary;
            $inbox->classroom_id = auth()->user()->classroom_id;
            $inbox->status = '1';
            $inbox->group_id = $user_group->group_id;
            $inbox->user_id = auth()->user()->id;;
            // $inbox->status = '1';

            $inbox->save();
            return redirect()->back();
        } else {
            $request->validate([
                'file.*' => 'required|mimes:csv,txt,xlx,jpg,png,doc,docx,pdf,jpeg,ppt,pptx|max:2048'
            ]);

            $fileModel =  InboxMail::find($request->id);
            if ($request->file()) {
                $extension =  $request->file('file')->extension();
                $fileName = 'inbox' . '_' . time() . '.' . $extension;
                $filePath = $request->file('file')->storeAs('inbox', $fileName, 'public');

                $user_group = UserGroup::select('group_id')->where('user_id', Auth::id())->first();
                $inbox = new InboxMail();
                $inbox->mail_number = $request->mail_number;
                $inbox->date = date("Y-m-d", strtotime($request->date));
                $inbox->time = date('H:i');
                $inbox->sender = $request->sender;
                $inbox->mail_attribute = $request->mail_attribute;
                $inbox->mail_about = $request->mail_about;
                $inbox->mail_summary = $request->mail_summary;
                $inbox->classroom_id = auth()->user()->classroom_id;
                $inbox->status = '1';
                $inbox->group_id = $user_group->group_id;
                $inbox->user_id = auth()->user()->id;
                $inbox->file = $fileName;
                // $inbox->status = '1';

                $inbox->save();

                return back()
                    ->with('success', 'File has been uploaded.')
                    ->with('autograph', $fileName);
            }
        }
    }
    public function edit(Request $request)
    {
        $data = [
            'mail_number' => $request->mail_number,
            'date' => $request->date,
            'sender' => $request->sender,
            'mail_attribute' => $request->mail_attribute,
            'mail_about' => $request->mail_about,
            'mail_summary' => $request->mail_summary,
        ];

        $update = InboxMail::where('id', $request->id)->update($data);

        return redirect()->back();
    }

    public function upload_mail(Request $request)
    {
        $request->validate([
            'file.*' => 'required|max:2048|mimes:csv,txt,xlx,jpg,png,doc,docx,pdf,jpeg,ppt,pptx',
        ]);

        $fileModel =  InboxMail::find($request->id);
        if ($request->file()) {
            $extension =  $request->file('file')->getClientOriginalExtension();
            $fileName = 'inbox' . '_' . time() . '.' . $extension;
            $filePath = $request->file('file')->storeAs('inbox', $fileName, 'public');

            $data = ['file' => $fileName];
            $update  = InboxMail::where('id', $request->id)->update($data);;

            return back()
                ->with('success', 'File has been uploaded.')
                ->with('autograph', $fileName);
        }
    }
    public function delete(Request $request)
    {
        $data = InboxMail::where('id', $request->id)->delete();
        return redirect()->back();
    }
}
