<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MarkerImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user =  new User([
            'userId'    => $row['id'],
            'name'      => $row['name'],
            'email'     => $row['email'],
            'img'       => $row['image'],
            'phone'     => $row['phone'],
            'department'=> $row['department'],
            'password'  => bcrypt($row['password']),
        ]);

        $user->assignRole('marker');

        return $user;
    }
}
