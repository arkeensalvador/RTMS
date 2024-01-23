<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubProjects extends Model
{
    use HasFactory;

    protected $fillable = ['projectID', 'sub_project_fund_code', 'sub_project_category', 'sub_project_status', 'sub_project_agency', 'sub_project_implementing_agency', 'sub_project_collaborating_agency', 'sub_project_research_center', 'sub_project_funding_duration', 'sub_project_funding_grant', 'sub_project_title', 'sub_project_leader', 'sub_project_duration', 'sub_project_description', 'sub_project_amount_released', 'sub_project_form_of_development', 'keywords', 'encoder_agency'];
}
