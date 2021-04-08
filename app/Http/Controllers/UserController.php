<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Instructor;
use App\User;
use App\Student;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function profile()
    {
        $user = Auth::user();

        $instructor = Instructor::where("email", $user->email)->first();

        return view("profile.profile", ["instructor"=>$instructor]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            "full_name" => "required|regex:/^[a-zA-Z\s]*$/|min:3",
            "surname" => "required|regex:/^[a-zA-Z\s]*$/|min:3",
        ]);

        if ($request->password != "" || $request->password != null) {
            $this->validate($request, [
                "password" => "confirmed|min:6"
            ]);
    
        }

        $user = Auth::user();
        $instructor = Instructor::where("email", $user->email)->first();

        if ($request->password != "" || $request->password != null) {
            $user->password = Hash::make($request->password);
            $user->update();
        }

        $instructor->full_name     = $request->full_name;
        $instructor->surname      = $request->surname;
        //save student
        $instructor->update();

        return redirect()->back()->with("success", "Profile or(and) password updated successfully!");
    }

    public function updateStudentPassword(Request $request)
    {
        $this->validate($request, [
            "password" => "required|confirmed|min:6"
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->update();
        return redirect()->back()->with("success", "Password updated successfully!");
    }

    public function studentInstructor()
    {
        $users = collect();
        $allUser = User::all();
        foreach ($allUser as $user) {
            if ($user->hasRole("ROLE_STUDENT") && $user->hasRole("ROLE_INSTRUCTOR")) {
                $users->push($user);
            }           
        }

        $students = collect();
        $allStudent = Student::all();

        foreach ($allStudent as $student) {
            if($student->email == $user->email){
                $students->push($student);
            }
        }
        return view("profile.instructor", ["students"=>$students]);
    }
}
