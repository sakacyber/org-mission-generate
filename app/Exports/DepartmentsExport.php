<?php

namespace App\Exports;

use App\Models\Department;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DepartmentsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Department::select('id', 'name', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['Id', 'Name', 'Date created'];
    }
}
