<?php

namespace App\Imports;

use App\Models\Agency;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AgencyImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Agency([
            'agency_name' => $row['agency_name'],
            'abbrev' => $row['abbrev'],
        ]);
    }
}
