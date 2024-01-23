<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    protected $fillable = ['programID', 'project_fund_code', 'project_category', 'project_status', 'project_agency', 'project_implementing_agency', 'project_collaborating_agency', 'project_research_center', 'project_funding_duration', 'project_funding_grant', 'project_funding_years', 'project_title', 'project_leader', 'project_duration', 'project_description', 'project_amount_released', 'project_form_of_development', 'keywords', 'encoder_agency'];
}
