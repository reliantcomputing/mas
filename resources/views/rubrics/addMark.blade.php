@extends('layouts.admin')

@section('content')
<h3>{{$evaluation->name}}</h3>
<div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                            @if ($rubrics->count() == 0)
                                <h5>Please return back to the group and generate rubric
                                    : <a href="{{route("showGroup", $group)}}">Return to group</a>
                                </h5>
                            @endif
                        @foreach ($rubrics as $rubric)
                            
                            @if ($rubric->subRubrics()->count() != 0)
                                @foreach ($rubric->subRubrics() as $subRubric)
                                    @if ($subRubric->subSubRubrics()->count() != 0)
                                        @foreach ($subRubric->subSubRubrics() as $subSubRubric)
                                        <!-- Start Sub Sub Rubric -->
                                        <form action="{{route("addSubSubRubricMark", $subSubRubric->id)}}" method="post">
                                                <h5>{{$subRubric->aspect_to_be_evaluated}}</h5>
                                                <p>{{$subRubric->details}}</p>
                                                <p><small><b>Total Mark: </b>{{$subSubRubric->total_mark}}</small></p>
                                                <hr class="badge-danger">
                                                @csrf
                                                @if ($subSubRubric->learner_mark == null)
                                                <div class="row">       
                                                        <div class="col-md-6">
                                                            <label for="learner_mark">Learner Mark</label>
                                                                <div class="form-group{{ $errors->has('learner_mark') ? ' has-danger' : '' }}">
                                                                    <input class="form-control{{ $errors->has('learner_mark') ? ' is-invalid' : '' }}" type="number" step=".01" name="learner_mark" value="{{ old('learner_mark') }}">
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('learner_mark'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                    <strong>{{ $errors->first('learner_mark') }}</strong>
                                                                </span>
                                                            @endif
                                                    </div>
                                                    <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="comments"><b>Comments</b></label>
                                                                    <div class="form-group{{ $errors->has('comments') ? ' has-danger' : '' }}">
                                                                        <textarea class="form-control{{ $errors->has('comments') ? ' is-invalid' : '' }}" name="comments" rows="4">{{ old('comments') }}</textarea>
                                                                    </div>
                                                                </div>
                                                                @if ($errors->has('comments'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                        <strong>{{ $errors->first('comments') }}</strong>
                                                                    </span>
                                                                @endif 
                                                        
                                                        </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <button class="btn btn-primary btn-user" type="submit">
                                                            Save Mark
                                                            </button>
                                                        </div>
                                                    </div> 
                                                @else
                                                <div class="row">       
                                                        <div class="col-md-6">
                                                            <label for="learner_mark">Learner Mark</label>
                                                                <div class="form-group{{ $errors->has('learner_mark') ? ' has-danger' : '' }}">
                                                                    <input class="form-control{{ $errors->has('learner_mark') ? ' is-invalid' : '' }}" type="number" step=".01" name="learner_mark" value="{{ $subSubRubric->learner_mark}}">
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('learner_mark'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                    <strong>{{ $errors->first('learner_mark') }}</strong>
                                                                </span>
                                                            @endif
                                                    </div>
                                                    <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="comments"><b>Comments</b></label>
                                                                    <div class="form-group{{ $errors->has('comments') ? ' has-danger' : '' }}">
                                                                        <textarea class="form-control{{ $errors->has('comments') ? ' is-invalid' : '' }}" name="comments" rows="4">{{ $subSubRubric->comments }}</textarea>
                                                                    </div>
                                                                </div>
                                                                @if ($errors->has('comments'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                        <strong>{{ $errors->first('comments') }}</strong>
                                                                    </span>
                                                                @endif 
                                                        
                                                        </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <button class="btn btn-danger btn-user" type="submit">
                                                                Update Mark
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
                                                

                                            </form> 
                                            <!-- end Sub Sub Rubric -->
                                            <br>                                           
                                        @endforeach
                                    @else
                                    <!-- start sub rubric to zero -->
                                    
                                    <form action="{{route("addSubRubricMark", $subRubric->id)}}" method="post">
                                            <h5>{{$subRubric->aspect_to_be_evaluated}}</h5>
                                            <p>{{$subRubric->details}}</p>
                                            <p><small><b>Total Mark: </b>{{$subRubric->total_mark}}</small></p>
                                            <hr class="badge-danger">
                                            @csrf
                                            @if ($subRubric->learner_mark == null)
                                            <div class="row">       
                                                    <div class="col-md-6">
                                                        <label for="learner_mark">Learner Mark</label>
                                                            <div class="form-group{{ $errors->has('learner_mark') ? ' has-danger' : '' }}">
                                                                <input class="form-control{{ $errors->has('learner_mark') ? ' is-invalid' : '' }}" type="number" step=".01" name="learner_mark" value="{{ old('learner_mark') }}">
                                                            </div>
                                                        </div>
                                                        @if ($errors->has('learner_mark'))
                                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('learner_mark') }}</strong>
                                                            </span>
                                                        @endif
                                                </div>
                                                <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="comments"><b>Comments</b></label>
                                                                <div class="form-group{{ $errors->has('comments') ? ' has-danger' : '' }}">
                                                                    <textarea class="form-control{{ $errors->has('comments') ? ' is-invalid' : '' }}" name="comments" rows="4">{{ old('comments') }}</textarea>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('comments'))
                                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                                    <strong>{{ $errors->first('comments') }}</strong>
                                                                </span>
                                                            @endif 
                                                    
                                                    </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <button class="btn btn-primary btn-user" type="submit">
                                                           Save Mark
                                                        </button>
                                                    </div>
                                                </div> 
                                            @else
                                            <div class="row">       
                                                    <div class="col-md-6">
                                                            <label for="learner_mark"><b>Learner Mark</b></label>
                                                            <div class="form-group{{ $errors->has('learner_mark') ? ' has-danger' : '' }}">
                                                                <input class="form-control{{ $errors->has('learner_mark') ? ' is-invalid' : '' }}" type="number" step=".01" name="learner_mark" value="{{ $subRubric->learner_mark }}">
                                                            </div>
                                                        </div>
                                                        @if ($errors->has('learner_mark'))
                                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('learner_mark') }}</strong>
                                                            </span>
                                                        @endif
                                                </div>
                                                <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="comments"><b>Comments</b></label>
                                                                <div class="form-group{{ $errors->has('comments') ? ' has-danger' : '' }}">
                                                                    <textarea class="form-control{{ $errors->has('comments') ? ' is-invalid' : '' }}" name="comments" rows="4">{{ $subRubric->comments }}</textarea>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('comments'))
                                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                                    <strong>{{ $errors->first('comments') }}</strong>
                                                                </span>
                                                            @endif 
                                                    
                                                    </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <button class="btn btn-danger btn-user" type="submit">
                                                           Update Mark
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                        </form> 
                                        <!-- end sub rubric -->
                                        <br>                                        
                                    @endif
                                @endforeach
                            @else
                            <!-- if rubric is not equal to zero -->
                            <form action="{{route("addRubricMark", $rubric->id)}}" method="post">
                                    <h5>{{$rubric->aspect_to_be_evaluated}}</h5>
                                    <p>{{$rubric->details}}</p>
                                    <p><small><b>Total Mark: </b>{{$rubric->total_mark}}</small></p>
                                    <hr class="badge-danger">
                                    @csrf
                                    @if ($rubric->learner_mark == null)
                                    <div class="row">       
                                            <div class="col-md-6">
                                                    <label for="learner_mark"><b>Learner Mark</b></label>
                                                    <div class="form-group{{ $errors->has('learner_mark') ? ' has-danger' : '' }}">
                                                        <input class="form-control{{ $errors->has('learner_mark') ? ' is-invalid' : '' }}" type="number" step=".01" name="learner_mark" value="{{ old('learner_mark') }}">
                                                    </div>
                                                </div>
                                                @if ($errors->has('learner_mark'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('learner_mark') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                        <div class="row">
                                                <div class="col-md-6">
                                                    <label for="comments"><b>Comments</b></label>
                                                        <div class="form-group{{ $errors->has('comments') ? ' has-danger' : '' }}">
                                                            <textarea class="form-control{{ $errors->has('comments') ? ' is-invalid' : '' }}" name="comments" rows="4">{{ old('comments') }}</textarea>
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('comments'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('comments') }}</strong>
                                                        </span>
                                                    @endif 
                                            
                                            </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-primary btn-user" type="submit">
                                                   Save Mark
                                                </button>
                                            </div>
                                        </div>
                                    @else
                                    <div class="row">       
                                            <div class="col-md-6">
                                                <label for="learner_mark">Learner Mark</label>
                                                    <div class="form-group{{ $errors->has('learner_mark') ? ' has-danger' : '' }}">
                                                        <input class="form-control{{ $errors->has('learner_mark') ? ' is-invalid' : '' }}" type="number" step=".01" name="learner_mark" value="{{ $rubric->learner_mark }}">
                                                    </div>
                                                </div>
                                                @if ($errors->has('learner_mark'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('learner_mark') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                        <div class="row">
                                                <div class="col-md-6">
                                                    <label for="comments"><b>Comments</b></label>
                                                        <div class="form-group{{ $errors->has('comments') ? ' has-danger' : '' }}">
                                                            <textarea class="form-control{{ $errors->has('comments') ? ' is-invalid' : '' }}" name="comments" rows="4">{{ $rubric->comments }}</textarea>
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('comments'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('comments') }}</strong>
                                                        </span>
                                                    @endif 
                                            
                                            </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-danger btn-user" type="submit">
                                                   Update Mark
                                                </button>
                                            </div>
                                        </div>
                                    @endif
            
                                </form> 
                                <br>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection