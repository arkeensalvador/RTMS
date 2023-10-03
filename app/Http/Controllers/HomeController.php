<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

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
        $title = 'Dashboard';
        $all = DB::table('agency')
            ->join('users', 'users.agencyID', '=', 'agency.id')
            ->select('users.*', 'agency.*')
            ->get();

        // $title = 'List of Reports | RTMS';
        $new = DB::table('programs')->where('program_status', '=', 'new')->pluck('program_status')->count();
        $ongoing = DB::table('programs')->where('program_status', '=', 'on-going')->pluck('program_status')->count();
        $terminated = \Illuminate\Support\Facades\DB::table('programs')->where('program_status', '=', 'terminated')->pluck('program_status')->count();
        $completed = DB::table('programs')->where('program_status', '=', 'completed')->pluck('program_status')->count();
        // Project
        $new_proj = DB::table('projects')->where('project_status', '=', 'new')->pluck('project_status')->count();
        $ongoing_proj = DB::table('projects')->where('project_status', '=', 'on-going')->pluck('project_status')->count();
        $terminated_proj = DB::table('projects')->where('project_status', '=', 'terminated')->pluck('project_status')->count();
        $completed_proj = DB::table('projects')->where('project_status', '=', 'completed')->pluck('project_status')->count();

        $data_agency = DB::table('agency')->get();

        // foreach ($data_agency as $agency) {
        //     $list[] = $agency->abbrev;
        // }
        // $agency = $list;

        $total_new = $new + $new_proj;
        $total_ongoing = $ongoing + $ongoing_proj;
        $total_terminated = $terminated + $terminated_proj;
        $total_completed = $completed + $completed_proj;

        // $awards_count = DB::table('cbg_awards')->count();
        
        $total_programs = DB::table('programs')->count();
        $total_projects = DB::table('projects')->count();
        $total_sub_projects = DB::table('sub_projects')->count();
        $total_researchers = DB::table('researchers')->count();

        $data = DB::table('users')->select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
            ->groupBy('month_name')
            ->orderBy('count')
            ->get();

        $datas = DB::table('cbg_awards')->select(DB::raw("COUNT(*) as count"), DB::raw("awards_agency as agency_awards"))
            ->groupBy('agency_awards')
            ->orderBy('count')
            ->get();

        foreach ($datas as $awards) {
            $count[] = $awards->count;
            $agency_a[] = $awards->agency_awards;
        }

        $progs = DB::table('programs')->select(DB::raw("COUNT(*) as count_p"), DB::raw("funding_agency as program_agency"))
            ->groupBy('program_agency')
            ->orderBy('count_p')
            ->get();

        foreach ($progs as $progams) {
            $program_count[] = $progams->count_p;
            $progams_a[] = $progams->program_agency;
        }

        $projs = DB::table('projects')->select(DB::raw("COUNT(*) as count_proj"), DB::raw("project_agency as project_agency"))
            ->groupBy('project_agency')
            ->orderBy('count_proj')
            ->get();

        foreach ($projs as $projects) {
            $project_count[] = $projects->count_proj;
            $project_a[] = $projects->project_agency;
        }

        $researchers = DB::table('researchers')->join('agency', 'agency.abbrev', '=', 'researchers.agency')
        ->select(DB::raw('count(*) as count_res'), DB::raw('agency.abbrev as abbrev'))
        ->groupBy('abbrev')
        ->get();

        foreach ($researchers as $res) {
            $res_count[] = $res->count_res;
            $res_agency[]= $res->abbrev;
        }
        
        
 
        // $shops = DB::table('shops')
        // ->join('products', 'products.shop_id', '=', 'shops.id')
        // ->select('shops.id as id', DB::raw("count(products.id) as count"))
        // ->groupBy('shops.id')
        // ->get();
        
        return view('backend.layouts.dashboard', [
            'total_new' => $total_new, 'total_ongoing' => $total_ongoing, 'total_terminated' => $total_terminated,
            'total_completed' => $total_completed, 'agency_awards' => $agency_a, 'count' => $count, 'count_p' => $program_count, 
            'program_agency' => $progams_a, 'count_proj' => $project_count, 'count_res' => $res_count, 'abbrev' => $res_agency
        ], compact('all', 'title', 'data', 'datas', 'progs', 'data_agency', 'projs', 'total_programs', 'total_projects', 'total_sub_projects','total_researchers', 'researchers'));
    }
}
