<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programs extends Model
{
    use HasFactory;

    public $fillable = ['programID', 'fund_code', 'program_title', 'program_status', 'program_category', 'funding_agency', 'implementing_agency', 'collaborating_agency', 'research_center', 'duration', 'program_leader', 'program_description', 'amount_released', 'form_of_development', 'keywords', 'encoder_agency'];
}
