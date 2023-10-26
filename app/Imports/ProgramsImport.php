<?php

namespace App\Imports;

use App\Models\Programs;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProgramsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {

        return new Programs([
            'programID' => substr(md5(microtime()), 0, 10),
            'fund_code' => $row['fund_code'],
            'program_title' => $row['program_title'],
            'program_status' => $row['program_status'],
            'program_category' => $row['program_category'],
            'funding_agency' => $row['funding_agency'],
            'implementing_agency' => $row['implementing_agency'],
            'research_center' => $row['research_center'],
            'start_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['start_date'])->format('Y-m-d'),
            'end_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['end_date'])->format('Y-m-d'),
            // 'extend_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['extend_date'])->format('Y-m-d'),
            'program_leader' => $row['program_leader'],
            'assistant_leader' => $row['assistant_leader'],
            'program_description' => $row['program_description'],
            'approved_budget' => $row['approved_budget'],
            'amount_released' => $row['amount_released'],
            'budget_year' => $row['budget_year'],
            'form_of_development' => $row['form_of_development'],
            'keywords' => $row['keywords']
        ]);
    }
}
