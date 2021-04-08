<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Student;
use App\Rubric;

class Group extends Model
{
    protected $table = "group";

    public function instructor()
    {
        return $this->belongsTo('App\Instructor', 'stuff_number');
    }

    public function groupMark()
    {
        return $this->hasOne('App\GroupMark');
    }

    public function groupStudents($id){
        $students = Student::where("group_id", $id)->get();
        return $students;
    }

    public function rubrics()
    {
        return Rubric::where("group_id", $this->id)->order("created_at", "ASC")->get();
    }
}
