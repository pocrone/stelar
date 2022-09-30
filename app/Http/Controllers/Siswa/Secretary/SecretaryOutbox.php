<?php

namespace App\Http\Controllers\Siswa\Secretary;

use App\Models\User;
use App\Models\Autograph;
use App\Models\Inboxmail;
use App\Models\UserGroup;
use App\Models\OutboxMail;
use App\Models\MailConcept;
use Illuminate\Http\Request;
use App\Models\MailCorrection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SecretaryOutbox extends Controller
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
                        '<a href="' . route("viewMail", $data->id) . '" class=" btn-success mx-auto text-white btn-sm">
                <i class="mdi mdi-folder-outline icon-sm"></i> </a>';

                    return $btn;
                })


                // ->rawColumns(['action'])
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('siswa.secretary.outbox')->with('nama', auth()->user()->name);;
    }

    public function createOutbox(Request $request)
    {
        $data = MailConcept::where('mail_concepts.id', $request->id)
            ->select('*', 'mail_concepts.id as conceptID')
            ->join('users', 'users.id', '=', 'mail_concepts.user_id')
            ->first();
        return view('siswa.secretary.create_outbox')
            ->with('concept', $data)
            ->with('nama', auth()->user()->name);
    }

    public function storeMail(Request $request)
    {
        $class = User::select('classroom_id')->where('id', Auth::id())->first();
        $identity = UserGroup::select('group_id')->where('user_id', Auth::id())->first();

        if (empty($request->logo)) {
            $data = [
                'main_institution' => $request->main_institution,
                'name_institution' => $request->name_institution,
                'phone_institution' => $request->phone_institution,
                'email_institution' => $request->email_institution,
                'address_institution' => $request->address_institution,


                'outboxmail_number' => $request->outboxmail_number,
                'mail_date' => $request->mail_date,
                'attachment' => $request->attachment,
                'mail_about' => $request->mail_about,

                'mail_recevier' => $request->mail_recevier,
                'mail_destination' => $request->mail_destination,
                'city_destination' => $request->city_destination,


                'preambule' => $request->preambule,
                'mail_detail' => $request->mail_detail,
                'closing_sentence' => $request->closing_sentence,

                'mail_officer' => $request->mail_officer,
                'officer' => $request->officer,
                'notation' => $request->notation,
                'identity_number' => $request->identity_number,

                'date_create' => $request->date_create,
                'file' => 'default.png',
                'user_id' => auth()->user()->id,
                'group_id' => $identity->group_id,
                'date_create' => date('Y-m-d'),
                'autograph_status' => 0,
                'class_id' => $class->classroom_id,

                'mail_concept_id' => $request->id_konsep
            ];
            $insert = OutboxMail::insert($data);
            $id = DB::getPdo()->lastInsertId();

            $mail_concept = MailConcept::find($request->id_konsep);
            $mail_concept->status = 1;
            $mail_concept->save();


            return redirect(route('viewMail', $id));
        } else {

            if ($request->file()) {
                $extension =  $request->file('logo')->extension();
                $fileName = 'logo' . '_' . time() . '.' . $extension;
                $filePath = $request->file('logo')->storeAs('logo_outbox', $fileName, 'public');

                $data = [
                    'main_institution' => $request->main_institution,
                    'name_institution' => $request->name_institution,
                    'phone_institution' => $request->phone_institution,
                    'email_institution' => $request->email_institution,
                    'address_institution' => $request->address_institution,


                    'outboxmail_number' => $request->outboxmail_number,
                    'mail_date' => $request->mail_date,
                    'attachment' => $request->attachment,
                    'mail_about' => $request->mail_about,

                    'mail_recevier' => $request->mail_recevier,
                    'mail_destination' => $request->mail_destination,
                    'city_destination' => $request->city_destination,


                    'preambule' => $request->preambule,
                    'mail_detail' => $request->mail_detail,
                    'closing_sentence' => $request->closing_sentence,
                    'identity_number' => $request->identity_number,

                    'mail_officer' => $request->mail_officer,
                    'officer' => $request->officer,
                    'notation' => $request->notation,

                    'date_create' => $request->date_create,
                    'file' => 'default.png',
                    'user_id' => auth()->user()->id,
                    'group_id' => $identity->group_id,
                    'date_create' => date('Y-m-d'),
                    'autograph_status' => 0,
                    'class_id' => $class->classroom_id,
                    'logo' => $fileName,
                    'mail_concept_id' => $request->id_konsep
                ];

                $insert = OutboxMail::insert($data);
                $id = DB::getPdo()->lastInsertId();

                $mail_concept = MailConcept::find($request->id_konsep);
                $mail_concept->status = 1;
                $mail_concept->save();


                return redirect(route('viewMail', $id));
            }
        }
    }

    public function getstatus_koreksi($id)
    {
        $data = MailCorrection::where('status_koreksi', 1)->where('outbox_mail_id', $id)->exists();
        return $data;
    }

    public function viewMail(Request $request)
    {
        $koreksi_surat = MailCorrection::where('outbox_mail_id', $request->id)->get();

        $cek_status = $this->getstatus_koreksi($request->id);
        $data = OutboxMail::where('outbox_mails.id', $request->id)
            ->leftjoin('classifications', 'classifications.id', '=', 'outbox_mails.classification_id')
            ->select('outbox_mails.*', 'outbox_mails.id as outboxID', 'classifications.*')
            ->first();
        $autograph = Autograph::where('autographs.id', $data->autograph_id)
            ->join('users', 'users.id', '=', 'autographs.user_id')
            ->first();
        return view('siswa.secretary.view_mail')
            ->with('mail', $data)
            ->with('ttd', $autograph)
            ->with('status_koreksi', $cek_status)
            ->with('data_koreksi', $koreksi_surat)
            ->with('nama', auth()->user()->name);
    }

    public function upload_mail(Request $request)
    {
        $request->validate([
            'file.*' => 'required|mimes:csv,txt,xlx,jpg,png|max:2048'
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

        ];

        // return $mail;

        // return view('siswa.secretary.export_outbox', $data);

        $pdf = PDF::loadView('siswa.secretary.export_outbox', ['mail' => $mail]);
        return $pdf->stream($data['mail']['outboxmail_number'] . '.pdf');

        // return $pdf->download($data['mail']['outboxmail_number'] . '.pdf');
    }

    public function editOutbox(Request $request)
    {
        $mail = OutboxMail::find($request->id);
        $data = MailConcept::where('mail_concepts.id', $mail->mail_concept_id)
            ->select('*', 'mail_concepts.id as conceptID')
            ->join('users', 'users.id', '=', 'mail_concepts.user_id')
            ->first();

        return view('siswa.secretary.edit_outbox')
            ->with('concept', $data)
            ->with('mail', $mail)
            ->with('nama', auth()->user()->name);
    }

    public function updateOutbox(Request $request)
    {
        $class = User::select('classroom_id')->where('id', Auth::id())->first();
        $identity = UserGroup::select('group_id')->where('user_id', Auth::id())->first();

        if (empty($request->logo)) {
            $data = [
                'main_institution' => $request->main_institution,
                'name_institution' => $request->name_institution,
                'phone_institution' => $request->phone_institution,
                'email_institution' => $request->email_institution,
                'address_institution' => $request->address_institution,


                'outboxmail_number' => $request->outboxmail_number,
                'mail_date' => $request->mail_date,
                'attachment' => $request->attachment,
                'mail_about' => $request->mail_about,

                'mail_recevier' => $request->mail_recevier,
                'mail_destination' => $request->mail_destination,
                'city_destination' => $request->city_destination,


                'preambule' => $request->preambule,
                'mail_detail' => $request->mail_detail,
                'closing_sentence' => $request->closing_sentence,

                'mail_officer' => $request->mail_officer,
                'officer' => $request->officer,
                'notation' => $request->notation,
                'identity_number' => $request->identity_number,

                'date_create' => $request->date_create,
                'file' => 'default.png',
                'user_id' => auth()->user()->id,
                'group_id' => $identity->group_id,
                'date_create' => date('Y-m-d'),
                'autograph_status' => 0,
                'class_id' => $class->classroom_id,

                'mail_concept_id' => $request->id_konsep
            ];
            $update = OutboxMail::where('id', $request->id)->update($data);


            return redirect(route('viewMail', $request->id));
        } else {

            if ($request->file()) {
                $extension =  $request->file('logo')->extension();
                $fileName = 'logo' . '_' . time() . '.' . $extension;
                $filePath = $request->file('logo')->storeAs('logo_outbox', $fileName, 'public');

                $data = [
                    'main_institution' => $request->main_institution,
                    'name_institution' => $request->name_institution,
                    'phone_institution' => $request->phone_institution,
                    'email_institution' => $request->email_institution,
                    'address_institution' => $request->address_institution,


                    'outboxmail_number' => $request->outboxmail_number,
                    'mail_date' => $request->mail_date,
                    'attachment' => $request->attachment,
                    'mail_about' => $request->mail_about,

                    'mail_recevier' => $request->mail_recevier,
                    'mail_destination' => $request->mail_destination,
                    'city_destination' => $request->city_destination,


                    'preambule' => $request->preambule,
                    'mail_detail' => $request->mail_detail,
                    'closing_sentence' => $request->closing_sentence,
                    'identity_number' => $request->identity_number,

                    'mail_officer' => $request->mail_officer,
                    'officer' => $request->officer,
                    'notation' => $request->notation,

                    'date_create' => $request->date_create,
                    'file' => 'default.png',
                    'user_id' => auth()->user()->id,
                    'group_id' => $identity->group_id,
                    'date_create' => date('Y-m-d'),
                    'autograph_status' => 0,
                    'class_id' => $class->classroom_id,
                    'logo' => $fileName,
                    'mail_concept_id' => $request->id_konsep
                ];

                $update = OutboxMail::where('id', $request->id)->update($data);


                return redirect(route('viewMail', $request->id));
            }
        }
    }

    public function deleteOutbox(Request $request)
    {
        $outbox = OutboxMail::find($request->id);
        $mail_concept =  MailConcept::where('id', $outbox->mail_concept_id)->update(['status' => 0]);


        if (!empty($outbox->logo)) {
            Storage::delete('public/logo_outbox/' . $outbox->logo);
        }
        $delete = OutboxMail::where('id', $request->id)->delete();



        return redirect(route('outbox_data'));
    }
}
