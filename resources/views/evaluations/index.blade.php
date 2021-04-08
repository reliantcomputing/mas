@extends('layouts.admin')

@section('content')

    <div class="col-md-12"> 
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fa fa-user"></i>
                    Evaluations
                    <a href="{{route("createEvaluation")}}" class="btn-danger btn-sm">
                        <i class="fa fa-plus"></i>
                    </a>
                </h4>
                <hr>
                <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Evaluation Name</th>
                                <th>Total Mark</th>
                                <th>Total Percentage(%)</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                    
                                @forelse ($evaluations as $evaluation)
                                <tr>
                                        <td>{{$evaluation->name}}</td>
                                        <td>
                                            {{$evaluation->total_mark}}
                                        </td>
                    
                                        <td>{{$evaluation->total_percentage}}</td>
                        
                                        <td>
                                            <a class="btn btn-success btn-sm" href="{{route("editEvaluation", $evaluation->id)}}">
                                                Edit
                                            </a>
                                            
                                        <a class="btn btn-danger btn-sm" onclick="return confirm(confirmDelete('Are you sure you want this {{$evaluation->name}}?'))" href="{{route("deleteEvaluation", $evaluation->id)}}">
                                                delete
                                            </a>
                                        </td>
                                    </tr> 
                                @empty
                                @endforelse
                    
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>        
    </div>
@endsection