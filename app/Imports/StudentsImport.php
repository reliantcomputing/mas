<?php

namespace App\Imports;

use App\Student;
use App\Instructor;
use Maatwebsite\Excel\Concerns\ToModel;
use Auth;

class StudentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        $instructor = new Instructor;
       return new Student([
           "full_name" => $row[0],
           "surname" => $row[1],
           "student_number" => $row[2],
           "email" => $row[3],
           "id_number" => $row[4],
           "stuff_number" => $instructor->getStuffNumber()
       ]);
    }
}
