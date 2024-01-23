<?php

namespace App\Imports;

use App\Models\User;
use Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

/**
 * Summary of UsersImport
 */
class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        $user = new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'agencyID' => $row['agency'],
            'role' => $row['role'],
            'password' => Hash::make($row['password']),
        ]);

        return $user;
    }
}
