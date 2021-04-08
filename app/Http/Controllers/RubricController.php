<?php

namespace App\Http\Controllers;

use App\Evaluation;
use App\Rubric;
use App\SubRubric;
use App\SubSubRubric;
use App\Group;
use App\GroupMark;
use App\StudentMark;
use App\Student;
use Illuminate\Http\Request;

class RubricController extends Controller
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
        $evaluations = Evaluation::all();

        return view("rubrics.index", ["evaluations" => $evaluations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function createRubric($id){
        $evaluation = Evaluation::where("id", $id)->first();
        if (!$evaluation) {
            return redirect()->back()->with('error', "Evaluation not found");
        }
        return view("rubrics.createRubric", ["evaluation" => $evaluation]);
    }

    public function createSubRubric($id){
        $rubric = Rubric::where("id", $id)->first();
        if (!$rubric) {
            return redirect()->back()->with('error', "Rubric not found");
        }
        return view("rubrics.createSubRubric", ["rubric" => $rubric]);
    }

    public function createSubSubRubric($id){
        $subRubric = SubRubric::where("id", $id)->first();
        if (!$subRubric) {
            return redirect()->back()->with('error', "Sub rubric not found");
        }
        return view("rubrics.createSubSubRubric", ["subRubric" => $subRubric]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function storeRubric(Request $request, $id)
    {
        $this->validate($request, ["total_mark"=>"required|numeric"]);

        $rubric = new Rubric;
        $rubric->aspect_to_be_evaluated = $request->aspect_to_be_evaluated;
        $rubric->details = $request->details;
        $rubric->total_mark = $request->total_mark;
        $rubric->evaluation_id = $id;

        $rubric->save();

        return redirect()->route("viewRubric", $id)->with("success", "Rubric created successfully.");
        
    }

    //Sub Rubric
    public function storeSubRubric(Request $request, $id)
    {
        $this->validate($request, ["total_mark"=>"required|numeric"]);

        $rubric = new SubRubric;
        $rubric->aspect_to_be_evaluated = $request->aspect_to_be_evaluated;
        $rubric->details = $request->details;
        $rubric->total_mark = $request->total_mark;
        $rubric->rubric_id = $id;

        $rubric->save();

        return redirect()->route("viewSubRubric", $id)->with("success", "Sub rubric created successfully.");
        
    }

    public function storeSubSubRubric(Request $request, $id)
    {
        $this->validate($request, ["total_mark"=>"required|numeric"]);

        $rubric = new SubSubRubric;
        $rubric->aspect_to_be_evaluated = $request->aspect_to_be_evaluated;
        $rubric->details = $request->details;
        $rubric->total_mark = $request->total_mark;
        $rubric->sub_rubric_id = $id;

        $rubric->save();

        return redirect()->route("viewSubSubRubric", $id)->with("success", "Sub sub rubric created successfully.");
        
    }


    //view rubrics
    public function viewRubric($id)
    {
        $rubrics = Rubric::where("evaluation_id", $id)->where("group_id", null)->get();
        $evaluation = Evaluation::where("id", $id)->first();
        if (!$evaluation) {
            return redirect()->back()->with('error', "Evaluation not found");
        }
        return view("rubrics.viewRubric", ["rubrics" => $rubrics, "evaluation" => $evaluation]);
    }

    public function viewSubRubric($id)
    {
        $subRubrics = SubRubric::where("rubric_id", $id)->get();
        $rubric = Rubric::where("id", $id)->first();
        if (!$rubric) {
            return redirect()->back()->with('error', "Rubric not found");
        }
        return view("rubrics.viewSubRubric", ["rubric" => $rubric, "subRubrics" => $subRubrics]);
    }

    public function viewSubSubRubric($id)
    {
        $subSubRubrics = SubSubRubric::where("sub_rubric_id", $id)->get();
        $subRubric = SubRubric::where("id", $id)->first();
        if (!$subRubric) {
            return redirect()->back()->with('error', "Sub rubric not found");
        }
        return view("rubrics.viewSubSubRubric", ["subRubric" => $subRubric, "subSubRubrics" => $subSubRubrics]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rubric  $rubric
     * @return \Illuminate\Http\Response
     */
    public function show(Rubric $rubric)
    {
        //
    }

    public function generateRubric(Request $request, $id)
    {
        $group = Group::where("id", $id)->first();
        if(!$group){
            return redirect()->back()->with('error', "Group not found");
        }
        $evaluation = Evaluation::where("id", $request->evaluation)->first();

        if ($evaluation->rubrics()->count() == 0) {
            return redirect()->back()->with("error", "Evaluation doesn't contain rubric");
        }

        foreach ($evaluation->rubrics() as $rubric) {
            
            if (!$rubric->group()) {
                $rubricInstance = new Rubric;
                $rubricInstance->aspect_to_be_evaluated = $rubric->aspect_to_be_evaluated;
                $rubricInstance->details = $rubric->details;
                $rubricInstance->total_mark = $rubric->total_mark;
                $rubricInstance->group_id = $group->id;
                $rubricInstance->evaluation_id = $evaluation->id;
                $rubricInstance->save();

                foreach ($rubric->subRubrics() as $subRubric) {
                    $subRubricInstance = new SubRubric;
                    $subRubricInstance->aspect_to_be_evaluated = $subRubric->aspect_to_be_evaluated;
                    $subRubricInstance->details = $subRubric->details;
                    $subRubricInstance->total_mark = $subRubric->total_mark;
                    $subRubricInstance->rubric_id = $rubricInstance->id;
                    $subRubricInstance->save();
                    
                    foreach ($subRubric->subSubRubrics() as $subSubRubric) {
                        $subSubRubricInstance                         = new SubSubRubric;
                        $subSubRubricInstance->aspect_to_be_evaluated = $subSubRubric->aspect_to_be_evaluated;
                        $subSubRubricInstance->details                = $subSubRubric->details;
                        $subSubRubricInstance->total_mark             = $subSubRubric->total_mark;
                        $subSubRubricInstance->sub_rubric_id         = $subRubricInstance->id;
                        $subSubRubricInstance->save();
                    }
                }
            }
        }

        return redirect()->back()->with("success", "Rubrics generated successfully.");
    }


    //This method redirect to Add Mark
    public function groupRubric($evaluationId, $groupId)
    {
        $rubrics = Rubric::where("evaluation_id", $evaluationId)->where("group_id", $groupId)->get();
        $group = Group::where("id", $groupId)->first();
        $evaluation = Evaluation::where("id",$evaluationId)->first();
        return view("rubrics.addMark", ["rubrics"=>$rubrics, "evaluation" => $evaluation, "group"=>$group]);
    }

    public function addRubricMark(Request $request, $id)
    {
        $this->validate($request, [
            "learner_mark" => "required",
        ]);
        $rubric = Rubric::where("id", $id)->first();
        $previousMark = $rubric->learner_mark;
        if(!$rubric){
            return redirect()->back()->with("error", "Rubric not found")->withInput();
        }

        if ($request->learner_mark < 0) {
            return redirect()->back()->with("error", "Learner mark should not be negative.")->withInput();
        }

        if ($rubric->total_mark < $request->learner_mark) {
            return redirect()->back()->with("error", "Total mark cannot be less than learner mark")->withInput();
        }

        $rubric->learner_mark = $request->learner_mark;
        $rubric->comments = $request->comments;
        $rubric->update();


        //adding marks to groups and evaluations
        $students = Student::where("group_id", $rubric->group_id)->get();

        $group_mark_found = GroupMark::where("group_id", $rubric->group_id)->where("evaluation_id", $rubric->evaluation_id)->first();

        if (!$group_mark_found) {
            //create new marks from group
            $group_mark = new GroupMark;

            $group_mark->evaluation_id = $rubric->evaluation_id;
            $group_mark->mark = $request->learner_mark;
            $group_mark->group_id = $rubric->group_id;
    
            $evaluation = Evaluation::where("id", $rubric->evaluation_id)->first();
    
            if ($evaluation->total_mark < $request->achieved_mark) {
                return redirect()->back()->with("error", "Achieved mark cannot be greater than evaluation mark.");
            }
    
            
            foreach ($students as $student) {
                $student_mark = new StudentMark;
                $student_mark->mark = $request->learner_mark;
                $student_mark->evaluation_id = $evaluation->id;
                $student_mark->student_number = $student->student_number;
                $student_mark->save();
            }
            $group_mark->save();
        }else{

            //create new marks from group
            $group_mark = GroupMark::where("group_id", $rubric->group_id)->where("evaluation_id", $rubric->evaluation_id)->first();
    
            $evaluation = Evaluation::where("id", $rubric->evaluation_id)->first();
    
            if ($evaluation->total_mark < $request->achieved_mark) {
                return redirect()->back()->with("error", "Achieved mark cannot be greater than evaluation mark.");
            }

            $markAbsDifference = abs($request->learner_mark - $previousMark);
            $markDifference = $request->learner_mark - $previousMark;

            if ($request->learner_mark  == 0) {
                $group_mark->mark = $group_mark->mark - $previousMark;
            }
            
            if($markDifference < 0){
                $group_mark->mark = $group_mark->mark - $markAbsDifference;
            }else{
                $group_mark->mark = $group_mark->mark + $markAbsDifference;
            }

            
    
            
            foreach ($students as $student) {
                $student_mark = StudentMark::where("student_number", $student->student_number)->where("evaluation_id", $evaluation->id)->first();
                
                if ($request->learner_mark  == 0) {
                    $student_mark->mark = $student_mark->mark - $previousMark;
                }if($markDifference < 0){
                    $student_mark->mark = $student_mark->mark - $markAbsDifference;
                }else{
                    $student_mark->mark = $student_mark->mark + $markAbsDifference;
                }
                $student_mark->update();
            }
            $group_mark->update();
        }

        

        return redirect()->back()->with("success", "Learner mark updated successfully.");
    }

    //add subrubric mark
    public function addSubRubricMark(Request $request, $id)
    {
        $this->validate($request, [
            "learner_mark" => "required"
        ]);

        $rubric = SubRubric::where("id", $id)->first();
        if ($request->learner_mark < 0) {
            return redirect()->back()->with("error", "Learner mark should not be negative.")->withInput();
        }

        if(!$rubric){
            return redirect()->back()->with("error", "Sub rubric not found");
        }
        $previousMark = $rubric->learner_mark;
        $rubric->learner_mark = $request->learner_mark;
        $rubric->comments = $request->comments;
        $rubric->update();

        if ($rubric->total_mark < $request->learner_mark) {
            return redirect()->back()->with("error", "Total mark cannot be less than learner mark");
        }
        $students = Student::where("group_id", $rubric->rubric()->group_id)->get();
        $group_mark_found = GroupMark::where("group_id", $rubric->rubric()->group_id)->where("evaluation_id", $rubric->rubric()->evaluation_id)->first();

        if (!$group_mark_found) {
            //create new marks from group
            $group_mark = new GroupMark;

            $group_mark->evaluation_id = $rubric->rubric()->evaluation_id;
            $group_mark->mark = $request->learner_mark;
            $group_mark->group_id = $rubric->rubric()->group_id;
    
            $evaluation = Evaluation::where("id", $rubric->rubric()->evaluation_id)->first();
    
            if ($evaluation->total_mark < $request->achieved_mark) {
                return redirect()->back()->with("error", "Achieved mark cannot be greater than evaluation mark.");
            }
    
            
            foreach ($students as $student) {
                $student_mark = new StudentMark;
                $student_mark->mark = $request->learner_mark;
                $student_mark->evaluation_id = $evaluation->id;
                $student_mark->student_number = $student->student_number;
                $student_mark->save();
            }
            $group_mark->save();
        }else{

            //create new marks from group
            $group_mark = GroupMark::where("group_id", $rubric->rubric()->group_id)->where("evaluation_id", $rubric->rubric()->evaluation_id)->first();
    
            $evaluation = Evaluation::where("id", $rubric->rubric()->evaluation_id)->first();
    
            if ($evaluation->total_mark < $request->achieved_mark) {
                return redirect()->back()->with("error", "Achieved mark cannot be greater than evaluation mark.");
            }

            $markAbsDifference = abs($request->learner_mark - $previousMark);
            $markDifference = $request->learner_mark - $previousMark;

            if ($request->learner_mark  == 0) {
                $group_mark->mark = $group_mark->mark - $previousMark;
            }
            
            if($markDifference < 0){
                $group_mark->mark = $group_mark->mark - $markAbsDifference;
            }else{
                $group_mark->mark = $group_mark->mark + $markAbsDifference;
            }
    
            
            foreach ($students as $student) {
                $student_mark = StudentMark::where("student_number", $student->student_number)->where("evaluation_id", $evaluation->id)->first();
                if ($request->learner_mark  == 0) {
                    $student_mark->mark = $student_mark->mark - $previousMark;
                }if($markDifference < 0){
                    $student_mark->mark = $student_mark->mark - $markAbsDifference;
                }else{
                    $student_mark->mark = $student_mark->mark + $markAbsDifference;
                }
                $student_mark->update();
            }
            $group_mark->update();
        }
        return redirect()->back()->with("success", "Learner mark updated successfully.");
    }

    public function addSubSubRubricMark(Request $request, $id)
    {
        $this->validate($request, [
            "learner_mark" => "required"
        ]);
        $rubric = SubSubRubric::where("id", $id)->first();
        if ($request->learner_mark < 0) {
            return redirect()->back()->with("error", "Learner mark should not be negative.")->withInput();
        }
        $previousMark = $rubric->learner_mark;
        if(!$rubric){
            return redirect()->back()->with("error", "Rubric not found");
        }

        if ($rubric->total_mark < $request->learner_mark) {
            return redirect()->back()->with("error", "Total mark cannot be less than learner mark");
        }

        $rubric->learner_mark = $request->learner_mark;
        $rubric->comments = $request->comments;
        $rubric->update();

        if ($rubric->total_mark < $request->learner_mark) {
            return redirect()->back()->with("error", "Total mark cannot be less than learner mark");
        }

                //adding marks to groups and evaluations
                $students = Student::where("group_id", $rubric->subRubric()->rubric()->group_id)->get();

                $group_mark_found = GroupMark::where("group_id", $rubric->subRubric()->rubric()->group_id)->where("evaluation_id", $rubric->subRubric()->rubric()->evaluation_id)->first();
        
                if (!$group_mark_found) {
                    //create new marks from group
                    $group_mark = new GroupMark;
        
                    $group_mark->evaluation_id = $rubric->subRubric()->rubric()->evaluation_id;
                    $group_mark->mark = $request->learner_mark;
                    $group_mark->group_id = $rubric->subRubric()->rubric()->group_id;
            
                    $evaluation = Evaluation::where("id", $rubric->subRubric()->rubric()->evaluation_id)->first();
            
                    if ($evaluation->total_mark < $request->achieved_mark) {
                        return redirect()->back()->with("error", "Achieved mark cannot be greater than evaluation mark.");
                    }
            
                    
                    foreach ($students as $student) {
                        $student_mark = new StudentMark;
                        $student_mark->mark = $request->learner_mark;
                        $student_mark->evaluation_id = $evaluation->id;
                        $student_mark->student_number = $student->student_number;
                        $student_mark->save();
                    }
                    $group_mark->save();
                }else{
        
                    //create new marks from group 
                    $evaluation = Evaluation::where("id", $rubric->subRubric()->rubric()->evaluation_id)->first();
                    $group_mark = GroupMark::where("group_id", $rubric->subRubric()->rubric()->group_id)->where("evaluation_id", $rubric->subRubric()->rubric()->evaluation_id)->first();
            
                    if ($evaluation->total_mark < $request->achieved_mark) {
                        return redirect()->back()->with("error", "Achieved mark cannot be greater than evaluation mark.");
                    }
        
                    $markAbsDifference = abs($request->learner_mark - $previousMark);
                    $markDifference = $request->learner_mark - $previousMark;
        
                    if ($request->learner_mark  == 0) {
                        $group_mark->mark = $group_mark->mark - $previousMark;
                    }
                    
                    if($markDifference < 0){
                        $group_mark->mark = $group_mark->mark - $markAbsDifference;
                    }else{
                        $group_mark->mark = $group_mark->mark + $markAbsDifference;
                    }
            
                    
                    foreach ($students as $student) {
                        $student_mark = StudentMark::where("student_number", $student->student_number)->where("evaluation_id", $evaluation->id)->first();
                        if ($request->learner_mark  == 0) {
                            $student_mark->mark = $student_mark->mark - $previousMark;
                        }if($markDifference < 0){
                            $student_mark->mark = $student_mark->mark - $markAbsDifference;
                        }else{
                            $student_mark->mark = $student_mark->mark + $markAbsDifference;
                        }
                        $student_mark->update();
                    }
                    $group_mark->update();
                }

        return redirect()->back()->with("success", "Learner mark updated successfully.");
    }



    //edit rubrics
    public function editRubric($id)
    {
        $rubric = Rubric::where("id", $id)->first();
        if (!$rubric) {
            return redirect()->back()->with("error", "Rubric not found");
        }
        return view("rubrics.editRubric", ["rubric" => $rubric]);
    }

    public function editSubRubric($id)
    {
        $subRubric = SubRubric::where("id", $id)->first();
        if (!$subRubric) {
            return redirect()->back()->with("error", "Sub rubric not found");
        }
        return view("rubrics.editSubRubric", ["subRubric" => $subRubric]);
    }

    public function editSubSubRubric($id)
    {
        $subSubRubric = SubSubRubric::where("id", $id)->first();
        if (!$subSubRubric) {
            return redirect()->back()->with("error", "Sub sub rubric not found");
        }
        return view("rubrics.editSubSubRubric", ["subSubRubric" => $subSubRubric ]);
    }

    public function updateRubric(Request $request, $id)
    {
        $rubric = Rubric::where("id", $id)->first();
        if (!$rubric) {
            return redirect()->back()->with("error", "Rubric not found");
        }

        $this->validate($request, ["total_mark"=>"required"]);

        $rubric->aspect_to_be_evaluated = $request->aspect_to_be_evaluated;
        $rubric->details = $request->details;
        $rubric->total_mark = $request->total_mark;
        $rubric->update();
        return redirect()->back()->with("success", "Rubric updated successfully.");
    }

    public function updateSubRubric(Request $request, $id)
    {
        $subRubric = SubRubric::where("id", $id)->first();
        if (!$subRubric) {
            return redirect()->back()->with("error", "Rubric not found");
        }

        $this->validate($request, ["total_mark"=>"required"]);

        $subRubric->aspect_to_be_evaluated = $request->aspect_to_be_evaluated;
        $subRubric->details = $request->details;
        $subRubric->total_mark = $request->total_mark;
        $subRubric->update();
        return redirect()->back()->with("success", "Sub rubric updated successfully.");
    }

    public function updateSubSubRubric(Request $request, $id)
    {
        $subSubRubric = SubSubRubric::where("id", $id)->first();
        if (!$subSubRubric) {
            return redirect()->back()->with("error", "Rubric not found");
        }

        $this->validate($request, ["total_mark"=>"required"]);

        $subSubRubric->aspect_to_be_evaluated = $request->aspect_to_be_evaluated;
        $subSubRubric->details = $request->details;
        $subSubRubric->total_mark = $request->total_mark;
        $subSubRubric->update();
        return redirect()->back()->with("success", "Sub sub  rubric updated successfully.");
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rubric  $rubric
     * @return \Illuminate\Http\Response
     */
    public function edit(Rubric $rubric)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rubric  $rubric
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rubric $rubric)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rubric  $rubric
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rubric $rubric)
    {
        //
    }


    private function addMarks(Request $request, $rubric){

        $group_mark_found = GroupMark::where("group_id", $rubric->group_id)->where("evaluation_id", $rubric->evaluation_id)->first();

        if (!$group_mark_found) {
            //create new marks from group
            $group_mark = new GroupMark;

            $group_mark->evaluation_id = $rubric->evaluation_id;
            $group_mark->mark = $request->learner_mark;
            $group_mark->group_id = $rubric->group_id;
    
            $evaluation = Evaluation::where("id", $rubric->evaluation_id)->first();
    
            if ($evaluation->total_mark < $request->achieved_mark) {
                return redirect()->back()->with("error", "Achieved mark cannot be greater than evaluation mark.");
            }
    
            
            foreach ($students as $student) {
                $student_mark = new StudentMark;
                $student_mark->mark = $request->learner_mark;
                $student_mark->evaluation_id = $evaluation->id;
                $student_mark->student_number = $student->student_number;
                $student_mark->save();
            }
            $group_mark->save();
        }else{
            //create new marks from group
            $group_mark = GroupMark::where("group_id", $rubric->group_id)->where("evaluation_id", $rubric->evaluation_id)->first();

            $group_mark->evaluation_id = $rubric->evaluation_id;
            $group_mark->mark = $group_mark->mark + $request->learner_mark;
            $group_mark->group_id = $rubric->group_id;
    
            $evaluation = Evaluation::where("id", $rubric->evaluation_id)->first();
    
            if ($evaluation->total_mark < $request->achieved_mark) {
                return redirect()->back()->with("error", "Achieved mark cannot be greater than evaluation mark.");
            }
    
            
            foreach ($students as $student) {
                $student_mark = StudentMark::where("student_number", $student->student_number)->where("evaluation_id", $evaluation->id)->first();
                $student_mark->mark = $student_mark->mark + $request->learner_mark;
                $student_mark->evaluation_id = $evaluation->id;
                $student_mark->student_number = $student->student_number;
                $student_mark->update();
            }
            $group_mark->update();
        }
    }
}
