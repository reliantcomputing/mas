@extends('layouts.admin')

@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create Rubric</h1>
                        </div>
                        <hr class="badge-danger">
                        <form action="{{route("saveRubric", $evaluation->id)}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="aspect_to_be_evaluated">Aspect to be evaluated</label>
                                    <div class="form-group{{ $errors->has('aspect_to_be_evaluated') ? ' has-danger' : '' }}">
                                        <textarea class="form-control{{ $errors->has('aspect_to_be_evaluated') ? ' is-invalid' : '' }}" name="aspect_to_be_evaluated" rows="4">{{ old('aspect_to_be_evaluated') }}</textarea>
                                    </div>
                                </div>
                                @if ($errors->has('aspect_to_be_evaluated'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('aspect_to_be_evaluated') }}</strong>
                                    </span>
                                @endif

                                <div class="col-md-6">
                                        <label for="details">Details</label>
                                        <div class="form-group{{ $errors->has('details') ? ' has-danger' : '' }}">
                                            <textarea class="form-control{{ $errors->has('details') ? ' is-invalid' : '' }}" name="details" rows="4">{{ old('details') }}</textarea>
                                        </div>
                                    </div>
                                    @if ($errors->has('details'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('details') }}</strong>
                                        </span>
                                    @endif 
                            </div>
                            <div class="row">
                                    <div class="col-md-12">
                                        <label for="total_mark">Total Mark</label>
                                        <div class="form-group{{ $errors->has('total_mark') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('total_mark') ? ' is-invalid' : '' }}" type="text" name="total_mark" value="{{ old('total_mark') }}">
                                        </div>
                                    </div>
                                    @if ($errors->has('total_mark'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('total_mark') }}</strong>
                                        </span>
                                    @endif
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