<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Initiatives extends Model
{
    use HasFactory;

    protected $table = 'cbg_initiatives';

    protected $fillable = ['ini_initiates', 'ini_agency', 'ini_date'];
}
