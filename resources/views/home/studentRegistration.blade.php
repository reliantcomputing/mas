@extends('layouts.home')

@section('content')

<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Student Registration</h1>
                    </div>
                    <hr class="badge-danger">
                <form action="{{route("registerStudent")}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('student_number') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('student_number') ? ' is-invalid' : '' }}" placeholder="{{ __('Student Number') }}" type="number" name="student_number" value="{{ old('student_number') }}">
                                </div>
                                @if ($errors->has('student_number'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('student_number') }}</strong>
                                </span>
                            @endif
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('id_number') ? ' has-danger' : '' }}">           
                                    <input class="form-control{{ $errors->has('id_number') ? ' is-invalid' : '' }}" placeholder="{{ __('ID Number') }}" type="number" name="id_number" value="{{ old('id_number') }}">
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
                                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                                </div>
                                                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" type="password" name="password" >
                                            </div>
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                                </div>
                                                <input class="form-control" placeholder="{{ __('Confirm Password') }}" type="password" name="password_confirmation" >
                                            </div>
                                        </div>
                            </div>
                        </div>

                        <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('security_question') ? ' has-danger' : '' }}">           
                                            <input class="form-control{{ $errors->has('security_question') ? ' is-invalid' : '' }}" placeholder="{{ __('Security Answer') }}" type="text" name="security_question" value="{{ old('security_question') }}">
                                        </div>
                                        @if ($errors->has('security_question'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('security_question') }}</strong>
                                        </span>
                                    @endif
                                    </div>
    
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('security_answer') ? ' has-danger' : '' }}">           
                                        <input class="form-control{{ $errors->has('security_answer') ? ' is-invalid' : '' }}" placeholder="{{ __('Security Answer') }}" type="text" name="security_answer" value="{{ old('security_answer') }}">
                                    </div>
                                    @if ($errors->has('security_answer'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('security_answer') }}</strong>
                                    </span>
                                @endif
                                </div>
                                
                            </div>


                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-primary btn-user" type="submit">
                                   Register
                                </button>
                                <button class="btn btn-danger btn-user" type="submit">
                                    Cancel
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