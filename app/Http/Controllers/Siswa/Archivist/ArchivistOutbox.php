<?php

namespace App\Http\Controllers\Siswa\Archivist;

use App\Models\User;
use App\Models\Autograph;
use App\Models\Inboxmail;
use App\Models\UserGroup;
use App\Models\OutboxMail;
use App\Models\MailConcept;
use Illuminate\Http\Request;
use App\Models\Classification;
use App\Models\MailCorrection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ArchivistOutbox extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $group_id = UserGroup::select('group_id')->where('user_id', Auth::id())->first();
            $data = OutboxMail::select('outbox_mails.id', 'outboxmail_number', 'mail_date', 'mail_about', 'retention_status',  'active_year', 'inactive_year', 'save_location', 'class', 'sub_class', 'mail_detail', 'name')
                ->leftjoin('classifications', 'classifications.id', '=', 'classification_id')
                ->join('groups', 'groups.id', '=', 'outbox_mails.group_id')
                ->join('users', 'users.id', '=', 'outbox_mails.user_id')
                ->where('outbox_mails.group_id', $group_id->group_id)->get();


            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn =
                        '<div class="row">' .
                        '<a href="' . route("viewMail_arc", $data->id) . '" class=" btn-success mx-auto text-white btn-sm">
                <i class="mdi mdi-folder-outline icon-sm"></i> </a>';

                    return $btn;
                })


                // ->rawColumns(['action'])
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('siswa.archivist.outbox')->with('nama', auth()->user()->name);;
    }

    public function getstatus_koreksi($id)
    {
        $data = MailCorrection::where('status_koreksi', 1)->where('outbox_mail_id', $id)->exists();
        return $data;
    }

    public function viewMail(Request $request)
    {
        $classification = Classification::select('*')->get();
        $koreksi_surat = MailCorrection::where('outbox_mail_id', $request->id)->get();
        $autograph = Autograph::where('user_id', auth()->user()->id)->first();
        $cek_status = $this->getstatus_koreksi($request->id);
        $data = OutboxMail::where('outbox_mails.id', $request->id)
            ->leftjoin('classifications', 'classifications.id', '=', 'outbox_mails.classification_id')
            ->select('outbox_mails.*', 'outbox_mails.id as outboxID')
            ->first();;
        return view('siswa.archivist.view_mail')
            ->with('mail', $data)
            ->with('ttd', $autograph)
            ->with('classification', $classification)
            ->with('status_koreksi', $cek_status)
            ->with('data_koreksi', $koreksi_surat)
            ->with('nama', auth()->user()->name);
    }

    public function upload_mail(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlx,jpg,png|max:2048'
        ]);

        $fileModel =  InboxMail::find($request->id);
        if ($request->file()) {
            $extension =  $request->file('file')->extension();
            $fileName = 'outbox' . '_' . time() . '.' . $extension;
            $filePath = $request->file('file')->storeAs('outbox', $fileName, 'public');

            $data = ['file' => $fileName];
            $update  = OutboxMail::where('id', $request->id)->update($data);;

            return back()
                ->with('success', 'File has been uploaded.')
                ->with('autograph', $fileName);
        }
    }

    public function exportPDF(Request $request)
    {
        $mail = OutboxMail::where('id', $request->id)->first();

        $data = [
            'mail' => $mail,
            'image' => asset('storage/logo_outbox/' . $mail->logo)
        ];

        // return $mail;

        // return view('siswa.secretary.export_outbox', $data);

        $pdf = PDF::loadView('siswa.secretary.export_outbox', ['mail' => $mail, 'image' => asset('storage/logo_outbox/' . $mail->logo)]);
        return $pdf->stream($data['mail']['outboxmail_number'] . '.pdf');

        // return $pdf->download($data['mail']['outboxmail_number'] . '.pdf');
    }

    public function edit_classification(Request $request)
    {
        $data = [
            'classification_id' => $request->class
        ];
        $update = OutboxMail::where('id', $request->id)->update($data);
        return redirect()->back();
    }
    public function set_location(Request $request)
    {
        $data = [
            'save_location' => $request->mail_location
        ];
        $update = OutboxMail::where('id', $request->id)->update($data);
        return redirect()->back();
    }
    public function set_retention(Request $request)
    {
        $data = [
            'active_year' => $request->active_year,
            'inactive_year' => $request->inactive_year,
            'retention_status' => $request->status_retention
        ];
        $update = OutboxMail::where('id', $request->id)->update($data);
        return redirect()->back();
    }
}
