<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    //
    protected $table = 'divisions';
    protected $fillable = ['class_id', 'division_name'];

    public function classrooms()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }
}
