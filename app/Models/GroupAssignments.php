<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupAssignments extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'group_id',
        'assignment_id',
        'value',
        'comment',
    ];
}
