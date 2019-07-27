<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResultsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Reg No',
            'Name',
            'Total Marks',
        ];
    }

    public function collection()
    {
        return  DB::table('users')
        		->join('results', 'users.id', '=', 'results.user_id')
        		->select('users.userId', 'users.name', 'results.total')
        		->get();
    }
}
