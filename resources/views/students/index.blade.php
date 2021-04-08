@extends('layouts.admin')

@section('content')
    <div class="col-md-12"> 
        <div class="card">
            <div class="card-body">
                <div class="col-md-9">
                        <div class="card-title">
                            <div class="row">
                                    <div class="col-md-9">
                                            <i class="fa fa-user"></i>
                                            Students 
                                                <a href="{{route("createStudent")}}" class="btn-success btn-sm">
                                                    <i class="fa fa-plus"></i>
                                                    Add
                                                </a>
                                                &nbsp;
                                                <a href="{{route("callUploadView")}}" class="btn-primary btn-sm">
                                                    <i class="fa fa-upload"></i>
                                                    Upload
                                                </a>
                                                &nbsp;
                                                <a href="{{route("deleteAllStudents")}}" class="btn-danger btn-sm"
                                                onclick="return confirm(confirmDelete('Are you sure you want to delete all students?'))">
                                                    <i class="fa fa-trash"></i>
                                                    Delete All
                                                </a>
                                    </div>
                                    
    
                                        <div class="col-md-3 justify-content-end">
    
                                                <div class="dropdown show">
                                                        <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          Generate File
                                                        </a>
                                                      
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                          <a class="dropdown-item" href="{{route("exportStudents")}}">Excel</a>
                                                            <a class="dropdown-item" href="{{route("printStudents")}}">PDF</a>
                                                            <a class="dropdown-item" href="{{route("exportStudentsCSV")}}">CSV</a>
                                                        </div>
                                                </div>
                                            </div>
                            </div>
                                
                        </div>
                </div>
                
                <hr>
                <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Surname</th>
                                <th>Student Number</th>
                                <th>ID Number</th>
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
                                            {{$student->id_number}}
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
                                            <a class="btn btn-success btn-sm p-0" href="{{route("markStudent", $student->student_number)}}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            
                                            <a class="btn btn-primary btn-sm p-0" href="{{route("editStudent", $student->student_number)}}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                           
                                        <a class="btn btn-danger btn-sm p-0" onclick="return confirm(confirmDelete('Are you sure you want this {{$student->full_name}}?'))" href="{{route("deleteStudent", $student->student_number)}}">
                                                <i class="fa fa-trash"></i>
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