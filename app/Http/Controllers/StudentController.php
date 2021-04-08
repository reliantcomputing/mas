<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Auth;
use App\Instructor;
use App\Student;
use App\StudentMark;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use App\Role;
use App\Imports\StudentsImport;
use App\Exports\StudentExport;
use PDF;
use App\Evaluation;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index()
    {
        $email = Auth::user()->email;

        $instructor = Instructor::where("email", $email)->first();

        $students = Student::all();

        return view("students.index", ["students"=>$students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("students.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $email = Auth::user()->email;

        $instructor = Instructor::where("email", $email)->first();

        $this->validate($request, [
            "full_name" => "required",
            "id_number" => "required|min:13|max:13",
            "surname" => "required",
            "email" => "required|email",
            "student_number" => "required|min:9|max:9"
        ]);

        if (Student::where("email", $request->email)->first()) {
            return redirect()->back()->with('error', "$request->email already exist.");
        }

        if (Student::where("student_number", $request->student_number)->first()) {
            return redirect()->back()->with('error', "$request->student_number already exist.");
        }

        $student = new Student;

        $student->full_name = $request->full_name;
        $student->surname = $request->surname;
        $student->id_number = $request->id_number;
        $student->email = $request->email;
        $student->student_number = $request->student_number;
        $student->stuff_number = $instructor->stuff_number;

        $student->save();
        return redirect()->route('students')->with("success", "Student created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Student::where("student_number", $id)->first()) {
            return redirect()->back()->with("success", "Student not found.");
        }

        $student = Student::where("student_number", $id)->first();

        return view("students.show", ["student" => $student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Student::where("student_number", $id)->first()) {
            return redirect()->back()->with("success", "Student not found.");
        }

        $student = Student::where("student_number", $id)->first();

        return view("students.edit", ["student" => $student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Student::where("student_number", $id)->first()) {
            return redirect()->back()->with("success", "Student not found.");
        }

        $email = Auth::user()->email;

        $instructor = Instructor::where("email", $email)->first();

        $this->validate($request, [
            "full_name" => "required",
            "id_number" => "required|min:13|max:13",
            "surname" => "required",
        ]);


        $student = Student::where("student_number", $id)->first();

        $student->full_name = $request->full_name;
        $student->surname = $request->surname;
        $student->id_number = $request->id_number;

        $student->update();
        return redirect()->route('students')->with("success", "Student updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Student::where("student_number", $id)->first()) {
            return redirect()->back()->with("success", "Student not found.");
        }

        $student = Student::where("student_number", $id)->first();

        $student->delete();  
        return redirect()->route('students')->with("success", "Student deleted successfully.");
    }

    public function marks($id)
    {
        if (!Student::where("student_number", $id)->first()) {
            return redirect()->back()->with("success", "Student not found.");
        }
        $student_marks = StudentMark::where("student_number", $id)->get();
        $student = Student::where("student_number", $id)->first();

        $mark = 0.0;
        foreach ($student_marks as $student_mark){
            $mark = $mark+$student_mark->evaluation->total_percentage*($student_mark->mark/$student_mark->evaluation->total_mark);
        }   

        return view("students.mark", ["mark"=>$mark, "student_marks" => $student_marks, "student" => $student]);
    }


    public function printMark($id)
    {
        if (!Student::where("student_number", $id)->first()) {
            return redirect()->back()->with("success", "Student not found.");
        }
        $student_marks = StudentMark::where("student_number", $id)->get();
        $student = Student::where("student_number", $id)->first();

        $data = ['student_marks' =>$student_marks, "student" => $student];
        $pdf = PDF::loadView('students.print_mark', $data);
  
        return $pdf->download('results.pdf');
    }



    public function import() 
    {
        $this->validate($request, [
            "file" => "required"
        ]);

        Excel::import(new User, $request->file("file"));
        
        return redirect('/')->with('success', 'All good!');
    }

    public function callUploadView()
    {
        return view("students.upload");
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            "file" => "file"
        ]);
        $file = $request->file;
        $extention = File::extension($file->getClientOriginalName());
        if($extention != "xlsx"){
            return redirect()->back()->with("error", "Only excel files are allowed.");
        }
        Excel::import(new StudentsImport, $file);
        
        return redirect()->route('students')->with("success", "Students uploaded successfully.");
    }

    public function printStudents(Request $request)
    {
        $email = Auth::user()->email;

        $instructor = Instructor::where("email", $email)->first();

        $students = Student::where("stuff_number", $instructor->stuff_number)->get();

        $data = ["students" => $students];
        $pdf = PDF::loadView('students.print_students', $data);
  
        return $pdf->download('students.pdf');
    }

    public function exportStudents() 
    {
        return Excel::download(new StudentExport, 'students.xlsx');
    }

    public function exportCSV()
    {
        return Excel::download(new StudentExport, 'students.csv', \Maatwebsite\Excel\Excel::CSV);
    }


    public function editStudentMark($id)
    {
        if (!StudentMark::where("id", $id)->first()) {
            return redirect()->back()->with('error', "Student mark not found.");
        }
        $studentMark = StudentMark::where("id", $id)->first();
        return view("students.edit_student_mark", ["studentMark"=>$studentMark]);
    }

    public function updateStudentMark(Request $request, $id)
    {

        if (!StudentMark::where("id", $id)->first()) {
            return redirect()->back()->with('error', "Student mark not found.");
        }
        $studentMark = StudentMark::where("id", $id)->first();
        $evaluation = Evaluation::where("id", $studentMark->evaluation_id)->first();
        if($request->achieved_mark < 0 ){
            return redirect()->back()->with("error", "Achieved mark cannot be less than 0");
        }
        if ($request->aachieved_mark > $evaluation->total_mark) {
            return redirect()->back()->with('error', "Achieved mark cannot be greater than evaluation mark.");
        }
        $studentMark->mark = $request->achieved_mark;
        $studentMark->update();

        return redirect()->route("markStudent", $studentMark->student_number)->with("success", "Mark updated successfully.");
    }

    public function deleteAllStudents()
    {
        $students = Student::all();
        
        foreach ($students as $student) {
         $student->delete();
        }
        return redirect()->back()->with("success", "All students deleted successfully.");
    }

    public function giveInstructorRole($id)
    {
        if (!Student::where("student_number", $id)->first()) {
            return redirect()->back()->with('error', "Student you're trying to assign role don't exist.");
        }
        $student = Student::where("student_number", $id)->first();

        $user = User::where("email", $student->email)->first();
        if (!$user) {
            return redirect()->back()->with('error', "The student you're trying to assign role is not a user yet. He or she should register first.");
        }

        $role = Role::where("name", "ROLE_INSTRUCTOR")->first();
        if (!$role) {
            return redirect()->back()->with('error', "Instructor role does not exist.");
        }
        $user->attachRole($role);
        $user->update();
        return redirect()->back()->with('success', "Instructor role added to student $student->full_name $student->surname.");
    }

    public function removeInstructorRole($id)
    {
        if (!Student::where("student_number", $id)->first()) {
            return redirect()->back()->with('error', "Student you're trying to assign role don't exist.");
        }
        $student = Student::where("student_number", $id)->first();

        $user = User::where("email", $student->email)->first();
        if (!$user) {
            return redirect()->back()->with('error', "The student you're trying to assign role is not a user yet. He or she should register first.");
        }

        $role = Role::where("name", "ROLE_INSTRUCTOR")->first();
        if (!$role) {
            return redirect()->back()->with('error', "Instructor role does not exist.");
        }
        $user->roles()->detach($role);
        $user->update();
        return redirect()->back()->with('success', "Instructor role removed student $student->full_name $student->surname.");
    }
}
