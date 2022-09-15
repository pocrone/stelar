<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposition extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $guarded = [
        'id',
        'inboxmail_id',
    ];
}
