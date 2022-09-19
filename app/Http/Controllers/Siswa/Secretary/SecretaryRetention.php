<?php

namespace App\Http\Controllers\Siswa\Secretary;

use App\Models\InboxMail;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Models\OutboxMail;


class SecretaryRetention extends Controller
{
    public function inbox_retention(Request $request)
    {
        if ($request->ajax()) {

            $group_id = UserGroup::select('group_id')->where('user_id', Auth::id())->first();

            $data = InboxMail::select('inbox_mails.id', 'mail_number', 'date', 'mail_about', 'retention_status', 'sender',  'active_year', 'inactive_year', 'mail_location', 'class', 'sub_class')
                ->leftjoin('classifications', 'classifications.id', '=', 'classification_id')
                ->join('groups', 'groups.id', '=', 'inbox_mails.group_id')
                ->join('users', 'users.id', '=', 'inbox_mails.user_id')
                ->where('inbox_mails.group_id', $group_id->group_id)->get();

            return Datatables::of($data)->make(true);
        }


        return view('siswa.secretary.inbox_retention')->with('nama', auth()->user()->name);
    }
    public function outbox_retention(Request $request)
    {
        if ($request->ajax()) {
            $group_id = UserGroup::select('group_id')->where('user_id', Auth::id())->first();
            $data = OutboxMail::select('outbox_mails.id', 'outboxmail_number', 'mail_date', 'mail_about', 'retention_status',  'active_year', 'inactive_year', 'save_location', 'class', 'sub_class')
                ->leftjoin('classifications', 'classifications.id', '=', 'classification_id')
                ->join('groups', 'groups.id', '=', 'outbox_mails.group_id')
                ->join('users', 'users.id', '=', 'outbox_mails.user_id')
                ->where('outbox_mails.group_id', $group_id->group_id)->get();


            return Datatables::of($data)->make(true);
        }
        return view('siswa.secretary.outbox_retention')->with('nama', auth()->user()->name);;
    }
}
