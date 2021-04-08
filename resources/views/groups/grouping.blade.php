@extends('layouts.admin')

@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Group Students</h1>
                        </div>
                        <hr class="badge-danger">
                        <form action="{{route("generateGroups")}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('numberOfStudentsInAGroup') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('numberOfStudentsInAGroup') ? ' is-invalid' : '' }}" placeholder="{{ __('Number of students in a group') }}" type="text" name="numberOfStudentsInAGroup" value="{{ old('numberOfStudentsInAGroup') }}">
                                    </div>
                                </div>
                                @if ($errors->has('numberOfStudentsInAGroup'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('numberOfStudentsInAGroup') }}</strong>
                                    </span>
                                @endif
    
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-primary btn-user" type="submit">
                                       Generate
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