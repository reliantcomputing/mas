<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StudentsExport implements FromView, ShouldAutoSize
{
    public $title;
    public $students;
    public function __construct($title, $students)
    {
        $this->title = $title;
        $this->students = $students;
    }

    public function view(): View
    {
        return view('marks.mark', [
            'students' => $this->students,
            'title' => $this->title,
        ]);
    }
}
