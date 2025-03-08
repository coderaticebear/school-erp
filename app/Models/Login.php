<?php

namespace App\Models;

use App\Http\Controllers\LoginController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Login extends Model
{
    public function getUserData($email, $password){
        $user = DB::table('user')->select('id', 'email')->where('email', $email)->where('password', $password)->first();
        return $user;
    }
}
