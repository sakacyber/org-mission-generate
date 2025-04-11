<?php

namespace App\Exports;

use App\Models\Mission;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MissionsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Mission::select('id', 'goal', 'start_date', 'end_date', 'signature_date', 'persion_id')->get();
    }

    public function headings(): array
    {
        return ['Id', 'Goal', 'Start Date','End Date', 'Signature Date', 'Persion Id'];
    }
}
