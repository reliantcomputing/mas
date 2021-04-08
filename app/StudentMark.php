<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentMark extends Model
{
    protected $table = "student_mark";

    public function evaluation()
    {
        return $this->belongsTo('App\Evaluation');
    }

    public function student()
    {
        return $this->belongsTo('App\Student', 'student_number');
    }

}
