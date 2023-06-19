<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;
    protected $fillable = [
        'staff_name',
        'leader',
        'assist_leader',
        'role',
        'programID',
        'projectID',
        'subprojectID'
    ];
}
