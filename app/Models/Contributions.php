<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contributions extends Model
{
    use HasFactory;
    protected $table = 'cbg_contributions';
    protected $fillable = [
        'con_name',
        'con_amount'
    ];
}
