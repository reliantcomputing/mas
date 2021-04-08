@extends('layouts.admin')

@section('content')
    



<div class="row">
    <div class="col-md-12">
        <p>
            <b>Sub Sub Rubrics</b>
        </p>
        <p>
            {{$subRubric->aspect_to_be_evaluated}}          
        </p>
        <a href="{{route("createSubSubRubric", $subRubric->id)}}" class="btn-success btn-sm">
            <i class="fa fa-plus"></i>
            Add Sub Sub Rubric
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

            @forelse ($subSubRubrics as $subSubRubric)
            <tr>
                    <td>{{$subSubRubric->aspect_to_be_evaluated}}</td>
                    <td>{{$subSubRubric->details}}</td>
                    <td>
                        {{$subSubRubric->total_mark}}
                    </td>
    
                    <td>
                        <a class="btn btn-primary btn-sm" href="">
                                <i class="fa fa-edit"></i>
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