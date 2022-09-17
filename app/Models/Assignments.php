<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Assignments extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'title',
        'content',
        'attachment',
        'created_at',
        'updated_at'
    ];
    public function Assignment_groups()
    {
        $this->hasOne(Assignment_groups::class);
    }
}
