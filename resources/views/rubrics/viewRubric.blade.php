@extends('layouts.admin')

@section('content')
    



<div class="row">
        <div class="col-md-12">
            <p><b>Rubrics</b></p>
            <p>
                <b>Evaluation: </b>{{$evaluation->name}}            
            </p>
            <a href="{{route("createRubric", $evaluation->id)}}" class="btn-success btn-sm">
                <i class="fa fa-plus"></i>
                Add Rubric
            </a>
        </div>
    </div>

<hr class="bg-danger">

<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>Aspect to be evaluted</th>
            <th>Details</th>
            <th>Total Mark</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

            @forelse ($rubrics as $rubric)
            <tr>
                    <td>
                        <a href="{{route("viewSubRubric", $rubric->id)}}">
                            {{$rubric->aspect_to_be_evaluated}}
                        </a>
                        
                    </td>
                    <td>{{$rubric->details}}</td>
                    <td>
                        {{$rubric->total_mark}}
                    </td>
    
                    <td>
                            <a class="btn btn-primary btn-sm" href="{{route("editRubric", $rubric->id)}}">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                               
                            <a class="btn btn-danger btn-sm" onclick="return confirm(confirmDelete('Are you sure you want this ?'))" href="">
                                <i class="fa fa-trash"></i>
                            </a>
                    </td>
                </tr> 
            @empty
            @endforelse

        </tbody>
    </table>
</div>
@endsection