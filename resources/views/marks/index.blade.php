@extends('layouts.admin')

@section('content')

<div class="col-md-12"> 
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    Student Marks
                    <div class="col-md-3 justify-content-end">
                        <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">Generate Report</a>
                    </div>
                </h4>
                <hr>

                <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                        <tr>
                                            <th>Full Names</th>
                                            <th>Last Name</th>
                                            <th>Student Number</th>
                                            <th>Group</th>
                                            <th>Mark(%)</th>
                                        </tr>
                            </thead>
                            <tbody>
                    
                                    @foreach ($students as $student)
                                    <tr>
                                        <td>{{$student->full_name}}</td>
                                        <td>{{$student->surname}}</td>
                                        <td>
                                            {{$student->student_number}}
                                        </td>
                                        <td>
                                            @if ($student->getGroup())
                                                {{$student->getGroup()->name}}
                                            @else
                                                Not Available
                                            @endif
                                        </td>
                                        <td>
                                            @if ($student->studentMark())
                                                {{$student->studentMark()}}
                                            @else
                                                Not Available
                                            @endif
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                    
                            </tbody>
                        </table>
                    </div>
                        @php
                            $all = "ALL";
                            //in between inclusive and exclusive 
                            $inBetweenExclusive = "IN_BETWEEN_EXCLUSIVE";
                            $inBetweenInclusive = "IN_BETWEEN_INCLUSIVE";
                    
                            //greater or less inclusive
                            $greaterThanInclusive = "GREATER_THAN_INCLUSIVE";
                            $lessThanInclusive = "LESS_THAN_INCLUSIVE";
                    
                            //greater or less exclusive
                            $greaterThanExclusive = "GREATER_THAN_EXCLUSIVE";
                            $lessThanExclusive = "LESS_THAN_INCLUSIVE";
                        @endphp
                          
                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Customize Report</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route("print-mark-report")}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="type">File Type</label>
                                            <select name="type" class="form-control">
                                                <option value="PDF">PDF</option>
                                                <option value="Excel">Excel</option>
                                            </select>
                                            <label for="condition">Condition</label>
                                            <select name="condition" class="form-control">
                                                <option value="{{$all}}">All</option>
                                                <option class="in_between" value="{{$inBetweenExclusive}}">In Between Exclusive</option>
                                                <option class="in_between" value="{{$inBetweenExclusive}}">In Between Inclusive</option>
                                                <option class="not_in_between" value="{{$greaterThanExclusive}}">Greater than Exclusive</option>
                                                <option class="not_in_between" value="{{$greaterThanInclusive}}">Greater than Inclusive</option>
                                                <option class="not_in_between" value="{{$lessThanExclusive}}">Less than Exclusive</option>
                                                <option class="not_in_between" value="{{$lessThanInclusive}}">Less than Inclusive</option>
                                            </select>
                                        </div>
                    
                                        <div class="form-group">
                                            <div id="in_between">
                                                <label for="parameter">Parameters</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="number" class= "form-control" name="min" placeholder="Minimum Value">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="number" class= "form-control" name="max" placeholder="Maximum Value">
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="not_in_between">
                                                    <label for="parameter">Parameters</label>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input type="number" class= "form-control" name="value" placeholder="Value">
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                Download
                                            </button>
                                        </div>
                                    </form>
                                </div>
                              </div>
                            </div>
                          </div>
                    
                    
                          <script src = "{{asset("mass/javascripts/jquery/jquery.min.js")}}"></script>
                          <script>
                              $(document).ready(function(){
                    
                                $("select").change(function(){
                                    var selectedValue = $(this).children("option:selected").val();
                                    if(selectedValue == "IN_BETWEEN_EXCLUSIVE" || selectedValue == "IN_BETWEEN_INCLUSIVE"){
                                        $("#in_between").fadeIn();
                                        $("#not_in_between").fadeOut();
                                    }else{
                                        $("#in_between").fadeOut();
                                        $("#not_in_between").fadeIn();
                                    }
                                });
                    
                    
                                $("#in_between").hide();
                                $("#not_in_between").hide();
                            });
                          </script>
            </div>
        </div>        
    </div>

@endsection