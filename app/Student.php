<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use App\User;
use Auth;

class Student extends Model
{
    protected $table = "student";
    protected $primaryKey = "student_number";
    public $incrementing = false;

    protected $fillable = [
        "full_name", "surname", "student_number", "email", "id_number" , "stuff_number"
    ];

    public function instructors()
    {
        return $this->belongsToMany(Instructor::class, 'instructor_student');
    }


    public function getGroup()
    {
        return Group::where("id", $this->group_id)->first();
    }

    public function user()
    {
        return User::where("email", $this->email)->first();
    }

    public function studentMark()
    {
        $student_marks = StudentMark::where("student_number", $this->student_number)->get();

        $mark = 0.0;
        foreach ($student_marks as $student_mark){
            $mark = $mark+$student_mark->evaluation->total_percentage*($student_mark->mark/$student_mark->evaluation->total_mark);
        }  

        return $mark;
    }

    public function studentMarks()
    {
        $student_marks = StudentMark::where("student_number", $this->student_number)->get();

        return $student_marks;
    }



    public function groupMark()
    {       
            $group_marks = GroupMark::where("group_id", $this->group_id)->get();

            $mark = 0.0;
            foreach ($group_marks as $group_mark){
                $mark = $mark+$group_mark->evaluation->total_percentage*($group_mark->mark/$group_mark->evaluation->total_mark);
            } 

            return $mark;
    }

    public function groupMarks()
    {       
            $group_marks = GroupMark::where("group_id", $this->group_id)->get();

            return $group_marks;
    }
}
