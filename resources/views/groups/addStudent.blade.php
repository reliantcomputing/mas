@extends('layouts.admin')

@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Add Student to {{$group->name}}</h1>
                        </div>
                        <hr class="badge-danger">
                        <form action="{{route("saveStudentGroup", $group->id)}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('student_number') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('student_number') ? ' is-invalid' : '' }}" placeholder="{{ __('Student Number') }}" type="text" name="student_number" value="{{ old('student_number') }}">
                                    </div>
                                </div>
                                @if ($errors->has('student_number'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('student_number') }}</strong>
                                    </span>
                                @endif
    
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-primary btn-user" type="submit">
                                       Save
                                    </button>
                                </div>
                            </div>
    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection