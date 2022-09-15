<?php

namespace App\Models;

use App\Models\InboxMail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classification extends Model
{
    public $timestamps = false;

    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'class',
        'sub_class',
    ];

    public function inboxMail()
    {
        $this->belongsTo(InboxMail::class);
    }
}
