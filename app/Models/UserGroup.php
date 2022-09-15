<?php

namespace App\Models;

use App\Models\User;
use App\Models\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserGroup extends Model
{

    public $timestamps = false;
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'user_id',
        'group_id'
    ];

    public function User()
    {
        $this->belongsTo(User::class);
    }
    public function Group()
    {
        $this->hasMany(Group::class);
    }
}
