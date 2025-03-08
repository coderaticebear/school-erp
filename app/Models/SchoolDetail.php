<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolDetail extends Model
{
    //

    protected $table = 'school_details';
    protected $fillable = ['name'];

    public function classrooms()
    {
        return $this->hasMany(Classroom::class, 'school_id');
    }
}
