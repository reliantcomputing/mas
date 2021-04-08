@extends('layouts.home')

@section('content')

<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Intructor Registration</h1>
                    </div>
                    <hr class="badge-danger">
                    <form action="{{route("saveInstructor")}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('full_name') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Full Names') }}" type="text" name="full_name" value="{{ old('full_name') }}"
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
                                    <input class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" placeholder="{{ __('Surname') }}" type="text" name="surname" value="{{ old('surname') }}"
                                    pattern="^[a-zA-Z]+(\s[a-zA-Z]+)?$" title="Numbers and special charactors are not allowed.">
                                </div>
                                @if ($errors->has('surname'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('surname') }}</strong>
                                </span>
                            @endif
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('stuff_number') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('stuff_number') ? ' is-invalid' : '' }}" placeholder="{{ __('Stuff Number') }}" type="number" name="stuff_number" value="{{ old('stuff_number') }}">
                                </div>
                                @if ($errors->has('stuff_number'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('stuff_number') }}</strong>
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
                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email Address') }}" type="email" name="email" value="{{ old('email') }}"  autofocus>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

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
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                <input class="form-control" placeholder="{{ __('Confirm Password') }}" type="password" name="password_confirmation" >
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