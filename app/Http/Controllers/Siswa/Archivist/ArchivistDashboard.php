<?php

namespace App\Http\Controllers\Siswa\Archivist;

use App\Models\Autograph;
use App\Models\UserGroup;
use App\Models\OutboxMail;
use App\Models\MailConcept;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ArchivistDashboard extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $group_id = UserGroup::select('group_id')->where('user_id', Auth::id())

            ->first();
        $data = [
            'concept_total' => MailConcept::where('group_id', $group_id->group_id)
                ->select(DB::raw('count(*) as total '))
                ->join('users', 'users.id', '=', 'mail_concepts.user_id')
                ->join('groups', 'groups.id', '=', 'mail_concepts.group_id')
                ->first(),
            'mail_correct' => OutboxMail::select('mail_corrections.status_koreksi', DB::raw('count(DISTINCT(mail_corrections.outbox_mail_id)) as total'))
                ->join('groups', 'groups.id', '=', 'outbox_mails.group_id')
                ->join('users', 'users.id', '=', 'outbox_mails.user_id')
                ->join('mail_corrections', 'mail_corrections.outbox_mail_id', '=', 'outbox_mails.id')
                ->where('group_id', $group_id->group_id)
                ->having('status_koreksi', 0)
                ->groupBy('status_koreksi')
                ->first(),
            'autograph' => OutboxMail::select(DB::raw('count(*) as total '))
                ->leftjoin('classifications', 'classifications.id', '=', 'classification_id')
                ->join('groups', 'groups.id', '=', 'outbox_mails.group_id')
                ->join('users', 'users.id', '=', 'outbox_mails.user_id')
                ->where('autograph_status', '0')
                ->where('outbox_mails.group_id', $group_id->group_id)->first()

        ];

        return view('siswa.archivist.dashboard')->with('data', $data)
            ->with('nama', auth()->user()->name);;
    }
}
