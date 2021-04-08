@extends('layouts.home')

@section('content')

<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
                    </div>
                    <hr class="badge-danger">
                    <form action="{{route("processPasswordReset")}}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('new_password') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" type="password" name="new_password" value="{{ old('new_password') }}"  autofocus>
                                    </div>
                                    @if ($errors->has('new_password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('new_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('confirm_password') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input class="form-control{{ $errors->has('confirm_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Confirm Password') }}" type="password" name="confirm_password" value="{{ old('confirm_password') }}"  autofocus>
                                    </div>
                                    @if ($errors->has('confirm_password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('confirm_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-primary btn-user" type="submit">
                                   Reset Password
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