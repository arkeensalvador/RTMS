<?php

namespace App\Imports;

use App\Models\Projects;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProjectsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Projects([
            'programID' => $row['program_id'],
            'project_fund_code' => $row['project_fund_code'],
            'project_category' => $row['project_category'],
            'project_status' => $row['project_status'],
            'project_agency' => $row['project_agency'],
            'project_funding_duration' => $row['project_funding_duration'],
            'project_funding_years' => $row['project_funding_years'],
            'project_title' => $row['project_title'],
            'project_leader' => $row['project_leader'],
            'project_assistant_leader' => $row['project_assistant_leader'],
            'project_start_date' => $row['project_start_date'],
            'project_end_date' => $row['project_end_date'],
            'project_extend_date' => $row['project_extend_date'],
            'project_description' => $row['project_description'],
            'project_approved_budget' => $row['project_approved_budget'],
            'project_amount_released' => $row['project_amount_released'],
            'project_budget_year' => $row['project_budget_year'],
            'project_form_of_development' => $row['project_form_of_development'],
        ]);
    }
}
