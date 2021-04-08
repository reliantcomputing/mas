@extends('layouts.admin')

@section('content')
    



<div class="row">
    <div class="col-md-9">
        <h4>
            Choose evaluation to create rubric.
        </h4>
    </div>
</div>

<hr class="bg-danger">

<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>Evaluation Name</th>
            <th>Total Mark</th>
        </tr>
        </thead>
        <tbody>

            @forelse ($evaluations as $evaluation)
            <tr>
                    <td>
                        <h6>
                        <a href="{{route("viewRubric", $evaluation->id)}}">
                                {{$evaluation->name}}
                            </a>
                        </h6>
                    </td>
                    <td>
                        {{$evaluation->total_mark}}
                    </td>

                </tr> 
            @empty
            @endforelse

        </tbody>
    </table>
</div>
@endsection