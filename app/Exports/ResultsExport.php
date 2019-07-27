<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use App\Result;
use Auth;
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
            'Department',
            'Total Marks',
        ];
    }

    public function collection()
    {

        $getData = DB::table('users')
                ->join('results', 'users.id', '=', 'results.user_id')
                ->select('users.userId', 'users.name', 'users.department', 'results.total')
                ->get();

        foreach ($getData as $key => $data) {
            if ($data->department == Auth::user()->department) {
                $result[] = $data;
            }
        }
        $result = collect($result);
        return $result;
    }
}
