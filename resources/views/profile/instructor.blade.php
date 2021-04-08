@extends('layouts.admin')

@section('content')
<div class="col-md-12"> 
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fa fa-user"></i>
                    Students Instructor
                </h4>
                <hr>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Surname</th>
                            <th>Student Number</th>
                            <th>Email</th>
                            <th>Group</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                
                            @forelse ($students as $student)
                            <tr>
                                    <td>{{$student->full_name}}</td>
                                    <td>{{$student->surname}}</td>
                                    <td>
                                        {{$student->student_number}}
                                    </td>
                
                                    <td>
                                        {{$student->email}}
                                    </td>
                
                                    <td>
                                        @if ($student->getGroup())
                                            {{$student->getGroup()->name}}
                                        @else 
                                            Not allocated
                                        @endif
                                    </td>
                    
                                    <td>
                                        <a class="btn btn-success btn-sm" href="{{route("markStudent", $student->student_number)}}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr> 
                            @empty
                            @endforelse
                
                        </tbody>
                    </table>
            </div>
        </div>        
    </div>
@endsection