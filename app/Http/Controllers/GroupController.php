<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instructor;
use App\Group;
use Auth;
use App\Student;
use App\GroupMark;
use App\StudentMark;
use App\Evaluation;
use App\Rubric;

use Illuminate\Support\Collection;

class GroupController extends Controller
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

        $groups = Group::all();

        return view("groups.index", ["groups"=>$groups]);
    }


    public function deleteAllGroups()
    {
        $groups = Group::all();

        foreach ($groups as $group) {
            $group->delete();
        }

        return redirect()->back()->with("success", "Groups deleted successfully");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("groups.create");
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
            "name" => "required",
        ]);

        if (Group::where("name", $request->name)->first()) {
            return redirect()->back()->with('error', "$request->name already exist.");
        }

        $group = new Group;

        $group->name = $request->name;
        $group->stuff_number = $instructor->stuff_number;

        $group->save();
        return redirect()->route('groups')->with("success", "Group created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Group::where("id", $id)->first()){
            return redirect()->back()->with("error", "Group not found");
        }

        $group = Group::where("id", $id)->first();
        $students = Student::where("group_id", $group->id)->get();
        $group_marks = GroupMark::where("group_id", $group->id)->get();
        $evaluations = Evaluation::orderBy("id", "ASC")->get();

        $collection = collect();

        foreach($evaluations as $evaluation){
            $rubrics = Rubric::where("evaluation_id", $evaluation->id)->where("group_id", $group->id)->get();
            if ($rubrics->count() == 0) {
                $collection->push($evaluation);
            }
        }

        $mark = 0.0;
        foreach ($group_marks as $group_mark){
            $mark = $mark+$group_mark->evaluation->total_percentage*($group_mark->mark/$group_mark->evaluation->total_mark);
        }  

        return view("groups.show", ["mark"=>$mark, "collection"=>$collection,"group"=>$group, "students" => $students, "group_marks"=>$group_marks, "evaluations" => $evaluations]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Group::where("id", $id)->first()){
            return redirect()->back()->with("error", "Group not found");
        }

        $group = Group::where("id", $id)->first();

        return view("groups.edit", ["group"=>$group]);
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
        $this->validate($request, [
            "name" => "required",
        ]);

        if(!Group::where("id", $id)->first()){
            return redirect()->back()->with("error", "Group not found");
        }

        $group = Group::where("id", $id)->first();

        $group->name = $request->name;

        if (Group::where("name", $request->name)->get()->count() > 1) {
            return redirect()->back()->with('error', "$request->name already exist.");
        }

        $group->update();
        return redirect()->route('groups')->with("success", "Group updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         

        $group = Group::where("id", $id)->first();
        $group->delete();

        return redirect()->route('groups')->with("success", "Group deleted successfully.");
    }

    //add student
    public function addStudent($id){
        if(!Group::where("id", $id)->first()){
            return redirect()->back()->with("error", "Group not found");
        }
        $group = Group::where("id", $id)->first();

        return view("groups.addStudent", ["group" => $group]);
    }

    //save student
    public function saveStudent(Request $request, $id){
        $this->validate($request, [
            "student_number" => "required|min:9|max:9"
        ]);

        if ($request->student_number < 0) {
            return redirect()->back()->with("error", "Student number should not be negative.");
        }

        if(!Group::where("id", $id)->first()){
            return redirect()->back()->with("error", "Group not found");
        }

        if(!Student::where("student_number", $request->student_number)->first()){
            return redirect()->back()->with('error', "Student with student number $request->student_number doesn't exist.")->withInput();
        }
        $group = Group::where("id", $id)->first();

        $student = Student::where("student_number", $request->student_number)->first();

        if ($student->student_id != null) {
            return redirect()->back()->with("error", "Student already belongs to a group.")->withInput();
        }
        $student->group_id = $group->id;
        $student->update();

        return redirect()->route('showGroup', $id)->with("success", "Student added successfully.");
    }

    //remove student
    public function removeStudent($id){
        if(!Student::where("student_number", $id)->first()){
            return redirect()->back()->with('error', "Student with student number $request->student_number doesn't exist.")->withInput();
        }

        $student = Student::where("student_number", $id)->first();
        $student->group_id = null;
        $student->update();

        return redirect()->back()->with("success", "Student $student->full_name removed successfully.");
    }


    //add group marks
    public function addMark($id)
    {
        if(!Group::where("id", $id)->first()){
            return redirect()->back()->with("error", "Group not found");
        }
        $group = Group::where("id", $id)->first();
        $evaluations = Evaluation::where("stuff_number", $group->stuff_number)->get();
        return view("groups.addMark", ["group" => $group, "evaluations" => $evaluations]);
    }


    //save group marks
    public function saveMark(Request $request, $id){
        $this->validate($request, [
            "evaluation" => "required",
            "achieved_mark" => "required"
        ]);

        if(!Group::where("id", $id)->first()){
            return redirect()->back()->with("error", "Group not found");
        }

        if($request->achieved_mark < 0 ){
            return redirect()->back()->with("error", "Achieved mark cannot be less than 0");
        }


        $group = Group::where("id", $id)->first();

        $students = Student::where("group_id", $group->id)->get();

        $group_mark = new GroupMark;

        $group_mark->evaluation_id = $request->evaluation;
        $group_mark->mark = $request->achieved_mark;
        $group_mark->group_id = $group->id;

        $evaluation = Evaluation::where("id", $request->evaluation)->first();

        if ($evaluation->total_mark < $request->achieved_mark) {
            return redirect()->back()->with("error", "Achieved mark cannot be greater than evaluation mark.");
        }

        
        foreach ($students as $student) {
            $student_mark = new StudentMark;
            $student_mark->mark = $request->achieved_mark;
            $student_mark->evaluation_id = $request->evaluation;
            $student_mark->student_number = $student->student_number;
            $student_mark->save();
        }
        $group_mark->save();

        return redirect()->route('showGroup', $id)->with("success", "Mark added successfully.");
    }


    public function callGroupView()
    {
        return view("groups.grouping");
    }



    //work with excell

    public function generateGroups(Request $request)
    {
        $this->validate($request, ["numberOfStudentsInAGroup"=>"required"]);
        $alphabets = array(
            "A","B","C","D","E",
            "F","G","H","I","J",
            "K","L","M","N","O",
            "P","Q","R","S","T",
            "U","V","W","X","Y",
            "Z","Aa","Ba","Ca","Da","Ea",
            "Fa","Ga","Ha","Ia","Ja",
            "Ka","La","Ma","Na","Oa",
            "Pa","Qa","Ra","Sa","Ta",
            "Ua","Va","Wa","Xa","Ya",
            "Za"
         );

        //get user email
        $email = Auth::user()->email;
        //get instructor
        $instructor = Instructor::where("email", $email)->first();

        $students = Student::where("stuff_number", $instructor->stuff_number)->orderBy("id_number", "DESC")->get();

        if ($students->count() == 0) {
            return redirect()->route('groups')->with("error", "Add students first.");
        }
        $studentsSize = $students->count();
        $remainder = $studentsSize % $request->numberOfStudentsInAGroup;
        $total = $studentsSize - $remainder;

        $totalGroups = $total/$request->numberOfStudentsInAGroup;

        for ($num=0; $num < $totalGroups ; $num++) { 
            $group = new Group;

            $group->name = "Group ". $alphabets[$num];
            $group->stuff_number = $instructor->stuff_number;
            $group->save();
        }

        $groups = Group::where("stuff_number", $instructor->stuff_number)->get();
        foreach ($groups as $group) {
            foreach ($students as $student) {
                if ($student->group_id == null) {
                    if (!Student::where("group_id", $group->id)->get()) {
                        $student->group_id = $group->id;
                        $student->update();
                    }

                    if (Student::where("group_id", $group->id)->get()->count() < $request->numberOfStudentsInAGroup) {
                        $student->group_id = $group->id;
                        $student->update();
                    }
                }
            }
        }
        $studentsNoGroup = Student::where("group_id", null)->get();
        foreach ($studentsNoGroup as $student) {
            foreach ($groups as $group) {
                if($student->group_id == null){
                    if (Student::where("group_id", $group->id)->get()->count() <= $request->numberOfStudentsInAGroup) {
                        $student->group_id = $group->id;
                        $student->update();
                    }
                }
            }
        }

        return redirect()->route('groups')->with("success", "Groups generated successfully.");  
    }

    private function totalGroups($students, $divider){
        $remainder = $students % $divider;

        $total = $students - $remainder;
        return $total / $remainder;
    }

    public function editGroupMark($id)
    {
        $groupMark = GroupMark::where("id", $id)->first();
        if(!$groupMark){
            return redirect()->back()->with("error", "Group mark not found.");
        }

        return view("groups.edit_group_mark", ["groupMark" => $groupMark]);
    }

    public function updateGroupMark(Request $request, $id)
    {
        $this->validate($request, [
            "achieved_mark" => "required"
        ]);

        if ($request->achieved_mark < 0) {
            return redirect()->back()->with("error", "Achieved mark cannot be less than zero.");
        }

        $groupMark = GroupMark::where("id", $id)->first();
        if(!$groupMark){
            return redirect()->back()->with("error", "Group mark not found.");
        }

        $evaluation = Evaluation::where("id", $groupMark->evaluation_id)->first();

        $groupMark->mark = $request->achieved_mark;

        $groupMark->update();

        return redirect()->route('showGroup', $groupMark->group_id)->with("success", "Group mark updated successfully.");
    }
}
