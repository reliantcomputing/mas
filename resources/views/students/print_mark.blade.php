<div class="row">
    <div class="col-md-9">
        <h2>
        Marks For <br>
        <small>{{$student->full_name}} {{$student->surname}}</small> <br>
        <small>{{$student->student_number}}</small>
        </h2>
    </div>
</div>

<hr class="bg-danger">

<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>Evaluation</th>
            
            <th>Achived Mark</th>
            <th>Total Mark</th>
        </tr>
        </thead>
        <tbody>

            @forelse ($student_marks as $student_mark)
            <tr>
                    <td>{{$student_mark->evaluation->name}}</td>
                    <td>
                        {{$student_mark->mark}}
                    </td>
                    <td>
                        {{$student_mark->evaluation->total_mark}}
                    </td>
                    
                </tr> 
            @empty
            @endforelse

        </tbody>
    </table>
</div>    