<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Researchers extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'contact',
        'email',
        'agency',
        'image'
    ];
}
