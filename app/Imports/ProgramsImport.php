<?php

namespace App\Imports;

use App\Models\Programs;
use App\Models\Budget;
use App\Models\Researchers;
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
        $program = [
            'programID' => substr(md5(microtime()), 0, 10),
            'fund_code' => $row['fund_code'],
            'program_title' => $row['program_title'],
            'program_status' => $row['program_status'],
            'program_category' => $row['program_category'],
            'funding_agency' => $row['funding_agency'],
            'implementing_agency' => $row['implementing_agency'],
            'collaborating_agency' => $row['collaborating_agency'],
            'research_center' => $row['research_center'],
            'duration' => $row['duration'],
            'program_description' => $row['program_description'],
            'amount_released' => $row['amount_released'],
            'form_of_development' => $row['form_of_development'],
            'encoder_agency' => auth()->user()->agencyID,
            'keywords' => $row['keywords'],
        ];

        // Find the researcher based on the extracted name
        $researcher = Researchers::where([['first_name', $row['program_leader_fname']], ['middle_name', $row['program_leader_mname']], ['last_name', $row['program_leader_lname']]])->first();

        // Check if a researcher is found
        if ($researcher) {
            // Update 'program_leader' in your program data with the researcher ID
            $program['program_leader'] = $researcher->id;

            // Insert or update the program data in the Programs table
            $record1 = Programs::create($program);

            // Additional code for handling Budget creation if needed
            $budget = [
                'programID' => $record1->programID,
                'approved_budget' => $row['approved_budget'],
                'budget_year' => $row['budget_year'],
                'created_at' => now(),
            ];

            // Assuming there's a Budget model
            $record2 = Budget::create($budget);

            if ($record1 && $record2) {
                alert('Import Success');
            }
        } else {
            // Handle the case where the researcher with the specified name is not found
            // You might want to log an error or handle it according to your application logic
            alert('Researcher not found for program leader');
        }
    }
}
