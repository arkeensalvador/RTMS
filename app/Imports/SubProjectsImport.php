<?php

namespace App\Imports;

use App\Models\SubProjects;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubProjectsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SubProjects([
            'projectID' => $row['project_id'],
            'sub_project_fund_code' => $row['sub_project_fund_code'],
            'sub_project_category' => $row['sub_project_category'],
            'sub_project_status' => $row['sub_project_status'],
            'sub_project_agency' => $row['sub_project_agency'],
            'sub_project_funding_duration' => $row['sub_project_funding_duration'],
            'sub_project_funding_years' => $row['sub_project_funding_years'],
            'sub_project_title' => $row['sub_project_title'],
            'sub_project_leader' => $row['sub_project_leader'],
            'sub_project_assistant_leader' => $row['sub_project_assistant_leader'],
            'sub_project_start_date' => $row['sub_project_start_date'],
            'sub_project_end_date' => $row['sub_project_end_date'],
            'sub_project_extend_date' => $row['sub_project_extend_date'],
            'sub_project_description' => $row['sub_project_description'],
            'sub_project_approved_budget' => $row['sub_project_approved_budget'],
            'sub_project_amount_released' => $row['sub_project_amount_released'],
            'sub_project_budget_year' => $row['sub_project_budget_year'],
            'sub_project_form_of_development' => $row['sub_project_form_of_development'],
        ]);
    }
}
