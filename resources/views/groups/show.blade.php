@extends('layouts.admin')

@section('content')
    



<div class="row">
    <div class="col-md-9">
        <h2>Students, {{$group->name}}
            <a href="{{route("addStudentGroup", $group->id)}}" class="btn-danger btn-sm">
                <i class="fa fa-plus"></i>
                Add Student
            </a>
        </h2>
    </div>
</div>

<hr class="bg-danger">

<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>Full Name</th>
            <th>Surname</th>
            <th>Student Number</th>
            <th>ID Number</th>
            <th>Email</th>
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
                    <a class="btn btn-danger btn-sm" onclick="return confirm(confirmDelete('Are you sure you want to remove this {{$student->full_name}}?'))" href="{{route("removeStudent", $student->student_number)}}">
                            Remove
                        </a>
                    </td>
                </tr> 
            @empty
            @endforelse

        </tbody>
    </table>
</div>

<br>

    
    <hr class="bg-danger">

    <div class="col-md-12"> 
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                            <i class="fa fa-checkr"></i>
                            Group Progress <br>
                        <div class="dropdown show">
                                    
                                    <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      View/Edit Rubric
                                    </a>
                                  
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        @foreach ($evaluations as $evaluation)
                                            <a class="dropdown-item" href="{{route("groupRubric", ["evaluationId"=>$evaluation->id,"groupId" => $group->id])}}">{{$evaluation->name}}</a>
                                        @endforeach
                                      
                                    </div>
                                    &nbsp;
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">
                                            Generate Rubric
                                    </button>
                                
                        </div>
                    
                    </h4>
                    <hr>
                    <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Evaluation</th>
                                    <th>Total Mark</th>
                                    <th>Achieved Mark</th>
                                    <th>Achieved Percentage(%)</th>
                                    <th>Total Percentage</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                        
                                    @forelse ($group_marks as $group_mark)
                                    <tr>
                                            <td>{{$group_mark->evaluation->name}}</td>
                                            <td>
                                                {{$group_mark->evaluation->total_mark}}
                                            </td>
                                            <td>
                                                {{$group_mark->mark}}
                                            </td>
                                            <td>{{$group_mark->evaluation->total_percentage*($group_mark->mark/$group_mark->evaluation->total_mark)}}</td>
                                            <td>{{$group_mark->evaluation->total_percentage}}</td>
                                            <td>
                                                <a class="btn btn-primary" href="{{route("groupRubric", ["evaluationId"=>$group_mark->evaluation->id,"groupId" => $group->id])}}">
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

        <br>
    




    <!-- Button trigger modal -->

      
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                  Generate Rubric
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="{{route("generateRubric", $group->id)}}" method="post">
                    @csrf
                    <div class="col-md-12">
                            <div class="form-group{{ $errors->has('evaluation') ? ' has-danger' : '' }}">
                                    <select class="form-control{{ $errors->has('evaluation') ? ' is-invalid' : '' }}" name="evaluation">
                                            <option value="">Select Evaluation</option>
                                            
                                                @forelse ($collection as $evaluation)
                                                    <option value="{{$evaluation->id}}">{{$evaluation->name}}</option>
                                                @endforeach
                                            
                                    </select>
                                
                            </div>
                        </div>
                        @if ($errors->has('evaluation'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('evaluation') }}</strong>
                            </span>
                        @endif
                        <hr>
                        <button type="submit" class="btn btn-primary">Generate Rubric</button>
            </form>
            </div>
          </div>
        </div>
      </div>
@endsection