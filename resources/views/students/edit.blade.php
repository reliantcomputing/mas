@extends('layouts.admin')

@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Edit Student</h1>
                        </div>
                        <hr class="badge-danger">
                        <form action="{{route("updateStudent", $student->student_number)}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('full_name') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Full Names') }}" type="text" name="full_name" value="{{ $student->full_name }}"
                                        pattern="^[a-zA-Z]+(\s[a-zA-Z]+)?$" title="Numbers  and special charactors are not allowed.">
                                    </div>
                                    @if ($errors->has('full_name'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('full_name') }}</strong>
                                    </span>
                                @endif
                                </div>
                                

                                <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('surname') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" placeholder="{{ __('Surname') }}" type="text" name="surname" value="{{ $student->surname }}"
                                            pattern="^[a-zA-Z]+(\s[a-zA-Z]+)?$" title="Numbers  and special charactors are not allowed.">
                                        </div>
                                        @if ($errors->has('surname'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('surname') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                    
                            </div>
                                <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group{{ $errors->has('id_number') ? ' has-danger' : '' }}">
                                                <input class="form-control{{ $errors->has('id_number') ? ' is-invalid' : '' }}" placeholder="{{ __('ID Number') }}" type="number" name="id_number" value="{{ $student->id_number }}">
                                            </div>
                                            @if ($errors->has('id_number'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('id_number') }}</strong>
                                            </span>
                                        @endif
                                        </div>
                                        
                                    </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-primary btn-user" type="submit">
                                       update
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