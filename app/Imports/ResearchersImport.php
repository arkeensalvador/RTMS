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
            'name' => $row['name'],
            'gender' => $row['gender'],
            'contact' => $row['contact'],
            'email' => $row['email'],
            'agency' => $row['agency'],
        ]);
    }
}
