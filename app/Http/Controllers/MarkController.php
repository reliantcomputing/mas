<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Exports\StudentsExport;
use Excel;
use PDF;
class MarkController extends Controller
{

    public function index()
    {
        $students = Student::all();

        return view("marks.index", ["students" => $students]);
    }

    public function print(Request $request)
    {
        $students = collect();
        $allStudent = Student::all();

        $all = "ALL";
        //in between inclusive and exclusive 
        $inBetweenExclusive = "IN_BETWEEN_EXCLUSIVE";
        $inBetweenInclusive = "IN_BETWEEN_INCLUSIVE";

        //greater or less inclusive
        $greaterThanInclusive = "GREATER_THAN_INCLUSIVE";
        $lessThanInclusive = "LESS_THAN_INCLUSIVE";

        //greater or less exclusive
        $greaterThanExclusive = "GREATER_THAN_EXCLUSIVE";
        $lessThanExclusive = "LESS_THAN_INCLUSIVE";
        
        $title = "";

        //conditions
        if ($request->condition == $all) {
            $title = "All Marks DSO34BT.";
            //all student marks need to be printed
            $students = $allStudent;
        
        }
        //in between exclusive, sorted
        elseif($request->condition == $inBetweenExclusive){
            $title = "Marks between $request->min and $request->max exclusively, DSO34BT.";
            foreach ($allStudent as $student) {
                if($student->studentMarK()){
                    if($student->studentMark() > $request->min && $student->studentMark()< $request->max){
                        $students->push($student);
                    }
                }
            }
        }
        //in between inclusive, sorted
        elseif($request->condition == $inBetweenInclusive){
            $title = "Marks between $request->min and $request->max inclusively, DSO34BT";
            foreach ($allStudent as $student) {
                if($student->studentMarK()){
                    if($student->studentMark() >= $request->min && $student->studentMark()<= $request->max){
                        $students->push($student);
                    }
                }
            }
        }

        //less than exclusive, sorted
        elseif($request->condition == $lessThanExclusive){
            $title = "Marks less than $request->value exclusively, DSO34BT";
            foreach ($allStudent as $student) {
                if($student->studentMarK()){
                    if($student->studentMark() < $request->value){
                        $students->push($student);
                    }
                }
            }
        }
        //less than inclusive, sorted
        elseif($request->condition == $lessThanInclusive){
            $title = "Marks less than $request->value inclusively, DSO34BT";
            foreach ($allStudent as $student) {
                if($student->studentMarK()){
                    if($student->studentMark() <= $request->value){
                        $students->push($student);
                    }
                }
            }
        }

        //greater than exclusive, sorted
        elseif($request->condition == $greaterThanInclusive){
            $title = "Marks greater than  $request->value exclusively, DSO34BT";
            foreach ($allStudent as $student) {
                if($student->studentMarK()){
                    if($student->studentMark() > $request->value){
                        $students->push($student);
                    }
                }
            }
        }
        //greater than exclusive
        elseif($request->condition == $greaterThanExclusive){
            $title = "Marks greater than $request->value exclusively, DSO34BT";
            foreach ($allStudent as $student) {
                if($student->studentMarK()){
                    if($student->studentMark() >= $request->value){
                        $students->push($student);
                    }
                }
            }
        }

        //PDF or Excel
        if ($request->type == "PDF") {
            $data = ['students' => $students, "title"=>$title];
            $pdf = PDF::loadView('marks.mark', $data);  
            return $pdf->download('DSO34BT_marks.pdf');

        }else{
            return Excel::download(new StudentsExport($title, $students), 'DSO34BT_marks.xlsx');
        }
    }
}
