@extends('layouts.admin')

@section('content')

@if(Auth::user()->hasRole("ROLE_INSTRUCTOR"))
<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Dashboard
        </h1>
</div>

<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Students</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$students->count()}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Groups</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$groups->count()}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Evaluations</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$evaluations->count()}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<hr>
@if(Auth::user()->hasRole("ROLE_STUDENT"))
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
                    </div>
                </div>        
            </div>
            <div class="col-md-6"> 
                    <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">
                                <i class="fa fa-lock"></i>
                                Change Password
                              </h4>
                              <hr>
                              <form class="" action="{{route("updateStudentPassword")}}" method="post">
                                    @csrf()
                    
                                          <!-- country and region -->
                    
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                                        <div class="input-group input-group-alternative mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                                            </div>
                                                            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" type="password" name="password" value="{{ old('password') }}" >
                                                        </div>
                                                        @if ($errors->has('password'))
                                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
                                                        <div class="input-group input-group-alternative mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                                            </div>
                                                            <input class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" placeholder="{{ __('Confirm Password') }}" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" >
                                                        </div>
                                                        @if ($errors->has('password_confirmation'))
                                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                              </div>
                    
                    
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-sm btn-primary">
                                              {{ __('Update Password') }}
                                            </button>
                                        </div>
                                  </form>
                        
                            </div>
                          </div>
            </div>
    </div>
@endif
<hr>


@if (Auth::user()->hasRole("ROLE_STUDENT"))
<div class="col-md-12"> 
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fa fa-user"></i>
                    Group Progress
                </h4>
                <hr>
                <div class="table-responsive">
                        <table class="table table-bordered" id="dataTablve" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Evaluation</th>
                                
                                <th>Achived Mark</th>
                                <th>Total Mark</th>
                                
                                <th>Achieved Percentage(%)</th>
                                <th>Total Percentage(%)</th>
                            </tr>
                            </thead>
                            <tbody>
                    
                                @forelse ($student->groupMarks() as $group_mark)
                                <tr>
                                        <td>{{$group_mark->evaluation->name}}</td>
                                        <td>
                                            {{$group_mark->mark}}
                                        </td>
                                        <td>
                                            {{$group_mark->evaluation->total_mark}}
                                        </td>
                    
                                        <td>{{$group_mark->evaluation->total_percentage*($group_mark->mark/$group_mark->evaluation->total_mark)}}</td>
                                        <td>{{$group_mark->evaluation->total_percentage}}</td>
                                        
                                    </tr> 
                                @empty
                                @endforelse
                    
                            </tbody>
                        </table>
                       
                    </div>              
            </div>
            <div class="card-footer">
                    <span>Achieved Percentage(100%): {{$student->groupMark()}}</span>
            </div>
        </div>        
    </div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            @if ($student->getGroup() == null)
                Group Not Allocated,
                <small>
                    <span class="text-danger">
                        Contact your instructor
                    </span>
                </small>
            @endif
        </h1>
</div> 

@if ($student->getGroup())
<div class="col-md-12"> 
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fa fa-user"></i>
                    Student Progress
                </h4>
                <hr>
                <div class="table-responsive">
                        <table class="table table-bordered" id="datavTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Evaluation</th>
                                
                                <th>Achived Mark</th>
                                <th>Total Mark</th>
                                
                                <th>Achieved Percentage(%)</th>
                                <th>Total Percentage(%)</th>
                            </tr>
                            </thead>
                            <tbody>
                    
                                @forelse ($student->studentMarks() as $student_mark)
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
                                        
                                    </tr> 
                                @empty
                                @endforelse
                    
                            </tbody>
                        </table>
                    </div>
            </div>
            <div class="card-footer">
                    <span>Achieved Percentage(100%): {{$student->studentMark()}}</span>
            </div>
        </div>        
    </div>

    <div class="col-md-12"> 
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-danger btn-sm" href="{{route("printMark", $student->student_number)}}">
                            Download Progress Report
                    </a>
                </div>
            </div>        
        </div>
@else   

@endif

@endif

@endsection