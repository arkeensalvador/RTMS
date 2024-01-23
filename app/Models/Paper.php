<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Evaluators;

class Paper extends Model
{
    use HasFactory;
    protected $table = 'best_paper'; // Replace with your actual table name
    protected $fillable = ['best_paper', 'best_paper_year', 'best_paper_fa'];

    public function evaluators()
    {
        return $this->hasMany(Evaluators::class, 'best_paper_id');
    }
}
