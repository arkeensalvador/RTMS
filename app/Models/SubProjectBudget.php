<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubProjectBudget extends Model
{
    use HasFactory;
    protected $table = 'sub_project_budget';

    protected $fillable = ['projectID', 'sub_projectID', 'approved_budget', 'budget_year', 'grant_type'];
}
