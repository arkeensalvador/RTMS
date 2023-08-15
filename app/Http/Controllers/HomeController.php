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
        $title = 'Home';
        $all = DB::table('agency')
        ->join('users', 'users.agencyID', '=', 'agency.id')
        ->select('users.*', 'agency.*')
        ->get();

        $title = 'List of Reports | RTMS';
        $new = DB::table('programs')->where('program_status', '=', 'new')->pluck('program_status')->count();
        $ongoing = DB::table('programs')->where('program_status', '=', 'on-going')->pluck('program_status')->count();
        $terminated = DB::table('programs')->where('program_status', '=', 'terminated')->pluck('program_status')->count();
        $completed = DB::table('programs')->where('program_status', '=', 'completed')->pluck('program_status')->count();
        // Project
        $new_proj = DB::table('projects')->where('project_status', '=', 'new')->pluck('project_status')->count();
        $ongoing_proj = DB::table('projects')->where('project_status', '=', 'on-going')->pluck('project_status')->count();
        $terminated_proj = DB::table('projects')->where('project_status', '=', 'terminated')->pluck('project_status')->count();
        $completed_proj = DB::table('projects')->where('project_status', '=', 'completed')->pluck('project_status')->count();

        // $agency = DB::table('agency')->get()->pluck("abbrev");
        $data = DB::table('agency')->get();

        foreach($data as $agency) {
            $list[] = $agency->abbrev;
        }

        $total_new = $new + $new_proj;
        $total_ongoing = $ongoing + $ongoing_proj;
        $total_terminated = $terminated + $terminated_proj;
        $total_completed = $completed + $completed_proj;
        return view('backend.layouts.dashboard', ['total_new' => $total_new, 'total_ongoing' => $total_ongoing, 'total_terminated' => $total_terminated, 'total_completed' => $total_completed, 'list' => $list], compact('all','title'));
    }

    
}
