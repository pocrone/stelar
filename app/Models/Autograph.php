<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autograph extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $guarded = [
        'id'
    ];
    protected $fillable = [
        'user_id',
        'autograph'
    ];

    public function user()
    {
        $this->hasOne(User::class);
    }
}
