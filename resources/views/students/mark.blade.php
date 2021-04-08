@extends('layouts.admin')

@section('content')
@php
$date = $student->date_of_birth;
$createDate = new DateTime($date);

@endphp

    <div class="row">
            <div class="col-md-6"> 
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            <i class="fa fa-user"></i>
                            Student Details
                        </h4>
                        <hr>
                        <b>Student Number</b><br>
                        <span>{{$student->student_number}}</span><br>
                        <b>Full Names</b><br>
                        <span>{{$student->full_name}}</span><br>
                        <b>Last Name</b><br>
                        <span>{{$student->surname}}</span><br>
                        <b>Email</b><br>
                        <span>{{$student->email}}</span><br>
                        <b>ID Number</b><br>
                        <span>{{$student->id_number}}</span><br>
                        <b>Date of Birth</b><br>
                        <span>{{$createDate->format("Y-m-d")}}</span><br>
                    </div>
                </div>        
            </div>
            <div class="col-md-6"> 
                    <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">
                                <i class="fa fa-edit"></i>
                                Roles
                              </h4>
                              @if ($student->user())
                                1. Student Role <br>
                                @if ($student->user()->hasRole("ROLE_INSTRUCTOR"))
                                  2. Instructor Role <br> 
                                @endif 
                                @else
                                    <p class="text-warning">Not registered.</p>
                              @endif
                              <hr>
                              @if ($student->user())
                                @if (!$student->user()->hasRole("ROLE_INSTRUCTOR"))
                                    <a href="{{route("giveInstructorRole", $student->student_number)}}" class="btn btn-primary btn-sm">Grant Instructor Role</a>
                                @else
                                    <a href="{{route("removeInstructorRole", $student->student_number)}}" class="btn btn-danger btn-sm">Remove Instructor Role</a> 
                                @endif 
                              @endif
                        
                            </div>
                          </div>
            </div>
        </div>
    
    <hr class="bg-danger">
   
    <div class="col-md-12"> 
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="fa fa-check"></i>
                        Student  Marks
                    </h4>
                    <hr>
                    <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Evaluation</th>
                                    
                                    <th>Achived Mark</th>
                                    <th>Total Mark</th>           
                                    <th>Achieved Percentage(%)</th>
                                    <th>Total Percentage</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                        
                                    @forelse ($student_marks as $student_mark)
                                    <tr>
                                            <td>{{$student_mark->evaluation->name}}</td>
                                            <td>
                                                {{$student_mark->mark}}
                                            </td>
                                            <td>
                                                {{$student_mark->evaluation->total_mark}}
                                            </td>
                                            <td>{{$student_mark->evaluation->total_percentage*($student_mark->mark/$student_mark->evaluation->total_mark)}}</td>
                                            <td>{{$student_mark->evaluation->total_percentage}}</td>
                                            <td>
                                            <a class="btn btn-primary" href="{{route("editStudentMark", $student_mark->id)}}">
                                                Edit
                                            </a>
                                            </td>
                                            
                                        </tr> 
                                    @empty
                                    @endforelse
                        
                                </tbody>
                            </table>
                            
                        </div>   
                </div>
                <div class="card-footer">
                    <span>Achieved Percentage(100%): {{$mark}}</span>
                </div>
            </div>        
        </div>
 
@endsection