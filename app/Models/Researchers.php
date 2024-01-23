<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Researchers extends Model
{
    use HasFactory;

    protected $fillable = ['last_name', 'middle_name', 'first_name', 'sex', 'emp_status', 'contact', 'agency', 'email', 'profile_picture'];

    public function regional()
    {
        return $this->hasOne(RdmcRegional::class, 'regional_researchers');
    }
}
