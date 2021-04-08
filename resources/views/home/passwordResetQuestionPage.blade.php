@extends('layouts.home')

@section('content')

<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Security Question</h1>
                    </div>
                    <hr class="badge-danger">
                    <form action="{{route("processSecurityQuestion")}}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-sm-12">
                                <label for="email">{{$passwordQuestion->security_question}}</label>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-question"></i></span>
                                        </div>
                                    <input type="hidden" name = "email" value="{{$email}}">
                                        <input class="form-control{{ $errors->has('security_answer') ? ' is-invalid' : '' }}" placeholder="{{ __('Security Answer(Case Sensitive)') }}" type="text" name="security_answer" value="{{ old('security_answer') }}"  autofocus>
                                    </div>
                                    @if ($errors->has('security_answer'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('security_answer') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-primary btn-user" type="submit">
                                   Submit Question
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