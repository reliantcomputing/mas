<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Role;
use App\Instructor;
use App\Group;
use App\Student;
use App\Evaluation;
use App\StudentMark;
use App\GroupMark;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(["auth"]);
    }
    public function index()
    {
        if (Auth::user()->hasRole("ROLE_INSTRUCTOR")) {
            $user = Auth::user();
            $instructor = Instructor::all();
            $students = Student::all();
            $groups = Group::all();
            $evaluations = Evaluation::all();
            if (Auth::user()->hasRole("ROLE_STUDENT")) {
                $student = Student::where("email", $user->email)->first();
                return view("dashboard.instructor", ["student"=>$student,"groups"=>$groups,"students" => $students  , "instructor" => $instructor , "evaluations"=>$evaluations]);
            }else{
                return view("dashboard.instructor", ["groups"=>$groups,"students" => $students  , "instructor" => $instructor , "evaluations"=>$evaluations]);
            }
        }

        
        $email = Auth::user()->email;
        $student = Student::where("email", $email)->first();


        return view("dashboard.instructor", ["student"=>$student]);
    }
}
