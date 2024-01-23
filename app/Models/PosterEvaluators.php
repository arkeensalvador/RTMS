<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosterEvaluators extends Model
{
    use HasFactory;
    protected $table = 'best_poster_evaluators';
    protected $fillable = ['best_poster_id', 'evaluator_name'];
}
