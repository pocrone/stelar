<?php

namespace App\Models;

use App\Models\Classroom;
use App\Models\Classification;
use App\Models\MailCorrection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InboxMail extends Model
{
    public $timestamps = false;
    public $dateFormat = 'd-m-Y';

    protected $guarded = [
        'id',
        'classification_id',
        'classroom',
    ];

    protected $fillable = [
        'mail_id',
        'date',
        'time',
        'mail_attribute',
        'mail_about',
        'mail_summary',
        'status',
        'mail_location',
        'classification_id',
        'file',
    ];


    public function mailCorrection()
    {
        $this->belongsTo(MailCorrection::class);
    }

    public function classification()
    {
        $this->hasMany(Classification::class);
    }

    public function classroom()
    {
        $this->hasMany(Classroom::class);
    }

    public function disposition()
    {
        $this->hasMany(Dispostition::class);
    }

    public function group()
    {
        $this->belongsTo(Group::class);
    }
}
