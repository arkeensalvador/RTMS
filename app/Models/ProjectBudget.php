<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectBudget extends Model
{
    use HasFactory;
    protected $table = 'project_budget';

    protected $fillable = ['projectID', 'approved_budget', 'budget_year', 'grant_type'];
}
