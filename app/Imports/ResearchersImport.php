<?php

namespace App\Imports;

use App\Models\Researchers;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ResearchersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Researchers([
            'first_name' => $row['first_name'],
            'middle_name' => $row['middle_name'],
            'last_name' => $row['last_name'],
            'sex' => $row['sex'],
            'contact' => $row['phone_number'],
            'email' => $row['email_address'],
            'agency' => $row['agency'],
            'emp_status' => $row['employment_status'],
            'profile_picture' => 'profile_pictures/default-profile-picture.png',
        ]);
    }
}
