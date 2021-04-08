<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Instructor;
use App\Evaluation;
use App\Group;


class EvaluationController extends Controller
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

        $evaluations = Evaluation::all();

        return view("evaluations.index", ["evaluations"=>$evaluations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("evaluations.create");
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
            "total_mark" => "required",
            "total_percentage" => "required"
        ]);


        if ($request->total_mark <= 0 || $request->total_percentage <= 0) {
           return redirect()->back()->with("error", "Total mark or total percentage cannot be less or equal to zero.")->withInput();
        }

        if (Evaluation::where("name", $request->name)->first()) {
            return redirect()->back()->with('error', "$request->name already exist.");
        }

        $evaluation = new Evaluation;

        $evaluation->name = $request->name;
        $evaluation->total_mark = $request->total_mark;
        $evaluation->total_percentage = $request->total_percentage;
        $evaluation->stuff_number = $instructor->stuff_number;

        $evaluation->save();
        return redirect()->route('evaluations')->with("success", "Evaluation created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Evaluation::where("id", $id)->first()){
            return redirect()->back()->with("error", "Evaluation not found");
        }

        $evaluation = Evaluation::where("id", $id)->first();

        return view("evaluations.show", ["evaluation"=>$evaluation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Evaluation::where("id", $id)->first()){
            return redirect()->back()->with("error", "Evaluation not found");
        }

        $evaluation = Evaluation::where("id", $id)->first();

        return view("evaluations.edit", ["evaluation"=>$evaluation]);
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
            "total_mark" => "required",
            "total_percentage" => "required"
        ]);

        if ($request->total_mark <= 0 || $request->total_percentage <= 0) {
            return redirect()->back()->with("error", "Total mark or total percentage cannot be less or equal to zero.")->withInput();
         }

        if(!Evaluation::where("id", $id)->first()){
            return redirect()->back()->with("error", "Evaluation not found");
        }

        $evaluation = Evaluation::where("id", $id)->first();

        $evaluation->name = $request->name;
        $evaluation->total_mark = $request->total_mark;
        $evaluation->total_percentage = $request->total_percentage;

        $evaluation->update();
        return redirect()->route('evaluations')->with("success", "Evaluation updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Evaluation::where("id", $id)->first()){
            return redirect()->back()->with("error", "Evaluation not found");
        }

        $evaluation = Evaluation::where("id", $id)->first();
        $evaluation->delete();

        return redirect()->route('evaluations')->with("success", "Evaluation deleted successfully.");
    }
}
