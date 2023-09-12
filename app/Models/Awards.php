<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Awards extends Model
{
    protected $table = 'cbg_awards';

    use HasFactory;
    protected $fillable = [
        'awards_type', 'awards_agency', 'awards_title', 'awards_recipients', 'awards_sponsor', 'awards_event', 'awards_place', 'awards_date'
    ];
}
