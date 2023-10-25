<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programs extends Model
{
    use HasFactory;

    public $fillable = [
        'programID',
        'fund_code',
        'program_title',
        'program_status',
        'program_category',
        'funding_agency',
        'coordination_fund',
        'start_date',
        'end_date',
        'extend_date',
        'program_leader',
        'assistant_leader',
        'program_description',
        'approved_budget',
        'amount_released',
        'budget_year',
        'form_of_development'
    ];
}
