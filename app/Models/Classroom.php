<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'class_name',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function mailConcept()
    {
        $this->belongsTo(MailConcept::class);
    }
    public function inboxMail()
    {
        $this->belongsTo(Inboxmail::class);
    }
}
