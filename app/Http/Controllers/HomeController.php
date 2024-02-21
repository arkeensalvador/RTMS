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
        $all = DB::table('agency')->join('users', 'users.agencyID', '=', 'agency.id')->select('users.*', 'agency.*')->get();

        // CMI DASHBOARD
        $user_agency = DB::table('users')
            ->where('agencyID', auth()->user()->agencyID)
            ->first();

        $total_programs_count_filter = DB::table('programs')
            ->where('implementing_agency', 'LIKE', '%' . auth()->user()->agencyID . '%')
            ->count();

        $total_projects_filter = DB::table('projects')
            ->where('project_implementing_agency', 'LIKE', '%' . auth()->user()->agencyID . '%')
            ->count();

        $total_sub_projects_filter = DB::table('sub_projects')
            ->where('sub_project_implementing_agency', 'LIKE', '%' . auth()->user()->agencyID . '%')
            ->count();

        $total_researchers_filter = DB::table('researchers')
            ->where('agency', auth()->user()->agencyID)
            ->count();
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
        // programs ongoing / completed
        $total_programs_count_completed = DB::table('programs')->where('program_status', 'Completed')->count();

        $total_programs_count_ongoing = DB::table('programs')->where('program_status', 'Ongoing')->count();

        $total_projects_count_completed = DB::table('projects')->where('project_status', 'Completed')->count();

        $total_projects_count_ongoing = DB::table('projects')->where('project_status', 'Ongoing')->count();

        $total_programs_count = DB::table('programs')->count();
        $total_projects = DB::table('projects')->count();
        $total_sub_projects = DB::table('sub_projects')->count();
        $total_researchers = DB::table('researchers')->count();

        $datas = DB::table('agency')->join('cbg_awards', 'agency.abbrev', '=', 'cbg_awards.awards_agency')->select('agency.abbrev as agency', DB::raw('COUNT(cbg_awards.id) as awards_count'))->groupBy('agency')->get();

        $progs = DB::table('programs')->join('agency', 'agency.abbrev', '=', 'programs.funding_agency')->select(DB::raw('COUNT(*) as count_p'), DB::raw('agency.abbrev as abbrev'), DB::raw('amount_released as budget'), DB::raw('program_title as title'))->groupBy('abbrev', 'budget', 'title')->orderBy('count_p')->get();

        foreach ($progs as $progams) {
            $program_count[] = $progams->count_p;
            $progams_a[] = $progams->abbrev;
            $progams_budget[] = $progams->budget;
            // $programs_year[] = $progams->year;
        }

        $projs = DB::table('projects')->join('agency', 'agency.abbrev', '=', 'projects.project_agency')->select(DB::raw('COUNT(*) as count_p'), DB::raw('agency.abbrev as abbrev'), DB::raw('project_amount_released as budget'), DB::raw('project_title as title'))->groupBy('abbrev', 'budget', 'title')->orderBy('count_p')->get();

        $sub_projs = DB::table('sub_projects')->join('agency', 'agency.abbrev', '=', 'sub_projects.sub_project_agency')->select(DB::raw('COUNT(*) as count_p'), DB::raw('agency.abbrev as abbrev'), DB::raw('sub_project_amount_released as budget'), DB::raw('sub_project_title as title'))->groupBy('abbrev', 'budget', 'title')->orderBy('count_p')->get();

        $total_programs = DB::table('programs')->select(DB::raw('COUNT(*) as total_programs_count'), DB::raw('funding_agency as total_program_agency'))->groupBy('total_program_agency')->orderBy('total_programs_count')->get();

        $total_projs = DB::table('projects')->select(DB::raw('COUNT(*) as total_count_proj'), DB::raw('project_agency as total_project_agency'))->groupBy('total_project_agency')->orderBy('total_count_proj')->get();

        $total_sub_projs = DB::table('sub_projects')->select(DB::raw('COUNT(*) as total_count_sub_proj'), DB::raw('sub_project_agency as total_sub_project_agency'))->groupBy('total_sub_project_agency')->orderBy('total_count_sub_proj')->get();

        $agencyData = DB::table('agency')->select('agency.abbrev as agency_abbreviation', DB::raw('COUNT(DISTINCT programs.id) as total_programs'), DB::raw('COUNT(DISTINCT projects.id) as total_projects'), DB::raw('COUNT(DISTINCT sub_projects.id) as total_sub_projects'))->leftJoin('programs', 'agency.abbrev', '=', 'programs.funding_agency')->leftJoin('projects', 'agency.abbrev', '=', 'projects.project_agency')->leftJoin('sub_projects', 'agency.abbrev', '=', 'sub_projects.sub_project_agency')->groupBy('agency_abbreviation')->get();

        $agencyImp = DB::table('programs')->select(DB::raw('COUNT(DISTINCT programs.id) as total_programs'), DB::raw('implementing_agency as agency'), DB::raw('program_title as title'))->groupBy('title', 'agency')->get();

        $minValueAgencyData = min($agencyData->min('total_programs'), $agencyData->min('total_projects'), $agencyData->min('total_sub_projects'));

        $agenciesDataBudget = Agency::select('agency.abbrev as agency_abbreviation')->selectRaw('SUM(programs.amount_released) as total_program_budget')->selectRaw('SUM(projects.project_amount_released) as total_project_budget')->selectRaw('SUM(sub_projects.sub_project_amount_released) as total_sub_project_budget')->leftJoin('programs', 'agency.abbrev', '=', 'programs.funding_agency')->leftJoin('projects', 'agency.abbrev', '=', 'projects.project_agency')->leftJoin('sub_projects', 'projects.id', '=', 'sub_projects.projectID')->groupBy('agency_abbreviation')->get();

        $dataBudget = DB::table('agency')->select('agency.abbrev as agency_abbreviation', DB::raw('SUM(programs.amount_released) as program_budget'), DB::raw('SUM(projects.project_amount_released) as project_budget'), DB::raw('SUM(sub_projects.sub_project_amount_released) as sub_project_budget'))->leftJoin('programs', 'agency.abbrev', '=', 'programs.funding_agency')->leftJoin('projects', 'agency.abbrev', '=', 'projects.project_agency')->leftJoin('sub_projects', 'agency.abbrev', '=', 'sub_projects.sub_project_agency')->groupBy('agency_abbreviation')->get();

        $data = DB::table('programs')->select(DB::raw('SUM(amount_released) as program_budget'), DB::raw('funding_agency as agency'), DB::raw('program_title as title'))->groupBy('title', 'agency')->get();

        $data = $data->merge(DB::table('projects')->select(DB::raw('SUM(project_amount_released) as project_budget'), DB::raw('project_agency as agency'), DB::raw('project_title as title'))->groupBy('title', 'agency')->get());

        $data = $data->merge(DB::table('sub_projects')->select(DB::raw('SUM(sub_project_amount_released) as sub_project_budget'), DB::raw('sub_project_agency as agency'), DB::raw('sub_project_title as title'))->groupBy('title', 'agency')->get());

        $minValue = min($data->min('program_budget'), $data->min('project_budget'), $data->min('sub_project_budget'));

        // researchers involvement pie chart query
        // $researcherCounts = DB::table('researchers')
        //     ->select('name', DB::raw('COUNT(programs.programID) as programs_count'), DB::raw('COUNT(projects.id) as projects_count'), DB::raw('COUNT(sub_projects.id) as sub_projects_count'))
        //     ->leftJoin('programs', 'researchers.name', '=', 'programs.program_leader')
        //     ->leftJoin('projects', 'researchers.name', '=', 'projects.project_leader')
        //     ->leftJoin('sub_projects', 'researchers.name', '=', 'sub_projects.sub_project_leader')
        //     ->groupBy('researchers.name')
        //     ->get();

        // Initiatives
        $data_ini = DB::table('cbg_initiatives')->join('agency', 'cbg_initiatives.ini_agency', '=', 'agency.abbrev')->select('agency.abbrev', DB::raw('COUNT(cbg_initiatives.id) as initiative_count'))->groupBy('agency.abbrev')->get();

        $labels_ini = $data_ini->pluck('abbrev');
        $values_ini = $data_ini->pluck('initiative_count');

        // policy research conducted
        $data_prc = DB::table('policy_prc')->join('agency', 'policy_prc.prc_agency', '=', 'agency.abbrev')->select('agency.abbrev', DB::raw('COUNT(policy_prc.id) as prc_count'))->groupBy('agency.abbrev')->get();

        $labels_prc = $data_prc->pluck('abbrev');
        $values_prc = $data_prc->pluck('prc_count');

        // total count of funded programs, projects of agency
        $agencyAbbreviations = DB::table('agency')->pluck('abbrev')->toArray();

        $fundedCounts = [];

        foreach ($agencyAbbreviations as $abbrev) {
            $fundedProgramsCount = DB::table('programs')->whereJsonContains('funding_agency', $abbrev)->count();

            $fundedProjectsCount = DB::table('projects')->whereJsonContains('project_agency', $abbrev)->count();

            $fundedSubProjectsCount = DB::table('sub_projects')->whereJsonContains('sub_project_agency', $abbrev)->count();

            $fundedCounts[$abbrev] = [
                'programs' => $fundedProgramsCount,
                'projects' => $fundedProjectsCount,
                'subProjects' => $fundedSubProjectsCount,
            ];
        }

        // total count of programs, projects implemented by agency
        $impCounts = [];

        foreach ($agencyAbbreviations as $abbrev_imp) {
            $impProgramsCount = DB::table('programs')->whereJsonContains('implementing_agency', $abbrev_imp)->count();

            $impProjectsCount = DB::table('projects')->whereJsonContains('project_implementing_agency', $abbrev_imp)->count();

            $impSubProjectsCount = DB::table('sub_projects')->whereJsonContains('sub_project_implementing_agency', $abbrev_imp)->count();

            $impCounts[$abbrev_imp] = [
                'programs' => $impProgramsCount,
                'projects' => $impProjectsCount,
                'subProjects' => $impSubProjectsCount,
            ];
        }

        return view(
            'backend.layouts.dashboard',
            [
                'total_new' => $total_new,
                'total_ongoing' => $total_ongoing,
                'total_terminated' => $total_terminated,
                'total_completed' => $total_completed,
            ],
            compact('all', 'title', 'data', 'datas', 'progs', 'minValue', 'data_agency', 'agencyImp', 'minValueAgencyData', 'projs', 'sub_projs', 'total_projs', 'total_programs_count', 'total_projects', 'total_sub_projects', 'total_sub_projs', 'total_researchers', 'agencyData', 'dataBudget', 'total_programs', 'user_agency', 'total_programs_count_filter', 'total_projects_filter', 'total_sub_projects_filter', 'total_researchers_filter', 'total_programs_count_ongoing', 'total_programs_count_completed', 'total_projects_count_completed', 'total_projects_count_ongoing', 'labels_ini', 'values_ini', 'labels_prc', 'values_prc', 'fundedCounts', 'impCounts'),
        );
    }
}
