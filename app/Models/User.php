<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $fillable = ['email','password'];


    public function userDetail()
    {
        return $this->hasOne(UserDetail::class, 'user_id');
    }

}
