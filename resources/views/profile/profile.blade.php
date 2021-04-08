@extends('layouts.admin')

@section('content')
    



<div class="row">
    <div class="col-md-9">
        <h2>Profile</h2>
    </div>
</div>

<hr class="bg-danger">

<div class="row">
    <div class="col-md-6"> 
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fa fa-user"></i>
                    Personal Details
                </h4>
                @php
                    $date = $instructor->date_of_birth;
                    $createDate = new DateTime($date);

                @endphp
                <hr>
                <b>Student Number</b><br>
                <span>{{$instructor->stuff_number}}</span><br>
                <b>Full Names</b><br>
                <span>{{$instructor->full_name}}</span><br>
                <b>Last Name</b><br>
                <span>{{$instructor->surname}}</span><br>
                <b>Email</b><br>
                <span>{{$instructor->email}}</span><br>
                <b>ID Number</b><br>
                <span>{{$instructor->id_number}}</span><br>
                <b>Date of Birth</b><br>
                <span>{{$createDate->format("Y-m-d")}}</span><br>
                <b>Gender</b><br>
                <span>{{$instructor->gender}}</span><br>
            </div>
        </div>        
    </div>
    <div class="col-md-6"> 
            <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">
                        <i class="fa fa-edit"></i>
                        Edit Profile
                      </h4>
                      <form class="" action="{{route("updateProfile")}}" method="post">
                        @csrf()
                            <!-- first name and last name -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('full_name') ? ' has-danger' : '' }}">
                                    <label for="full_name">Full Names</label>
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input class="form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Full Names') }}" type="text" name="full_name" value="{{ $instructor->full_name }}" 
                                        pattern="^[a-zA-Z]+(\s[a-zA-Z]+)?$" title="Numbers and special charactors are not allowed.">
                                    </div>
                                    @if ($errors->has('full_name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('full_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group{{ $errors->has('surname') ? ' has-danger' : '' }}">
                                    <label for="surname">Surname</label>
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" placeholder="{{ __('Last Name') }}" type="text" name="surname" value="{{ $instructor->surname }}"
                                        pattern="^[a-zA-Z]+(\s[a-zA-Z]+)?$" title="Numbers  and special charactors are not allowed.">
                                    </div>
                                    @if ($errors->has('surname'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('surname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                          </div>
        
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
                                <button type="submit" class="btn btn-lg btn-primary btn-block">
                                  {{ __('Update Details') }}
                                </button>
                            </div>
                      </form>
                    </div>
                  </div>
    </div>
</div>

@endsection