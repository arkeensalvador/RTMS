<?php

namespace App\Http\Controllers;

use App\Models\Agency;
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

        // CMI DASHBOARD 
        $user_agency = DB::table('users')->where('agencyID', auth()->user()->agencyID)->first();
        $total_programs_count_filter = DB::table('programs')->where('implementing_agency', 'LIKE', '%' . auth()->user()->agencyID . '%')->count();
        $total_projects_filter = DB::table('projects')->where('project_implementing_agency', 'LIKE', '%' . auth()->user()->agencyID . '%')->count();
        $total_sub_projects_filter = DB::table('sub_projects')->where('sub_project_implementing_agency', 'LIKE', '%' . auth()->user()->agencyID . '%')->count();
        $total_researchers_filter = DB::table('researchers')->where('agency', auth()->user()->agencyID)->count();
        // END CMI DASHBOARD

        // Program
        $new = DB::table('programs')->where('program_status', '=', 'new')->count();
        $ongoing = DB::table('programs')->where('program_status', '=', 'ongoing')->count();
        $terminated = DB::table('programs')->where('program_status', '=', 'terminated')->count();
        $completed = DB::table('programs')->where('program_status', '=', 'completed')->count();
        // Project
        $new_proj = DB::table('projects')->where('project_status', '=', 'new')->count();
        $ongoing_proj = DB::table('projects')->where('project_status', '=', 'ongoing')->count();
        $terminated_proj = DB::table('projects')->where('project_status', '=', 'terminated')->count();
        $completed_proj = DB::table('projects')->where('project_status', '=', 'completed')->count();
        // Sub-Project
        $new_subproj = DB::table('sub_projects')->where('sub_project_status', '=', 'new')->count();
        $ongoing_subproj = DB::table('sub_projects')->where('sub_project_status', '=', 'ongoing')->count();
        $terminated_subproj = DB::table('sub_projects')->where('sub_project_status', '=', 'terminated')->count();
        $completed_subproj = DB::table('sub_projects')->where('sub_project_status', '=', 'completed')->count();

        $data_agency = DB::table('agency')->get();

        $total_new = $new + $new_proj + $new_subproj;
        $total_ongoing = $ongoing + $ongoing_proj + $ongoing_subproj;
        $total_terminated = $terminated + $terminated_proj + $terminated_subproj;
        $total_completed = $completed + $completed_proj + $completed_subproj;

        // $awards_count = DB::table('cbg_awards')->count();

        $total_programs_count = DB::table('programs')->count();
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

        $progs = DB::table('programs')->join('agency', 'agency.abbrev', '=', 'programs.funding_agency')
            ->select(DB::raw("COUNT(*) as count_p"), DB::raw("agency.abbrev as abbrev"), DB::raw("approved_budget as budget"), DB::raw("program_title as title"))
            ->groupBy('abbrev', 'budget', 'title')
            ->orderBy('count_p')
            ->get();

        foreach ($progs as $progams) {
            $program_count[] = $progams->count_p;
            $progams_a[] = $progams->abbrev;
            $progams_budget[] = $progams->budget;
            // $programs_year[] = $progams->year;
        }

        $total_programs = DB::table('programs')->select(DB::raw("COUNT(*) as total_programs_count"), DB::raw("funding_agency as total_program_agency"))
            ->groupBy('total_program_agency')
            ->orderBy('total_programs_count')
            ->get();

        $total_projs = DB::table('projects')->select(DB::raw("COUNT(*) as total_count_proj"), DB::raw("project_agency as total_project_agency"))
            ->groupBy('total_project_agency')
            ->orderBy('total_count_proj')
            ->get();

        $projs = DB::table('projects')->select(
            DB::raw("COUNT(*) as count_proj"),
            DB::raw("project_agency as project_agency"),
            DB::raw("project_approved_budget as project_budget"),
            DB::raw("project_budget_year as project_year"),
            DB::raw("project_title as project_title")
        )
            ->groupBy('project_agency', 'project_budget', 'project_year', 'project_title')
            ->orderBy('count_proj')
            ->get();

        foreach ($projs as $projects) {
            $project_count[] = $projects->count_proj;
            $project_a[] = $projects->project_agency;
            $projects_budget[] = $projects->project_budget;
            $projects_year[] = $projects->project_year;
        }

        $total_sub_projs = DB::table('sub_projects')->select(DB::raw("COUNT(*) as total_count_sub_proj"), DB::raw("sub_project_agency as total_sub_project_agency"))
            ->groupBy('total_sub_project_agency')
            ->orderBy('total_count_sub_proj')
            ->get();


        $researchers = DB::table('researchers')->join('agency', 'agency.abbrev', '=', 'researchers.agency')
            ->select(DB::raw('count(*) as count_res'), DB::raw('agency.abbrev as abbrev'))
            ->groupBy('abbrev')
            ->get();

        foreach ($researchers as $res) {
            $res_count[] = $res->count_res;
            $res_agency[] = $res->abbrev;
        }

        $agencyData = DB::table('agency')
            ->select(
                'agency.abbrev as agency_abbreviation',
                DB::raw('COUNT(DISTINCT programs.id) as total_programs'),
                DB::raw('COUNT(DISTINCT projects.id) as total_projects'),
                DB::raw('COUNT(DISTINCT sub_projects.id) as total_sub_projects')
            )
            ->leftJoin('programs', 'agency.abbrev', '=', 'programs.funding_agency')
            ->leftJoin('projects', 'agency.abbrev', '=', 'projects.project_agency')
            ->leftJoin('sub_projects', 'agency.abbrev', '=', 'sub_projects.sub_project_agency')
            ->groupBy('agency_abbreviation')
            ->get();

        $agenciesDataBudget = Agency::select('agency.abbrev as agency_abbreviation')
            ->selectRaw('SUM(programs.approved_budget) as total_program_budget')
            ->selectRaw('SUM(projects.project_approved_budget) as total_project_budget')
            ->selectRaw('SUM(sub_projects.sub_project_approved_budget) as total_sub_project_budget')
            ->leftJoin('programs', 'agency.abbrev', '=', 'programs.funding_agency')
            ->leftJoin('projects', 'agency.abbrev', '=', 'projects.project_agency')
            ->leftJoin('sub_projects', 'projects.id', '=', 'sub_projects.projectID')
            ->groupBy('agency_abbreviation')
            ->get();

        $dataTotal = DB::table('agency')
            ->join('programs', 'agency.abbrev', '=', 'programs.funding_agency')
            ->join('projects', 'programs.id', '=', 'projects.programID')
            ->join('sub_projects', 'projects.id', '=', 'sub_projects.projectID')
            ->selectRaw('agency.abbrev AS agency_abbrevi, SUM(sub_projects.sub_project_approved_budget) AS total_budget')
            ->groupBy('agency.abbrev')
            ->get();


        return view('backend.layouts.dashboard', [
            'total_new' => $total_new, 'total_ongoing' => $total_ongoing, 'total_terminated' => $total_terminated,
            'total_completed' => $total_completed, 'agency_awards' => $agency_a, 'count' => $count, 'count_p' => $program_count,
            'program_agency' => $progams_a, 'count_proj' => $project_count, 'count_res' => $res_count, 'abbrev' => $res_agency
        ], compact(
            'all',
            'title',
            'data',
            'dataTotal',
            'datas',
            'progs',
            'data_agency',
            'projs',
            'total_projs',
            'total_programs_count',
            'total_projects',
            'total_sub_projects',
            'total_sub_projs',
            'total_researchers',
            'researchers',
            'agencyData',
            'total_programs',
            'agenciesDataBudget',
            'user_agency',
            'total_programs_count_filter',
            'total_projects_filter',
            'total_sub_projects_filter',
            'total_researchers_filter'

        ));
    }
}
