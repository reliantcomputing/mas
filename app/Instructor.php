<?php

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $table = "instructor";
    protected $primaryKey = "stuff_number";
    public $incrementing = false;

    public function students()
    {
        return $this->belongsToMany(Student::class, 'instructor_student');
    }

    public function groups()
    {
        return $this->hasMany('App\Group');
    }

    public function evaluations()
    {
        return $this->hasMany('App\Evaluation');
    }

    public function getStuffNumber()
    {
        $email = Auth::user()->email;
        $instructor = Instructor::where("email", $email)->first();
        return $instructor->stuff_number;
    }
}
