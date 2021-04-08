@extends('layouts.admin')

@section('content')
    
<div class="col-md-12"> 
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                        <div class="row">
                                <div class="col-md-9">
                                    <h4><i class="fa fa-users"></i>
                                        Groups
                                        <a href="{{route("createGroup")}}" class="btn-primary btn-sm">
                                            <i class="fa fa-plus"></i>
                                            Add
                                        </a>
                                        &nbsp;
                                        <a href="{{route("deleteAllGroups")}}" class="btn-danger btn-sm"
                                        onclick="return confirm(confirmDelete('Are you sure you want to delete all groups?'))">
                                            <i class="fa fa-trash"></i>
                                            Delete All
                                        </a>
                                    </h4>
                                </div>
                                <div class="col-md-3 justify-content-end">
                                    <a class="btn btn-sm btn-primary shadow-sm mr-2" href="{{route("callGroupView")}}">
                                        <i class="fas fa-upload fa-sm text-white"></i>
                                        Generate
                                    </a>
                                </div>
                            </div>
                </div>
                <hr>
                <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Group Name</th>
                                <th>#Students</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                    
                                @forelse ($groups as $group)
                                <tr>
                                        <td>{{$group->name}}</td>
                                        <td>
                                            {{$group->groupStudents($group->id)->count()}}
                                        </td>
                        
                                        <td>
                                            <a class="btn btn-success btn-sm" href="{{route("showGroup", $group->id)}}">
                                                View
                                            </a>
                                            
                                            <a class="btn btn-primary btn-sm" href="{{route("editGroup", $group->id)}}">
                                                Edit
                                            </a>
                                            
                                            <a class="btn btn-danger btn-sm" onclick="return confirm(confirmDelete('group: ${group.groupName}'))" href="{{route("deleteGroup", $group->id)}}">
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