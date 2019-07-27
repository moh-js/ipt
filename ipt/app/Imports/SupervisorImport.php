<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SupervisorImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
            $user =  new User([
            'userId'     => $row['id'],
            'name'       => $row['name'],
            'email'      => $row['email'],
            'img'        => $row['image'],
            'department' => $row['department'],
            'password'   => bcrypt($row['password']),
        ]);

        $user->assignRole('supervisor');

        return $user;
    }
}
