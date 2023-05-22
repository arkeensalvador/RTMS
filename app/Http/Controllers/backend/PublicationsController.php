<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublicationsController extends Controller
{
    //
    public function publicationsIndex() {
        return view('backend.publications.publications_index');
    }
}
