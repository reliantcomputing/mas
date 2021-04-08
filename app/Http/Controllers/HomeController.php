<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instructor;
use App\Role;
use App\User;
use App\Student;
use Illuminate\Support\Facades\Hash;
use App\PasswordReset;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function instructorRegistration()
    {
        return view('home.instructorRegistration');
    }

    public function studentRegistration()
    {
        return view('home.studentRegistration');
    }

    public function home()
    {
        return view('home.home');
    }

    private function getBirthdateFromIdentity($identity) {
        // substring identity to get bday
        $date = substr($identity, 0, 6);
    
        // use built-in DateTime object to work with dates
        $date = \DateTime::createFromFormat('ymd', $date);
        $now  = new \DateTime();
    
        return $date;
    }

    private function getGenderFromIdentity($identity) {
        // substring gender data and convert it to int
        $gender = (int) substr($identity, 6, 1);
        return ($gender >= 0 && $gender <= 4) ? 'Female' : 'Male';
    }

    public function saveInstructor(Request $request)
    {
        $this->validate(
            $request,
            [
                'stuff_number'=>'required|unique:instructor|min:6|max:6',
                'full_name'=>'required|min:3',
                'surname'=>'required|min:3',
                'email' => 'required|email|unique:instructor',
                'password' => 'required|confirmed',
                "id_number" => 'required|unique:instructor|min:13|max:13',
                "security_question" => "required",
                "security_answer" => "required"
            ]
        );

        if ($request->stuff_number <= 0 || $request->id_number <= 0) {
            return redirect()->back()->with("error", "Student number or id number should not be negative.")->withInput();
        }

        $instructor = new Instructor;
        $instructor->stuff_number = $request->stuff_number;
        $instructor->full_name = $request->full_name;
        $instructor->surname = $request->surname;
        $instructor->email = $request->email;
        $instructor->id_number = $request->id_number;
        $instructor->date_of_birth = $this->getBirthdateFromIdentity($request->id_number);
        $instructor->gender = $this->getGenderFromIdentity($request->id_number);


        $roleInstance = new Role;
        $userInstance = new User;
        $passwordInstance = new PasswordReset;

        $passwordInstance->security_question = $request->security_question;
        $passwordInstance->security_answer = $request->security_answer;
        $passwordInstance->email = $request->email;

        $role = null;

        if (!Role::where("name", "ROLE_INSTRUCTOR")->first()) {
            $roleInstance->name = "ROLE_INSTRUCTOR";
            $roleInstance->save();
            $role = $roleInstance;
        }else{
            $role = Role::where("name", "ROLE_INSTRUCTOR")->first();
        }
        $instructor->save();
        $userInstance->email = $request->email;
        $userInstance->password = Hash::make($request->password);
        $userInstance->save();

        $passwordInstance->save();
        $userInstance->attachRole($role);
        Auth::login($userInstance);
        return redirect()->route("dashboard")->with("success", "Registered successfully,Welcome $request->full_name!");
    }

    public function saveStudent(Request $request)
    {
        $this->validate(
            $request,
            [
                'student_number'=>'required|min:9|max:9',
                'password' => 'required|confirmed',
                "id_number" => 'required|min:13|max:13',
                "security_question" => "required",
                "security_answer" => "required"
            ]
        );

        if ($request->student_number <= 0 || $request->id_number <= 0) {
            return redirect()->back()->with("error", "Student number or id number should not be negative.")->withInput();
        }

        if (!Student::where("student_number", $request->student_number)->first()) {
            return redirect()->back()->with("error", "Student with student number $request->student_number not fount, try again or contact your instructor");
        }

        if (Student::where("student_number", $request->student_number)->first() != Student::where("id_number", $request->id_number)->first() ) {
            return redirect()->back()->with("error", "Student with id number and student number entered below does not exist.");
        }

        $student = Student::where("student_number", $request->student_number)->first();

        $roleInstance = new Role;
        $userInstance = new User;

        $passwordInstance = new PasswordReset;

        $passwordInstance->security_question = $request->security_question;
        $passwordInstance->security_answer = $request->security_answer;
        $passwordInstance->email = $student->email;

        $role = null;

        if (!Role::where("name", "ROLE_STUDENT")->first()) {
            $roleInstance->name = "ROLE_STUDENT";
            $roleInstance->save();
            $role = $roleInstance;
        }else{
            $role = Role::where("name", "ROLE_STUDENT")->first();
        }

        $userInstance->email = $student->email;
        $userInstance->password = Hash::make($request->password);
        $userInstance->save();

        $passwordInstance->save();

        $userInstance->attachRole($role);

        Auth::login($userInstance);
        return redirect()->route("dashboard")->with("success", "Registered successfully,Welcome $student->full_name!");
    }

    public function enterEmailPage()
    {
        return view("home.passwordResetPage");
    }

    public function processEmailCheck(Request $request)
    {
        $this->validate($request, ["email"=>"required|email"]);
        $user = User::where("email", $request->email)->first();
    
        if (!$user) {
            return redirect()->back()->with("error", "User with email $request->email does not exist.");
        }else {
            $passwordQuestion = PasswordReset::where("email", $request->email)->first();
            return view("home.passwordResetQuestionPage", ["success"=>"Please answer the security question to reset your password","email"=>$user->email, "passwordQuestion"=>$passwordQuestion]);
        }
        
    }

    public function processSecurityQuestion(Request $request)
    {
        $this->validate($request, ["email"=>"required|email", "security_answer"=>"required"]);
        $user = User::where("email", $request->email)->first();
        if (!$user) {
            return redirect()->back()->with("error", "User with email $request->email does not exist.");
        }else {
            $passwordQuestion = PasswordReset::where("email", $request->email)->first();
            if ($passwordQuestion->security_answer == $request->security_answer) {
                return view("home.passwordResetPage", ["success"=>"You can now enter your new password","email"=>$user->email, "passwordQuestion"=>$passwordQuestion]);
            }else{
                return redirect()->back()->with("error", "Wrong answer is supplied please try again.");
            }
        }

    }

    public function processPasswordReset(Request $request)
    {
        $this->validate($request, ["new_password"=>"required|min:6|max:20", "confirm_password"=>"required|min:6|max:20"]);

        if ($request->new_password != $request->confirm_password) {
            return redirect()->back()->with("error", "New password and confirm password don't match.");
        }

        $user = User::where("email", $request->email)->first();

        if (!$user) {
            return redirect()->back()->with("error", "User with email $request->email does not exist.");
        }

        $user->password = Hash::make($request->new_password);
        $user->update();
        return redirect()->route("dashboard")->with("success", "Password changed successfully, you can now login.");
    }

}
