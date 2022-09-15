<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'groupname',
        'LeaderGroupID'
    ];

    public function User()
    {
        $this->hasOne(User::class);
    }

    public function UserGroup()
    {
        $this->hasOne(UserGroup::class);
    }
}
