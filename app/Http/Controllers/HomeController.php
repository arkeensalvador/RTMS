<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all = DB::table('agency')
        ->join('users', 'users.agencyID', '=', 'agency.id')
        ->select('users.*', 'agency.*')
        ->get();
        return view('backend.layouts.dashboard', compact('all'));
    }
}
