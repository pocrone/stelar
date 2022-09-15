<?php

namespace App\Models;

use App\Models\User;
use App\Models\Group;
use App\Models\Classroom;
use App\Models\Outboxmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MailConcept extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'user_id',
        'mail_concept',
        'date',
        'status'
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function classroom()
    {
        $this->hasMany(Classroom::class);
    }

    public function group()
    {
        $this->belongsTo(Group::class);
    }
}
