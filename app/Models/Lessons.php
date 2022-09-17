<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lessons extends Model
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
    public function Classroom()
    {
        $this->hasOne(User::class);
    }
}
