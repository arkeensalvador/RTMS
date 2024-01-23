<?php

namespace App\Imports;

use App\Models\Projects;
use App\Models\Researchers;
use App\Models\ProjectBudget;
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
        $project = [
            'programID' => $row['program_id'],
            'project_fund_code' => $row['project_fund_code'],
            'project_category' => $row['project_category'],
            'project_status' => $row['project_status'],
            'project_agency' => $row['project_funding_agency'],
            'project_collaborating_agency' => $row['project_collaborating_agency'],
            'project_implementing_agency' => $row['project_implementing_agency'],
            'project_research_center' => $row['project_research_center'],
            'project_duration' => $row['project_duration'],
            'project_funding_grant' => $row['project_funding_grant'],
            'project_title' => $row['project_title'],
            'project_duration' => $row['project_duration'],
            'project_description' => $row['project_description'],
            'project_amount_released' => $row['project_amount_released'],
            'project_form_of_development' => $row['project_form_of_development'],
            'encoder_agency' => auth()->user()->agencyID,
            'keywords' => $row['keywords'],
        ];

        // Find the researcher based on the extracted name
        $researcher = Researchers::where([['first_name', $row['project_leader_fname']], ['middle_name', $row['project_leader_mname']], ['last_name', $row['project_leader_lname']]])->first();

        // Check if a researcher is found
        if ($researcher) {
            // Update 'project_leader' in your project data with the researcher ID
            $project['project_leader'] = $researcher->id;

            // Insert or update the project data in the Programs table
            $record1 = Projects::create($project);

            // Additional code for handling Budget creation if needed
            $budget = [
                'projectID' => $record1->id,
                'approved_budget' => $row['project_approved_budget'],
                'budget_year' => $row['project_budget_year'],
                'grant_type' => $row['project_funding_grant'],
                'created_at' => now(),
            ];

            // Assuming there's a Budget model
            $record2 = ProjectBudget::create($budget);

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
