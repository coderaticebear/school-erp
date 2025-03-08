<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    //
    protected $table = 'userdetails';
    protected $fillable = ['user_id', 'role_id', 'first_name', 'middle_name', 'last_name'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

}
