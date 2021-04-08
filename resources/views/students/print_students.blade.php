<h4>DSO34 Students</h4>

<table>
        <thead>
        <tr>
            <th>Full Name</th>
            <th>Surname</th>
            <th>Student Number</th>
            <th>ID Number</th>
            <th>Email</th>
            <th>Group</th>
        </tr>
        </thead>
        <tbody>

            @forelse ($students as $student)
            <tr>
                    <td>{{$student->full_name}}</td>
                    <td>{{$student->surname}}</td>
                    <td>
                        {{$student->student_number}}
                    </td>

                    <td>
                        {{$student->id_number}}
                    </td>

                    <td>
                        {{$student->email}}
                    </td>

                    <td>
                        @if ($student->getGroup())
                            {{$student->getGroup()->name}}
                        @else 
                            Not allocated
                        @endif
                    </td>
                </tr> 
            @empty
            @endforelse

        </tbody>
    </table>