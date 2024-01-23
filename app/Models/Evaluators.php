<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluators extends Model
{
    use HasFactory;
    protected $table = 'best_paper_evaluators';
    protected $fillable = ['best_paper_id', 'evaluator_name'];
}
