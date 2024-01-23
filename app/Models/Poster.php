<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PosterEvaluators;

class Poster extends Model
{
    use HasFactory;
    protected $table = 'best_poster';
    protected $fillable = ['file_name', 'file_path', 'agency', 'date'];

    public function poster_evaluators()
    {
        return $this->hasMany(PosterEvaluators::class, 'best_poster_id');
    }
}
