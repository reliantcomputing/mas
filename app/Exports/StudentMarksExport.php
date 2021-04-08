<?php

namespace App\Exports;

use App\StudentMark;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentMarksExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return StudentMark::all();
    }
}
