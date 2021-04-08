@extends('layouts.admin')

@section('content')

<div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Add Group Mark</h1>
                        </div>
                        <hr class="badge-danger">
                        <form action="{{route("saveMarkGroup", $group->id)}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('evaluation') ? ' has-danger' : '' }}">
                                            <select class="form-control{{ $errors->has('evaluation') ? ' is-invalid' : '' }}" name="evaluation">
                                                    <option value="">-- Select Evaluation --</option>
                                                    
                                                        @forelse ($evaluations as $evaluation)
                                                            <option value="{{$evaluation->id}}">{{$evaluation->name}}</option>
                                                        @empty
                                                        
                                                        @endforelse
                                                    
                                            </select>
                                        
                                    </div>
                                </div>
                                @if ($errors->has('evaluation'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('evaluation') }}</strong>
                                    </span>
                                @endif

                                <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('achieved_mark') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('achieved_mark') ? ' is-invalid' : '' }}" placeholder="{{ __('Achieved Mark') }}" type="text" name="achieved_mark" value="{{ old('achieved_mark') }}">
                                        </div>
                                    </div>
                                    @if ($errors->has('achieved_mark'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('achieved_mark') }}</strong>
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