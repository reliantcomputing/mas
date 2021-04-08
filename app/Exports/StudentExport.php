<?php

namespace App\Exports;

use App\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Instructor;
use Auth;

class StudentExport implements FromView
{
    public function view(): View
    {
        $email = Auth::user()->email;

        $instructor = Instructor::where("email", $email)->first();

        $students = Student::where("stuff_number", $instructor->stuff_number)->get();
        $data = ["students" => $students];
        return view('students.print_students', [
            "students" => $students
        ]);
    }
}
