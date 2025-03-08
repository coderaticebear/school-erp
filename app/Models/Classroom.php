<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    //    use HasFactory;

        protected $table = 'classroom';
        protected $fillable = ['school_id', 'class_name'];

        public function school()
        {
            return $this->belongsTo(SchoolDetail::class, 'school_id');
        }

        public function divisions()
        {
            return $this->hasMany(Division::class, 'class_id');
        }

}
