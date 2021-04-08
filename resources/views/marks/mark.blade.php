<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task Printing</title>
    <style>
            table {
              font-family: arial, sans-serif;
              border-collapse: collapse;
              width: 100%;
              border: 1px solid #dddddd;
            }
            th, td{
                border: 1px solid #dddddd; 
            }
            
            body{
                font-family: arial, sans-serif;
            }
        </style>
</head>
<body>
    <h2>{{$title}}</h2>
    <br>
    
                <table>
                    <tr>
                        <th><b>Full Names</b></th>
                        <th><b>Last Name</b></th>
                        <th><b>Student Number</b></th>
                        <th><b>Group</b></th>
                        <th><b>Mark(%)</b></th>
                    </tr>
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
                        {{$student->price}}</td>
                    <td>
                        @if ($student->studentMark())
                            {{$student->studentMark()}}
                        @else
                            Not Available
                        @endif
                        
                    </td>
                </tr>
                @endforeach
            </table>
</body>
</html>