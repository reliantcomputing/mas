@extends('layouts.admin')

@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create Evaluation</h1>
                        </div>
                        <hr class="badge-danger">
                        <form action="{{route("saveEvaluation")}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Evaluation Name') }}" type="text" name="name" value="{{ old('name') }}">
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                

                                <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('total_mark') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('total_mark') ? ' is-invalid' : '' }}" placeholder="{{ __('Total Mark') }}" type="number" step=".01" name="total_mark" value="{{ old('total_mark') }}">
                                        </div>
                                        @if ($errors->has('total_mark'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('total_mark') }}</strong>
                                            </span>
                                        @endif
                                </div>

                            </div>

                            <div class="row">
                                    <div class="col-md-12">
                                            <div class="form-group{{ $errors->has('total_percentage') ? ' has-danger' : '' }}">
                                                <input class="form-control{{ $errors->has('total_percentage') ? ' is-invalid' : '' }}" placeholder="{{ __('Total Percentage') }}" type="number" step=".01" name="total_percentage" value="{{ old('total_percentage') }}">
                                            </div>
                                            @if ($errors->has('total_percentage'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('total_percentage') }}</strong>
                                                </span>
                                            @endif
                                    </div>
    
                                </div>
                                    
    
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