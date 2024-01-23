<?php

namespace App\Imports;

use App\Models\SubProjects;
use App\Models\Researchers;
use App\Models\SubProjectBudget;
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
        $project = [
            'projectID' => $row['project_id'],
            'sub_project_fund_code' => $row['sub_project_fund_code'],
            'sub_project_category' => $row['sub_project_category'],
            'sub_project_status' => $row['sub_project_status'],
            'sub_project_agency' => $row['sub_project_funding_agency'],
            'sub_project_collaborating_agency' => $row['sub_project_collaborating_agency'],
            'sub_project_implementing_agency' => $row['sub_project_implementing_agency'],
            'sub_project_research_center' => $row['sub_project_research_center'],
            'sub_project_duration' => $row['sub_project_duration'],
            'sub_project_funding_grant' => $row['sub_project_funding_grant'],
            'sub_project_title' => $row['sub_project_title'],
            'sub_project_duration' => $row['sub_project_duration'],
            'sub_project_description' => $row['sub_project_description'],
            'sub_project_amount_released' => $row['sub_project_amount_released'],
            'sub_project_form_of_development' => $row['sub_project_form_of_development'],
            'encoder_agency' => auth()->user()->agencyID,
            'keywords' => $row['keywords'],
        ];

        // Find the researcher based on the extracted name
        $researcher = Researchers::where([['first_name', $row['sub_project_leader_fname']], ['middle_name', $row['sub_project_leader_mname']], ['last_name', $row['sub_project_leader_lname']]])->first();

        // Check if a researcher is found
        if ($researcher) {
            // Update 'project_leader' in your project data with the researcher ID
            $project['sub_project_leader'] = $researcher->id;

            // Insert or update the project data in the Programs table
            $record1 = SubProjects::create($project);

            // Additional code for handling Budget creation if needed
            $budget = [
                'projectID' => $row['project_id'],
                'sub_projectID' => $record1->id,
                'approved_budget' => $row['sub_project_approved_budget'],
                'budget_year' => $row['sub_project_budget_year'],
                'grant_type' => $row['sub_project_funding_grant'],
                'created_at' => now(),
            ];

            // Assuming there's a Budget model
            $record2 = SubProjectBudget::create($budget);

            if ($record1 && $record2) {
                alert('Import Success');
            }
        } else {
            // Handle the case where the researcher with the specified name is not found
            // You might want to log an error or handle it according to your application logic
            alert('Researcher not found');
        }
    }
}
