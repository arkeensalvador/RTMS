<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResearcherController extends Controller
{
    public function researcherIndex()
    {
        return view('backend.researcher.researcher_index');
    }
    public function researcherAdd()
    {
        return view('backend.researcher.researcher_add');
    }
}
