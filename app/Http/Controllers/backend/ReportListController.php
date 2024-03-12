<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Programs;
use App\Models\Projects;
use App\Models\User;
use App\Models\SubProjects;
use App\Models\CBGEquipments;
use App\Models\CBGMeetings;
use App\Models\CBGTrainings;
use App\Models\Awards;
use App\Models\Initiatives;
use App\Models\PolicyPrc;
use App\Models\PolicyFormulated;
use App\Models\RDMCDbinfosys;
use App\Models\RDMCLinkages;
use App\Models\ResultsTPA;
use App\Models\ResultsTtm;
use App\Models\ResultsTTP;
use App\Models\StrategicCollaborativeList;
use App\Models\StrategicProgramList;
use App\Models\StrategicTechList;
use App\Models\Agency;
use App\Models\Contributions;
use Mpdf\Mpdf;
use PDF;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Datatables;
use Illuminate\Support\Facades\Session;
// use DB;

use Illuminate\Support\Facades\DB;

class ReportListController extends Controller
{
    public function reportListIndex()
    {
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

        $new_sub_proj = DB::table('projects')->where('project_status', '=', 'new')->pluck('project_status')->count();
        $ongoing_sub_proj = DB::table('projects')->where('project_status', '=', 'on-going')->pluck('project_status')->count();
        $terminated_sub_proj = DB::table('projects')->where('project_status', '=', 'terminated')->pluck('project_status')->count();
        $completed_sub_proj = DB::table('projects')->where('project_status', '=', 'completed')->pluck('project_status')->count();

        // $agency = DB::table('agency')->get()->pluck("abbrev");
        $data = DB::table('agency')->get();

        // foreach ($data as $agency) {
        //     $lists[] = $agency->abbrev;
        // }

        $total_new = $new + $new_proj + $new_sub_proj;
        $total_ongoing = $ongoing + $ongoing_proj + $ongoing_sub_proj;
        $total_terminated = $terminated + $terminated_proj + $terminated_sub_proj;
        $total_completed = $completed + $completed_proj + $completed_sub_proj;

        $plist = Projects::select('project_title', 'project_description', 'project_duration', 'project_agency')->get();
        $list = Programs::select('program_title', 'program_description', 'duration', 'funding_agency')->get();
        $splist = SubProjects::select('sub_project_title', 'sub_project_description', 'sub_project_duration', 'sub_project_agency')->get();

        $linkages_developed = DB::table('rdmc_linkages')
            ->select('form_of_development', 'address', 'year', 'nature_of_assistance')
            ->where('type', '=', 'Developed')
            ->orderBy('form_of_development') // Order by alphabetical order of form_of_development
            ->orderBy('year')
            ->get();

        $linkages_maintained = DB::table('rdmc_linkages')
            ->select('form_of_development', 'address', 'year', 'nature_of_assistance')
            ->where('type', '=', 'Maintained')
            ->orderBy('form_of_development') // Order by alphabetical order of form_of_development
            ->orderBy('year')
            ->get();

        $db = DB::table('rdmc_dbinfosys')->select('dbinfosys_title', 'dbinfosys_type', 'dbinfosys_date_created', 'dbinfosys_purpose')->where('dbinfosys_category', '=', 'Database')->get();

        $is = DB::table('rdmc_dbinfosys')->select('dbinfosys_title', 'dbinfosys_type', 'dbinfosys_date_created', 'dbinfosys_purpose')->where('dbinfosys_category', '=', 'Information System')->get();

        $stratProgramListProposal = DB::table('strategic_program_list')->select('str_p_title', 'str_p_imp_agency', 'str_p_sof', 'str_p_date', 'str_p_budget', 'str_p_regional')->where('str_p_type', '=', 'Proposals')->get();

        $stratProgramListApproved = DB::table('strategic_program_list')->select('str_p_title', 'str_p_imp_agency', 'str_p_sof', 'str_p_date', 'str_p_budget', 'str_p_regional')->where('str_p_type', '=', 'Approved')->get();

        $agencyAbbreviations = DB::table('agency')->pluck('abbrev')->toArray();

        $fundedCounts = [];

        foreach ($agencyAbbreviations as $abbrev) {
            $fundedProjectsCount1 = Projects::where('encoder_agency', $abbrev)->where('project_status', '=', 'New')->count();

            $fundedProjectsCount2 = Projects::where('encoder_agency', $abbrev)->where('project_status', '=', 'Ongoing')->count();

            $fundedProjectsCount3 = Projects::where('encoder_agency', $abbrev)->where('project_status', '=', 'Terminated')->count();

            $fundedProjectsCount4 = Projects::where('encoder_agency', $abbrev)->where('project_status', '=', 'Completed')->count();

            $totalProjectCount = $fundedProjectsCount1 + $fundedProjectsCount2 + $fundedProjectsCount3 + $fundedProjectsCount4;

            $fundedCounts[$abbrev] = [
                'new' => $fundedProjectsCount1,
                'ongoing' => $fundedProjectsCount2,
                'terminated' => $fundedProjectsCount3,
                'completed' => $fundedProjectsCount4,
                'totalCount' => $totalProjectCount,
            ];
        }

        // strategic collaborative
        $strat_collaborative = DB::table('strategic_collaborative_list')->select('str_collab_program', 'str_collab_project', 'str_collab_imp_agency', 'str_collab_agency', 'str_collab_budget', 'str_collab_date', 'str_collab_roc', 'str_collab_sof')->get();

        // strategic tech/info list
        $strat_tech_research = DB::table('strategic_tech_list')->select('tech_researchers', 'tech_title', 'tech_agency', 'tech_impact')->where('tech_type', '=', 'Research')->get();
        $strat_tech_dev = DB::table('strategic_tech_list')->select('tech_researchers', 'tech_title', 'tech_agency', 'tech_impact')->where('tech_type', '=', 'Development')->get();

        // list of Technology Transfer Program/Projects Packaged, Approved and Implemented
        $ttp_proposal = DB::table('results_ttp')->select('ttp_proponent', 'ttp_researchers', 'ttp_implementing_agency', 'ttp_sof', 'ttp_title', 'ttp_date', 'ttp_budget', 'ttp_priorities')->where('ttp_type', '=', 'Packaged')->get();

        $ttp_approved = DB::table('results_ttp')->select('ttp_proponent', 'ttp_researchers', 'ttp_implementing_agency', 'ttp_sof', 'ttp_title', 'ttp_date', 'ttp_budget', 'ttp_priorities')->where('ttp_type', '=', 'Approved')->get();

        //List of Technologies Commercialized or Pre-Commercialization Initiatives
        $tech_commercialized = DB::table('results_ttm')->select('ttm_type', 'ttm_title', 'ttm_agency', 'ttm_status')->orderBy('ttm_type')->get();

        //List of Technology Promotion Approaches
        $tpa = DB::table('results_tpa')->select('tpa_approaches', 'tpa_title', 'tpa_agency', 'tpa_details')->orderBy('tpa_title')->get();

        // CBG trainings
        $trainings = DB::table('cbg_trainings')->select('id', 'trainings_title', 'trainings_start', 'trainings_venue', 'trainings_expenditures', 'trainings_sof')->get();
        // CBG equipments
        $equipments = DB::table('cbg_equipments')->select('equipments_type', 'equipments_name', 'equipments_agency', 'equipments_total', 'equipments_sof')->get();
        // CBG awards
        $awards = DB::table('cbg_awards')->select('awards_type', 'awards_title', 'awards_recipients', 'awards_agency', 'awards_sponsor', 'awards_event', 'awards_place', 'awards_date')->get();
        // CBG meetings
        $meetings = DB::table('cbg_meetings')->select('meeting_type', 'meeting_venue', 'meeting_date', 'meeting_host')->get();
        // CBG CMI Contributions
        $contributions = DB::table('cbg_contributions')->select('con_name', 'con_amount')->get();
        // CBG new initiatives
        $initiatives = DB::table('cbg_initiatives')->select('ini_initiates', 'ini_date')->get();

        // Policy analysis and advocacy (Policy Researches Conducted)
        $issues = DB::table('policy_prc')->select('prc_title', 'prc_agency', 'prc_author', 'prc_issues')->get();

        // Policy analysis and advocacy (Policy Formulated...)
        $formulated = DB::table('policy_formulated')->select('policy_type', 'policy_title', 'policy_agency', 'policy_author', 'policy_co_author', 'policy_beneficiary', 'policy_implementer', 'policy_issues')->get();

        return view('backend.reportlist.report_list', [
            'title' => $title,
            'fundedCounts' => $fundedCounts,
            'stratProgramListApproved' => $stratProgramListApproved,
            'stratProgramListProposal' => $stratProgramListProposal,
            'total_new' => $total_new,
            'total_ongoing' => $total_ongoing,
            'total_terminated' => $total_terminated,
            'total_completed' => $total_completed,
            'list' => $list,
            'plist' => $plist,
            'splist' => $splist,
            'linkages_developed' => $linkages_developed,
            'linkages_maintained' => $linkages_maintained,
            'db' => $db,
            'is' => $is,
            'strat_collaborative' => $strat_collaborative,
            'strat_tech_research' => $strat_tech_research,
            'strat_tech_dev' => $strat_tech_dev,
            'ttp_proposal' => $ttp_proposal,
            'ttp_approved' => $ttp_approved,
            'tech_commercialized' => $tech_commercialized,
            'tpa' => $tpa,
            'trainings' => $trainings,
            'equipments' => $equipments,
            'awards' => $awards,
            'meetings' => $meetings,
            'contributions' => $contributions,
            'initiatives' => $initiatives,
            'issues' => $issues,
            'formulated' => $formulated,
        ]);
    }

    // public function createPDF()
    // {
    //     $title = 'List of Reports | RTMS';

    //     $new = DB::table('programs')->where('program_status', '=', 'new')->pluck('program_status')->count();
    //     $ongoing = DB::table('programs')->where('program_status', '=', 'on-going')->pluck('program_status')->count();
    //     $terminated = DB::table('programs')->where('program_status', '=', 'terminated')->pluck('program_status')->count();
    //     $completed = DB::table('programs')->where('program_status', '=', 'completed')->pluck('program_status')->count();
    //     // Project
    //     $new_proj = DB::table('projects')->where('project_status', '=', 'new')->pluck('project_status')->count();
    //     $ongoing_proj = DB::table('projects')->where('project_status', '=', 'on-going')->pluck('project_status')->count();
    //     $terminated_proj = DB::table('projects')->where('project_status', '=', 'terminated')->pluck('project_status')->count();
    //     $completed_proj = DB::table('projects')->where('project_status', '=', 'completed')->pluck('project_status')->count();

    //     $new_sub_proj = DB::table('sub_projects')->where('sub_project_status', '=', 'new')->pluck('sub_project_status')->count();
    //     $ongoing_sub_proj = DB::table('sub_projects')->where('sub_project_status', '=', 'on-going')->pluck('sub_project_status')->count();
    //     $terminated_sub_proj = DB::table('sub_projects')->where('sub_project_status', '=', 'terminated')->pluck('sub_project_status')->count();
    //     $completed_sub_proj = DB::table('sub_projects')->where('sub_project_status', '=', 'completed')->pluck('sub_project_status')->count();

    //     $data = DB::table('agency')->get();

    //     $total_new = $new + $new_proj + $new_sub_proj;
    //     $total_ongoing = $ongoing + $ongoing_proj + $ongoing_sub_proj;
    //     $total_terminated = $terminated + $terminated_proj + $terminated_sub_proj;
    //     $total_completed = $completed + $completed_proj + $completed_sub_proj;

    //     $plist = Projects::select('project_title', 'project_description', 'project_duration', 'project_agency')->get();
    //     $list = Programs::select('program_title', 'program_description', 'duration', 'funding_agency')->get();
    //     $splist = SubProjects::select('sub_project_title', 'sub_project_description', 'sub_project_duration', 'sub_project_agency')->get();

    //     $linkages_developed = DB::table('rdmc_linkages')
    //         ->select('form_of_development', 'address', 'year', 'nature_of_assistance')
    //         ->where('type', '=', 'Developed')
    //         ->orderBy('form_of_development') // Order by alphabetical order of form_of_development
    //         ->orderBy('year')
    //         ->get();

    //     $linkages_maintained = DB::table('rdmc_linkages')
    //         ->select('form_of_development', 'address', 'year', 'nature_of_assistance')
    //         ->where('type', '=', 'Maintained')
    //         ->orderBy('form_of_development') // Order by alphabetical order of form_of_development
    //         ->orderBy('year')
    //         ->get();

    //     $db = DB::table('rdmc_dbinfosys')->select('dbinfosys_title', 'dbinfosys_type', 'dbinfosys_date_created', 'dbinfosys_purpose')->where('dbinfosys_category', '=', 'Database')->get();

    //     $is = DB::table('rdmc_dbinfosys')->select('dbinfosys_title', 'dbinfosys_type', 'dbinfosys_date_created', 'dbinfosys_purpose')->where('dbinfosys_category', '=', 'Information System')->get();

    //     $stratProgramListProposal = DB::table('strategic_program_list')->select('str_p_title', 'str_p_imp_agency', 'str_p_sof', 'str_p_date', 'str_p_budget', 'str_p_regional')->where('str_p_type', '=', 'Proposals')->get();

    //     $stratProgramListApproved = DB::table('strategic_program_list')->select('str_p_title', 'str_p_imp_agency', 'str_p_sof', 'str_p_date', 'str_p_budget', 'str_p_regional')->where('str_p_type', '=', 'Approved')->get();

    //     $agencyAbbreviations = DB::table('agency')->pluck('abbrev')->toArray();

    //     $fundedCounts = [];

    //     foreach ($agencyAbbreviations as $abbrev) {
    //         $fundedProjectsCount1 = Projects::where('encoder_agency', $abbrev)->where('project_status', '=', 'New')->count();

    //         $fundedProjectsCount2 = Projects::where('encoder_agency', $abbrev)->where('project_status', '=', 'Ongoing')->count();

    //         $fundedProjectsCount3 = Projects::where('encoder_agency', $abbrev)->where('project_status', '=', 'Terminated')->count();

    //         $fundedProjectsCount4 = Projects::where('encoder_agency', $abbrev)->where('project_status', '=', 'Completed')->count();

    //         $totalProjectCount = $fundedProjectsCount1 + $fundedProjectsCount2 + $fundedProjectsCount3 + $fundedProjectsCount4;

    //         $fundedCounts[$abbrev] = [
    //             'new' => $fundedProjectsCount1,
    //             'ongoing' => $fundedProjectsCount2,
    //             'terminated' => $fundedProjectsCount3,
    //             'completed' => $fundedProjectsCount4,
    //             'totalCount' => $totalProjectCount,
    //         ];
    //     }

    //     // strategic collaborative
    //     $strat_collaborative = DB::table('strategic_collaborative_list')->select('str_collab_program', 'str_collab_project', 'str_collab_imp_agency', 'str_collab_agency', 'str_collab_budget', 'str_collab_date', 'str_collab_roc')->get();

    //     // strategic tech/info list
    //     $strat_tech_research = DB::table('strategic_tech_list')->select('tech_researchers', 'tech_title', 'tech_agency', 'tech_impact')->where('tech_type', '=', 'Research')->get();
    //     $strat_tech_dev = DB::table('strategic_tech_list')->select('tech_researchers', 'tech_title', 'tech_agency', 'tech_impact')->where('tech_type', '=', 'Development')->get();

    //     // list of Technology Transfer Program/Projects Packaged, Approved and Implemented
    //     $ttp_proposal = DB::table('results_ttp')->select('ttp_proponent', 'ttp_researchers', 'ttp_implementing_agency', 'ttp_sof', 'ttp_title', 'ttp_date', 'ttp_budget', 'ttp_priorities')->where('ttp_type', '=', 'Packaged')->get();

    //     $ttp_approved = DB::table('results_ttp')->select('ttp_proponent', 'ttp_researchers', 'ttp_implementing_agency', 'ttp_sof', 'ttp_title', 'ttp_date', 'ttp_budget', 'ttp_priorities')->where('ttp_type', '=', 'Approved')->get();

    //     //List of Technologies Commercialized or Pre-Commercialization Initiatives
    //     $tech_commercialized = DB::table('results_ttm')->select('ttm_type', 'ttm_title', 'ttm_agency', 'ttm_status')->orderBy('ttm_type')->get();

    //     //List of Technology Promotion Approaches
    //     $tpa = DB::table('results_tpa')->select('tpa_approaches', 'tpa_title', 'tpa_agency', 'tpa_details', 'tpa_date')->orderBy('tpa_title')->get();

    //     // CBG trainings
    //     $trainings = DB::table('cbg_trainings')->select('id', 'trainings_title', 'trainings_start', 'trainings_venue', 'trainings_expenditures', 'trainings_sof')->get();
    //     // CBG equipments
    //     $equipments = DB::table('cbg_equipments')->select('equipments_type', 'equipments_name', 'equipments_agency', 'equipments_total', 'equipments_sof')->get();
    //     // CBG awards
    //     $awards = DB::table('cbg_awards')->select('awards_type', 'awards_title', 'awards_recipients', 'awards_agency', 'awards_sponsor', 'awards_event', 'awards_place', 'awards_date')->get();
    //     // CBG meetings
    //     $meetings = DB::table('cbg_meetings')->select('meeting_type', 'meeting_venue', 'meeting_date', 'meeting_host')->get();
    //     // CBG CMI Contributions
    //     $contributions = DB::table('cbg_contributions')->select('con_name', 'con_amount')->get();
    //     // CBG new initiatives
    //     $initiatives = DB::table('cbg_initiatives')->select('ini_initiates', 'ini_date')->get();

    //     // Policy analysis and advocacy (Policy Researches Conducted)
    //     $issues = DB::table('policy_prc')->select('prc_title', 'prc_agency', 'prc_author', 'prc_issues')->get();

    //     // Policy analysis and advocacy (Policy Formulated...)
    //     $formulated = DB::table('policy_formulated')->select('policy_type', 'policy_title', 'policy_agency', 'policy_author', 'policy_co_author', 'policy_beneficiary', 'policy_implementer', 'policy_issues')->get();

    //     $pdfData = [
    //         'title' => $title,
    //         'fundedCounts' => $fundedCounts,
    //         'stratProgramListApproved' => $stratProgramListApproved,
    //         'stratProgramListProposal' => $stratProgramListProposal,
    //         'total_new' => $total_new,
    //         'total_ongoing' => $total_ongoing,
    //         'total_terminated' => $total_terminated,
    //         'total_completed' => $total_completed,
    //         'list' => $list,
    //         'plist' => $plist,
    //         'splist' => $splist,
    //         'linkages_developed' => $linkages_developed,
    //         'linkages_maintained' => $linkages_maintained,
    //         'db' => $db,
    //         'is' => $is,
    //         'strat_collaborative' => $strat_collaborative,
    //         'strat_tech_research' => $strat_tech_research,
    //         'strat_tech_dev' => $strat_tech_dev,
    //         'ttp_proposal' => $ttp_proposal,
    //         'ttp_approved' => $ttp_approved,
    //         'tech_commercialized' => $tech_commercialized,
    //         'tpa' => $tpa,
    //         'trainings' => $trainings,
    //         'equipments' => $equipments,
    //         'awards' => $awards,
    //         'meetings' => $meetings,
    //         'contributions' => $contributions,
    //         'initiatives' => $initiatives,
    //         'issues' => $issues,
    //         'formulated' => $formulated,
    //     ];

    //     $pdf = PDF::loadView('backend.reportlist.export_report', $pdfData);
    //     $pdf->setPaper('a4', 'landscape');
    //     // Display the PDF in the browser in a new tab
    //     return Response::make($pdf->output(), 200, [
    //         'Content-Type' => 'application/pdf',
    //         'Content-Disposition' => 'attachment; filename="sample.pdf"',
    //     ]);
    // }

    public function createPDF()
    {
        $title = 'List of Reports | RTMS';

        // Fetch program status counts
        $programCounts = DB::table('programs')
            ->select(DB::raw('program_status, COUNT(*) as count'))
            ->whereIn('program_status', ['New', 'Ongoing', 'Terminated', 'completed'])
            ->groupBy('program_status')
            ->pluck('count', 'program_status')
            ->toArray();

        // Fetch project status counts
        $projectCounts = DB::table('projects')
            ->select(DB::raw('project_status, COUNT(*) as count'))
            ->whereIn('project_status', ['New', 'Ongoing', 'Terminated', 'Completed'])
            ->groupBy('project_status')
            ->pluck('count', 'project_status')
            ->toArray();

        // Fetch sub-project status counts
        $subProjectCounts = DB::table('sub_projects')
            ->select(DB::raw('sub_project_status, COUNT(*) as count'))
            ->whereIn('sub_project_status', ['New', 'Ongoing', 'Terminated', 'Completed'])
            ->groupBy('sub_project_status')
            ->pluck('count', 'sub_project_status')
            ->toArray();

        // Total counts
        $totalCounts = [
            'total_new' => (isset($programCounts['New']) ? $programCounts['New'] : 0) + (isset($projectCounts['New']) ? $projectCounts['New'] : 0) + (isset($subProjectCounts['New']) ? $subProjectCounts['New'] : 0),
            'total_ongoing' => (isset($programCounts['Ongoing']) ? $programCounts['Ongoing'] : 0) + (isset($projectCounts['Ongoing']) ? $projectCounts['Ongoing'] : 0) + (isset($subProjectCounts['Ongoing']) ? $subProjectCounts['Ongoing'] : 0),
            'total_terminated' => (isset($programCounts['Terminated']) ? $programCounts['Terminated'] : 0) + (isset($projectCounts['Terminated']) ? $projectCounts['Terminated'] : 0) + (isset($subProjectCounts['Terminated']) ? $subProjectCounts['Terminated'] : 0),
            'total_completed' => (isset($programCounts['Completed']) ? $programCounts['Completed'] : 0) + (isset($projectCounts['Completed']) ? $projectCounts['Completed'] : 0) + (isset($subProjectCounts['Completed']) ? $subProjectCounts['Completed'] : 0),
        ];

        // Fetch other data
        $plist = Projects::select('project_title', 'project_description', 'project_duration', 'project_agency')->get();
        $list = Programs::select('program_title', 'program_description', 'duration', 'funding_agency')->get();
        $splist = SubProjects::select('sub_project_title', 'sub_project_description', 'sub_project_duration', 'sub_project_agency')->get();

        $linkages_developed = RDMCLinkages::where('type', 'Developed')->orderBy('form_of_development')->orderBy('year')->get();
        $linkages_maintained = RDMCLinkages::where('type', 'Maintained')->orderBy('form_of_development')->orderBy('year')->get();
        $db = RDMCDbinfosys::where('dbinfosys_category', 'Database')->get();
        $is = RDMCDbinfosys::where('dbinfosys_category', 'Information System')->get();

        $stratProgramListProposal = StrategicProgramList::where('str_p_type', 'Proposals')->get();
        $stratProgramListApproved = StrategicProgramList::where('str_p_type', 'Approved')->get();

        // Fetch funded project counts by agency
        $fundedCounts = [];
        $agencyAbbreviations = Agency::pluck('abbrev')->toArray();
        foreach ($agencyAbbreviations as $abbrev) {
            $fundedProjectsCount1 = Projects::where('encoder_agency', $abbrev)->where('project_status', 'New')->count();
            // Define $fundedProjectsCount2, $fundedProjectsCount3, and $fundedProjectsCount4
            $fundedProjectsCount2 = Projects::where('encoder_agency', $abbrev)->where('project_status', 'Ongoing')->count();
            $fundedProjectsCount3 = Projects::where('encoder_agency', $abbrev)->where('project_status', 'Terminated')->count();
            $fundedProjectsCount4 = Projects::where('encoder_agency', $abbrev)->where('project_status', 'Completed')->count();

            // Add defined variables to the $fundedCounts array
            $fundedCounts[$abbrev] = [
                'new' => $fundedProjectsCount1,
                'ongoing' => $fundedProjectsCount2,
                'terminated' => $fundedProjectsCount3,
                'completed' => $fundedProjectsCount4,
                'totalCount' => $fundedProjectsCount1 + $fundedProjectsCount2 + $fundedProjectsCount3 + $fundedProjectsCount4,
            ];
        }

        // Fetch other lists
        $strat_collaborative = StrategicCollaborativeList::all();

        // Fetch strategic tech research and development records
        $stratTechRecords = StrategicTechList::whereIn('tech_type', ['Research', 'Development'])->get();

        // Separate research and development records
        $strat_tech_research = $stratTechRecords->where('tech_type', 'Research');
        $strat_tech_dev = $stratTechRecords->where('tech_type', 'Development');

        // Fetch Technology Transfer Program records
        $ttpRecords = ResultsTTP::whereIn('ttp_type', ['Packaged', 'Approved'])->get();

        // Separate packaged and approved records
        $ttp_proposal = $ttpRecords->where('ttp_type', 'Packaged');
        $ttp_approved = $ttpRecords->where('ttp_type', 'Approved');

        $tech_commercialized = ResultsTtm::orderBy('ttm_type')->get();
        $tpa = ResultsTPA::orderBy('tpa_title')->get();
        $trainings = CBGTrainings::all();
        $equipments = CBGEquipments::all();
        $awards = Awards::all();
        $meetings = CBGMeetings::all();
        $contributions = Contributions::all();
        $initiatives = Initiatives::all();
        $issues = PolicyPrc::all();
        $formulated = PolicyFormulated::all();

        $pdfData = [
            'title' => $title,
            'fundedCounts' => $fundedCounts,
            'stratProgramListApproved' => $stratProgramListApproved,
            'stratProgramListProposal' => $stratProgramListProposal,
            'total_new' => $totalCounts['total_new'],
            'total_ongoing' => $totalCounts['total_ongoing'],
            'total_terminated' => $totalCounts['total_terminated'],
            'total_completed' => $totalCounts['total_completed'],
            'list' => $list,
            'plist' => $plist,
            'splist' => $splist,
            'linkages_developed' => $linkages_developed,
            'linkages_maintained' => $linkages_maintained,
            'db' => $db,
            'is' => $is,
            'strat_collaborative' => $strat_collaborative,
            'strat_tech_research' => $strat_tech_research,
            'strat_tech_dev' => $strat_tech_dev,
            'ttp_proposal' => $ttp_proposal,
            'ttp_approved' => $ttp_approved,
            'tech_commercialized' => $tech_commercialized,
            'tpa' => $tpa,
            'trainings' => $trainings,
            'equipments' => $equipments,
            'awards' => $awards,
            'meetings' => $meetings,
            'contributions' => $contributions,
            'initiatives' => $initiatives,
            'issues' => $issues,
            'formulated' => $formulated,
        ];

        $pdf = PDF::loadView('backend.reportlist.export_report', $pdfData);
        $pdf->setPaper('a4', 'landscape');
        // Display the PDF in the browser in a new tab
        return Response::make($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="sample.pdf"',
        ]);
    }

    public function exportFilteredData()
    {
        $duration = Session::get('duration');
        $title = $duration . ' ' . 'REPORT';
        $agency = DB::table('agency')->get();
        // $year = $request->year;

        // Implement your filtering logic here based on $duration
        $records = Programs::where('duration', 'like', "%$duration%")->get();
        $p_records = Projects::where('project_duration', 'like', "%$duration%")->get();
        $sp_records = SubProjects::where('sub_project_duration', 'like', "%$duration%")->get();

        // SUMMARY OF THE AIHRS
        $agencyAbbreviations = DB::table('agency')->pluck('abbrev')->toArray();
        $fundedCounts = [];

        foreach ($agencyAbbreviations as $abbrev) {
            $fundedProjectsCount1 = Projects::where('project_duration', 'like', "%$duration%")
                ->where('encoder_agency', $abbrev)
                ->where('project_status', '=', 'New')
                ->count();
            $fundedProjectsCount2 = Projects::where('project_duration', 'like', "%$duration%")
                ->where('encoder_agency', $abbrev)
                ->where('project_status', '=', 'Ongoing')
                ->count();
            $fundedProjectsCount3 = Projects::where('project_duration', 'like', "%$duration%")
                ->where('encoder_agency', $abbrev)
                ->where('project_status', '=', 'Terminated')
                ->count();
            $fundedProjectsCount4 = Projects::where('project_duration', 'like', "%$duration%")
                ->where('encoder_agency', $abbrev)
                ->where('project_status', '=', 'Completed')
                ->count();
            $totalProjectCount = $fundedProjectsCount1 + $fundedProjectsCount2 + $fundedProjectsCount3 + $fundedProjectsCount4;
            $fundedCounts[$abbrev] = [
                'new' => $fundedProjectsCount1,
                'ongoing' => $fundedProjectsCount2,
                'terminated' => $fundedProjectsCount3,
                'completed' => $fundedProjectsCount4,
                'totalCount' => $totalProjectCount,
            ];
        }

        // RDMC LINKAGES
        $linkages_developed = DB::table('rdmc_linkages')->select('form_of_development', 'address', 'year', 'nature_of_assistance')->where('year', $duration)->where('type', '=', 'Developed')->orderBy('year', 'asc')->get();
        $linkages_maintained = DB::table('rdmc_linkages')->select('form_of_development', 'address', 'year', 'nature_of_assistance')->where('year', $duration)->where('type', '=', 'Maintained')->orderBy('year', 'asc')->get();

        // DBIS
        $db = DB::table('rdmc_dbinfosys')
            ->select('dbinfosys_title', 'dbinfosys_type', 'dbinfosys_date_created', 'dbinfosys_purpose')
            ->where('dbinfosys_date_created', 'like', "%$duration%")
            ->where('dbinfosys_category', '=', 'Database')
            ->get();
        $is = DB::table('rdmc_dbinfosys')
            ->select('dbinfosys_title', 'dbinfosys_type', 'dbinfosys_date_created', 'dbinfosys_purpose')
            ->where('dbinfosys_date_created', 'like', "%$duration%")
            ->where('dbinfosys_category', '=', 'Information System')
            ->get();

        // STRATEGIC PROGRAM LIST
        $stratProgramListProposal = DB::table('strategic_program_list')
            ->select('str_p_title', 'str_p_imp_agency', 'str_p_sof', 'str_p_date', 'str_p_budget', 'str_p_regional')
            ->where('str_p_date', 'like', "%$duration%")
            ->where('str_p_type', '=', 'Proposals')
            ->get();
        $stratProgramListApproved = DB::table('strategic_program_list')
            ->select('str_p_title', 'str_p_imp_agency', 'str_p_sof', 'str_p_date', 'str_p_budget', 'str_p_regional')
            ->where('str_p_date', 'like', "%$duration%")
            ->where('str_p_type', '=', 'Approved')
            ->get();

        // STRATEGIC COLLABORATIVE
        $strat_collaborative = DB::table('strategic_collaborative_list')
            ->select('str_collab_program', 'str_collab_project', 'str_collab_imp_agency', 'str_collab_agency', 'str_collab_budget', 'str_collab_date', 'str_collab_roc', 'str_collab_sof')
            ->where('str_collab_date', 'like', "%$duration%")
            ->get();

        // strategic tech/info list
        $strat_tech_research = DB::table('strategic_tech_list')
            ->select('tech_researchers', 'tech_title', 'tech_agency', 'tech_impact', 'tech_duration')
            ->where('tech_type', '=', 'Research')
            ->where('tech_duration', 'like', "%$duration%")
            ->get();
        $strat_tech_dev = DB::table('strategic_tech_list')
            ->select('tech_researchers', 'tech_title', 'tech_agency', 'tech_impact', 'tech_duration')
            ->where('tech_type', '=', 'Development')
            ->where('tech_duration', 'like', "%$duration%")
            ->get();

        // list of Technology Transfer Program/Projects Packaged, Approved and Implemented
        $ttp_proposal = DB::table('results_ttp')
            ->select('ttp_proponent', 'ttp_researchers', 'ttp_implementing_agency', 'ttp_sof', 'ttp_title', 'ttp_date', 'ttp_budget', 'ttp_priorities')
            ->where('ttp_date', 'like', "%$duration%")
            ->where('ttp_type', '=', 'Packaged')
            ->get();
        $ttp_approved = DB::table('results_ttp')
            ->select('ttp_proponent', 'ttp_researchers', 'ttp_implementing_agency', 'ttp_sof', 'ttp_title', 'ttp_date', 'ttp_budget', 'ttp_priorities')
            ->where('ttp_date', 'like', "%$duration%")
            ->where('ttp_type', '=', 'Approved')
            ->get();

        //List of Technologies Commercialized or Pre-Commercialization Initiatives
        $tech_commercialized = DB::table('results_ttm')
            ->select('ttm_type', 'ttm_title', 'ttm_agency', 'ttm_status')
            ->where('created_at', 'like', "%$duration%")
            ->orderBy('ttm_type')
            ->get();

        //List of Technology Promotion Approaches
        $tpa = DB::table('results_tpa')
            ->select('tpa_approaches', 'tpa_title', 'tpa_agency', 'tpa_details', 'tpa_date')
            ->where('tpa_date', 'like', "%$duration%")
            ->orderBy('tpa_title')
            ->get();

        // CBG trainings
        $trainings = DB::table('cbg_trainings')
            ->select('id', 'trainings_title', 'trainings_start', 'trainings_venue', 'trainings_expenditures', 'trainings_sof')
            ->where('trainings_start', 'like', "%$duration%")
            ->get();

        // CBG equipments
        $equipments = DB::table('cbg_equipments')
            ->select('equipments_type', 'equipments_name', 'equipments_agency', 'equipments_total', 'equipments_sof')
            ->where('equipments_date', 'like', "%$duration%")
            ->get();

        // CBG awards
        $awards = DB::table('cbg_awards')
            ->select('awards_type', 'awards_title', 'awards_recipients', 'awards_agency', 'awards_sponsor', 'awards_event', 'awards_place', 'awards_date')
            ->where('awards_date', 'like', "%$duration%")
            ->get();

        // CBG meetings
        $meetings = DB::table('cbg_meetings')
            ->select('meeting_type', 'meeting_venue', 'meeting_date', 'meeting_host')
            ->where('meeting_date', 'like', "%$duration%")
            ->get();

        // CBG CMI Contributions
        $contributions = DB::table('cbg_contributions')
            ->select('con_name', 'con_amount')
            ->where('con_year', 'like', "%$duration%")
            ->get();

        // CBG new initiatives
        $initiatives = DB::table('cbg_initiatives')
            ->select('ini_initiates', 'ini_date')
            ->where('ini_date', 'like', "%$duration%")
            ->get();

        // Policy analysis and advocacy (Policy Researches Conducted)
        $issues = DB::table('policy_prc')
            ->select('prc_title', 'prc_agency', 'prc_author', 'prc_issues')
            ->where('prc_date', 'like', "%$duration%")
            ->get();

        // Policy analysis and advocacy (Policy Formulated...)
        $formulated = DB::table('policy_formulated')
            ->select('policy_type', 'policy_title', 'policy_agency', 'policy_author', 'policy_co_author', 'policy_beneficiary', 'policy_implementer', 'policy_issues')
            ->where('policy_date', 'like', "%$duration%")
            ->get();

        $pdfData = [
            'title' => $title,
            'fundedCounts' => $fundedCounts,
            'stratProgramListApproved' => $stratProgramListApproved,
            'stratProgramListProposal' => $stratProgramListProposal,
            'records' => $records,
            'p_records' => $p_records,
            'sp_records' => $sp_records,
            'linkages_developed' => $linkages_developed,
            'linkages_maintained' => $linkages_maintained,
            'db' => $db,
            'is' => $is,
            'strat_collaborative' => $strat_collaborative,
            'strat_tech_research' => $strat_tech_research,
            'strat_tech_dev' => $strat_tech_dev,
            'ttp_proposal' => $ttp_proposal,
            'ttp_approved' => $ttp_approved,
            'tech_commercialized' => $tech_commercialized,
            'tpa' => $tpa,
            'trainings' => $trainings,
            'equipments' => $equipments,
            'awards' => $awards,
            'meetings' => $meetings,
            'contributions' => $contributions,
            'initiatives' => $initiatives,
            'issues' => $issues,
            'formulated' => $formulated,
        ];

        $pdf = PDF::loadView('backend.reportlist.export_report_filter', $pdfData);
        $pdf->setPaper('a4', 'landscape');
        // Display the PDF in the browser in a new tab
        return $pdf->stream('Filtered_' . $duration . '_Data.pdf');
    }

    //Filtered Reports Index
    // public function index()
    // {
    //     $title = 'FILTERED REPORTS';
    //     $agency = DB::table('agency')->get();
    //     $records = Programs::get();
    //     $p_records = Projects::get(); // Change 10 to the desired number of records per page
    //     $sp_records = SubProjects::get();

    //     //SUMMARY OF THE AIHRS (CMI's)
    //     $agencyAbbreviations = DB::table('agency')->pluck('abbrev')->toArray();
    //     $fundedCounts = [];

    //     foreach ($agencyAbbreviations as $abbrev) {
    //         $fundedProjectsCount1 = Projects::where('encoder_agency', $abbrev)->where('project_status', '=', 'New')->count();
    //         $fundedProjectsCount2 = Projects::where('encoder_agency', $abbrev)->where('project_status', '=', 'Ongoing')->count();
    //         $fundedProjectsCount3 = Projects::where('encoder_agency', $abbrev)->where('project_status', '=', 'Terminated')->count();
    //         $fundedProjectsCount4 = Projects::where('encoder_agency', $abbrev)->where('project_status', '=', 'Completed')->count();
    //         $totalProjectCount = $fundedProjectsCount1 + $fundedProjectsCount2 + $fundedProjectsCount3 + $fundedProjectsCount4;

    //         $fundedCounts[$abbrev] = [
    //             'new' => $fundedProjectsCount1,
    //             'ongoing' => $fundedProjectsCount2,
    //             'terminated' => $fundedProjectsCount3,
    //             'completed' => $fundedProjectsCount4,
    //             'totalCount' => $totalProjectCount,
    //         ];
    //     }

    //     // RDMC LINKAGES
    //     $linkages_developed = DB::table('rdmc_linkages')->select('form_of_development', 'address', 'year', 'nature_of_assistance')->where('type', '=', 'Developed')->orderBy('year', 'asc')->get();
    //     $linkages_maintained = DB::table('rdmc_linkages')->select('form_of_development', 'address', 'year', 'nature_of_assistance')->where('type', '=', 'Maintained')->orderBy('year', 'asc')->get();

    //     // DBIS
    //     $db = DB::table('rdmc_dbinfosys')->select('dbinfosys_title', 'dbinfosys_type', 'dbinfosys_date_created', 'dbinfosys_purpose')->where('dbinfosys_category', '=', 'Database')->get();
    //     $is = DB::table('rdmc_dbinfosys')->select('dbinfosys_title', 'dbinfosys_type', 'dbinfosys_date_created', 'dbinfosys_purpose')->where('dbinfosys_category', '=', 'Information System')->get();

    //     // STRATEGIC PROGRAM LIST
    //     $stratProgramListProposal = DB::table('strategic_program_list')->select('str_p_title', 'str_p_imp_agency', 'str_p_sof', 'str_p_date', 'str_p_budget', 'str_p_regional')->where('str_p_type', '=', 'Proposals')->get();
    //     $stratProgramListApproved = DB::table('strategic_program_list')->select('str_p_title', 'str_p_imp_agency', 'str_p_sof', 'str_p_date', 'str_p_budget', 'str_p_regional')->where('str_p_type', '=', 'Approved')->get();

    //     // STRATEGIC COLLABORATIVE
    //     $strat_collaborative = DB::table('strategic_collaborative_list')->select('str_collab_program', 'str_collab_project', 'str_collab_imp_agency', 'str_collab_agency', 'str_collab_budget', 'str_collab_date', 'str_collab_roc', 'str_collab_sof')->get();

    //     // strategic tech/info list
    //     $strat_tech_research = DB::table('strategic_tech_list')->select('tech_researchers', 'tech_title', 'tech_agency', 'tech_impact', 'tech_duration')->where('tech_type', '=', 'Research')->get();
    //     $strat_tech_dev = DB::table('strategic_tech_list')->select('tech_researchers', 'tech_title', 'tech_agency', 'tech_impact', 'tech_duration')->where('tech_type', '=', 'Development')->get();

    //     // list of Technology Transfer Program/Projects Packaged, Approved and Implemented
    //     $ttp_proposal = DB::table('results_ttp')->select('ttp_proponent', 'ttp_researchers', 'ttp_implementing_agency', 'ttp_sof', 'ttp_title', 'ttp_date', 'ttp_budget', 'ttp_priorities')->where('ttp_type', '=', 'Packaged')->get();
    //     $ttp_approved = DB::table('results_ttp')->select('ttp_proponent', 'ttp_researchers', 'ttp_implementing_agency', 'ttp_sof', 'ttp_title', 'ttp_date', 'ttp_budget', 'ttp_priorities')->where('ttp_type', '=', 'Approved')->get();

    //     //List of Technologies Commercialized or Pre-Commercialization Initiatives
    //     $tech_commercialized = DB::table('results_ttm')->select('ttm_type', 'ttm_title', 'ttm_agency', 'ttm_status')->orderBy('ttm_type')->get();

    //     //List of Technology Promotion Approaches
    //     $tpa = DB::table('results_tpa')->select('tpa_approaches', 'tpa_title', 'tpa_agency', 'tpa_details', 'tpa_date')->orderBy('tpa_title')->get();

    //     // CBG trainings
    //     $trainings = DB::table('cbg_trainings')->select('id', 'trainings_title', 'trainings_start', 'trainings_venue', 'trainings_expenditures', 'trainings_sof')->get();
    //     // CBG equipments
    //     $equipments = DB::table('cbg_equipments')->select('equipments_type', 'equipments_name', 'equipments_agency', 'equipments_total', 'equipments_sof')->get();
    //     // CBG awards
    //     $awards = DB::table('cbg_awards')->select('awards_type', 'awards_title', 'awards_recipients', 'awards_agency', 'awards_sponsor', 'awards_event', 'awards_place', 'awards_date')->get();
    //     // CBG meetings
    //     $meetings = DB::table('cbg_meetings')->select('meeting_type', 'meeting_venue', 'meeting_date', 'meeting_host')->get();
    //     // CBG CMI Contributions
    //     $contributions = DB::table('cbg_contributions')->select('con_name', 'con_amount')->get();
    //     // CBG new initiatives
    //     $initiatives = DB::table('cbg_initiatives')->select('ini_initiates', 'ini_date')->get();

    //     // Policy analysis and advocacy (Policy Researches Conducted)
    //     $issues = DB::table('policy_prc')->select('prc_title', 'prc_agency', 'prc_author', 'prc_issues')->get();

    //     // Policy analysis and advocacy (Policy Formulated...)
    //     $formulated = DB::table('policy_formulated')->select('policy_type', 'policy_title', 'policy_agency', 'policy_author', 'policy_co_author', 'policy_beneficiary', 'policy_implementer', 'policy_issues')->get();

    //     return view('backend.reportlist.report', compact('records', 'agency', 'title', 'p_records', 'sp_records', 'fundedCounts', 'linkages_developed', 'linkages_maintained', 'db', 'is', 'stratProgramListProposal', 'stratProgramListApproved', 'strat_collaborative', 'ttp_proposal', 'ttp_approved', 'strat_tech_research', 'strat_tech_dev', 'tech_commercialized', 'tpa', 'trainings', 'equipments', 'awards', 'meetings', 'contributions', 'initiatives', 'issues', 'formulated'));
    // }
    public function index()
    {
        $title = 'FILTERED REPORTS';
        $agency = DB::table('agency')->get();
        $records = Programs::get();
        $p_records = Projects::get(); // Change 10 to the desired number of records per page
        $sp_records = SubProjects::get();

        // SUMMARY OF THE AIHRS (CMI's)
        $fundedCounts = [];
        $agencyAbbreviations = Agency::pluck('abbrev')->toArray();
        foreach ($agencyAbbreviations as $abbrev) {
            $fundedProjectsCount1 = Projects::where('encoder_agency', $abbrev)->where('project_status', 'New')->count();
            // Define $fundedProjectsCount2, $fundedProjectsCount3, and $fundedProjectsCount4
            $fundedProjectsCount2 = Projects::where('encoder_agency', $abbrev)->where('project_status', 'Ongoing')->count();
            $fundedProjectsCount3 = Projects::where('encoder_agency', $abbrev)->where('project_status', 'Terminated')->count();
            $fundedProjectsCount4 = Projects::where('encoder_agency', $abbrev)->where('project_status', 'Completed')->count();

            // Add defined variables to the $fundedCounts array
            $fundedCounts[$abbrev] = [
                'new' => $fundedProjectsCount1,
                'ongoing' => $fundedProjectsCount2,
                'terminated' => $fundedProjectsCount3,
                'completed' => $fundedProjectsCount4,
                'totalCount' => $fundedProjectsCount1 + $fundedProjectsCount2 + $fundedProjectsCount3 + $fundedProjectsCount4,
            ];
        }

        // RDMC LINKAGES
        $linkages_developed = DB::table('rdmc_linkages')->where('type', '=', 'Developed')->orderBy('year', 'asc')->get();
        $linkages_maintained = DB::table('rdmc_linkages')->where('type', '=', 'Maintained')->orderBy('year', 'asc')->get();

        // DBIS
        $db = DB::table('rdmc_dbinfosys')->where('dbinfosys_category', '=', 'Database')->get();
        $is = DB::table('rdmc_dbinfosys')->where('dbinfosys_category', '=', 'Information System')->get();

        // STRATEGIC PROGRAM LIST
        $stratProgramListProposal = DB::table('strategic_program_list')->where('str_p_type', '=', 'Proposals')->get();
        $stratProgramListApproved = DB::table('strategic_program_list')->where('str_p_type', '=', 'Approved')->get();

        // STRATEGIC COLLABORATIVE
        $strat_collaborative = DB::table('strategic_collaborative_list')->get();

        // strategic tech/info list
        $strat_tech_research = DB::table('strategic_tech_list')->where('tech_type', '=', 'Research')->get();
        $strat_tech_dev = DB::table('strategic_tech_list')->where('tech_type', '=', 'Development')->get();

        // list of Technology Transfer Program/Projects Packaged, Approved and Implemented
        $ttp_proposal = DB::table('results_ttp')->where('ttp_type', '=', 'Packaged')->get();
        $ttp_approved = DB::table('results_ttp')->where('ttp_type', '=', 'Approved')->get();

        // List of Technologies Commercialized or Pre-Commercialization Initiatives
        $tech_commercialized = DB::table('results_ttm')->orderBy('ttm_type')->get();

        // List of Technology Promotion Approaches
        $tpa = DB::table('results_tpa')->orderBy('tpa_title')->get();

        // CBG trainings, equipments, awards, meetings, CMI Contributions, and new initiatives
        $trainings = DB::table('cbg_trainings')->get();
        $equipments = DB::table('cbg_equipments')->get();
        $awards = DB::table('cbg_awards')->get();
        $meetings = DB::table('cbg_meetings')->get();
        $contributions = DB::table('cbg_contributions')->get();
        $initiatives = DB::table('cbg_initiatives')->get();

        // Policy analysis and advocacy (Policy Researches Conducted)
        $issues = DB::table('policy_prc')->get();

        // Policy analysis and advocacy (Policy Formulated...)
        $formulated = DB::table('policy_formulated')->get();

        return view('backend.reportlist.report', compact('records', 'agency', 'title', 'p_records', 'sp_records', 'fundedCounts', 'linkages_developed', 'linkages_maintained', 'db', 'is', 'stratProgramListProposal', 'stratProgramListApproved', 'strat_collaborative', 'ttp_proposal', 'ttp_approved', 'strat_tech_research', 'strat_tech_dev', 'tech_commercialized', 'tpa', 'trainings', 'equipments', 'awards', 'meetings', 'contributions', 'initiatives', 'issues', 'formulated'));
    }
    public function filter(Request $request)
    {
        $duration = $request->duration;
        Session::put('duration', $duration);
        $title = $duration . ' ' . 'REPORT';
        $agency = DB::table('agency')->get();
        // $year = $request->year;

        // Implement your filtering logic here based on $duration
        $records = Programs::where('duration', 'like', "%$duration%")->get();
        $p_records = Projects::where('project_duration', 'like', "%$duration%")->get();
        $sp_records = SubProjects::where('sub_project_duration', 'like', "%$duration%")->get();

        // SUMMARY OF THE AIHRS
        $agencyAbbreviations = DB::table('agency')->pluck('abbrev')->toArray();
        $fundedCounts = [];

        foreach ($agencyAbbreviations as $abbrev) {
            $fundedProjectsCount1 = Projects::where('project_duration', 'like', "%$duration%")
                ->where('encoder_agency', $abbrev)
                ->where('project_status', '=', 'New')
                ->count();
            $fundedProjectsCount2 = Projects::where('project_duration', 'like', "%$duration%")
                ->where('encoder_agency', $abbrev)
                ->where('project_status', '=', 'Ongoing')
                ->count();
            $fundedProjectsCount3 = Projects::where('project_duration', 'like', "%$duration%")
                ->where('encoder_agency', $abbrev)
                ->where('project_status', '=', 'Terminated')
                ->count();
            $fundedProjectsCount4 = Projects::where('project_duration', 'like', "%$duration%")
                ->where('encoder_agency', $abbrev)
                ->where('project_status', '=', 'Completed')
                ->count();
            $totalProjectCount = $fundedProjectsCount1 + $fundedProjectsCount2 + $fundedProjectsCount3 + $fundedProjectsCount4;
            $fundedCounts[$abbrev] = [
                'new' => $fundedProjectsCount1,
                'ongoing' => $fundedProjectsCount2,
                'terminated' => $fundedProjectsCount3,
                'completed' => $fundedProjectsCount4,
                'totalCount' => $totalProjectCount,
            ];
        }

        // RDMC LINKAGES
        $linkages_developed = DB::table('rdmc_linkages')->select('form_of_development', 'address', 'year', 'nature_of_assistance')->where('year', $duration)->where('type', '=', 'Developed')->orderBy('year', 'asc')->get();
        $linkages_maintained = DB::table('rdmc_linkages')->select('form_of_development', 'address', 'year', 'nature_of_assistance')->where('year', $duration)->where('type', '=', 'Maintained')->orderBy('year', 'asc')->get();

        // DBIS
        $db = DB::table('rdmc_dbinfosys')
            ->select('dbinfosys_title', 'dbinfosys_type', 'dbinfosys_date_created', 'dbinfosys_purpose')
            ->where('dbinfosys_date_created', 'like', "%$duration%")
            ->where('dbinfosys_category', '=', 'Database')
            ->get();
        $is = DB::table('rdmc_dbinfosys')
            ->select('dbinfosys_title', 'dbinfosys_type', 'dbinfosys_date_created', 'dbinfosys_purpose')
            ->where('dbinfosys_date_created', 'like', "%$duration%")
            ->where('dbinfosys_category', '=', 'Information System')
            ->get();

        // STRATEGIC PROGRAM LIST
        $stratProgramListProposal = DB::table('strategic_program_list')
            ->select('str_p_title', 'str_p_imp_agency', 'str_p_sof', 'str_p_date', 'str_p_budget', 'str_p_regional')
            ->where('str_p_date', 'like', "%$duration%")
            ->where('str_p_type', '=', 'Proposals')
            ->get();
        $stratProgramListApproved = DB::table('strategic_program_list')
            ->select('str_p_title', 'str_p_imp_agency', 'str_p_sof', 'str_p_date', 'str_p_budget', 'str_p_regional')
            ->where('str_p_date', 'like', "%$duration%")
            ->where('str_p_type', '=', 'Approved')
            ->get();

        // STRATEGIC COLLABORATIVE
        $strat_collaborative = DB::table('strategic_collaborative_list')
            ->select('str_collab_program', 'str_collab_project', 'str_collab_imp_agency', 'str_collab_agency', 'str_collab_budget', 'str_collab_date', 'str_collab_roc', 'str_collab_sof')
            ->where('str_collab_date', 'like', "%$duration%")
            ->get();

        // strategic tech/info list
        $strat_tech_research = DB::table('strategic_tech_list')
            ->select('tech_researchers', 'tech_title', 'tech_agency', 'tech_impact', 'tech_duration')
            ->where('tech_type', '=', 'Research')
            ->where('tech_duration', 'like', "%$duration%")
            ->get();
        $strat_tech_dev = DB::table('strategic_tech_list')
            ->select('tech_researchers', 'tech_title', 'tech_agency', 'tech_impact', 'tech_duration')
            ->where('tech_type', '=', 'Development')
            ->where('tech_duration', 'like', "%$duration%")
            ->get();

        // list of Technology Transfer Program/Projects Packaged, Approved and Implemented
        $ttp_proposal = DB::table('results_ttp')
            ->select('ttp_proponent', 'ttp_researchers', 'ttp_implementing_agency', 'ttp_sof', 'ttp_title', 'ttp_date', 'ttp_budget', 'ttp_priorities')
            ->where('ttp_date', 'like', "%$duration%")
            ->where('ttp_type', '=', 'Packaged')
            ->get();
        $ttp_approved = DB::table('results_ttp')
            ->select('ttp_proponent', 'ttp_researchers', 'ttp_implementing_agency', 'ttp_sof', 'ttp_title', 'ttp_date', 'ttp_budget', 'ttp_priorities')
            ->where('ttp_date', 'like', "%$duration%")
            ->where('ttp_type', '=', 'Approved')
            ->get();

        //List of Technologies Commercialized or Pre-Commercialization Initiatives
        $tech_commercialized = DB::table('results_ttm')
            ->select('ttm_type', 'ttm_title', 'ttm_agency', 'ttm_status')
            ->where('created_at', 'like', "%$duration%")
            ->orderBy('ttm_type')
            ->get();

        //List of Technology Promotion Approaches
        $tpa = DB::table('results_tpa')
            ->select('tpa_approaches', 'tpa_title', 'tpa_agency', 'tpa_details', 'tpa_date')
            ->where('tpa_date', 'like', "%$duration%")
            ->orderBy('tpa_title')
            ->get();

        // CBG trainings
        $trainings = DB::table('cbg_trainings')
            ->select('id', 'trainings_title', 'trainings_start', 'trainings_venue', 'trainings_expenditures', 'trainings_sof')
            ->where('trainings_start', 'like', "%$duration%")
            ->get();

        // CBG equipments
        $equipments = DB::table('cbg_equipments')
            ->select('equipments_type', 'equipments_name', 'equipments_agency', 'equipments_total', 'equipments_sof')
            ->where('equipments_date', 'like', "%$duration%")
            ->get();

        // CBG awards
        $awards = DB::table('cbg_awards')
            ->select('awards_type', 'awards_title', 'awards_recipients', 'awards_agency', 'awards_sponsor', 'awards_event', 'awards_place', 'awards_date')
            ->where('awards_date', 'like', "%$duration%")
            ->get();

        // CBG meetings
        $meetings = DB::table('cbg_meetings')
            ->select('meeting_type', 'meeting_venue', 'meeting_date', 'meeting_host')
            ->where('meeting_date', 'like', "%$duration%")
            ->get();

        // CBG CMI Contributions
        $contributions = DB::table('cbg_contributions')
            ->select('con_name', 'con_amount')
            ->where('con_year', 'like', "%$duration%")
            ->get();

        // CBG new initiatives
        $initiatives = DB::table('cbg_initiatives')
            ->select('ini_initiates', 'ini_date')
            ->where('ini_date', 'like', "%$duration%")
            ->get();

        // Policy analysis and advocacy (Policy Researches Conducted)
        $issues = DB::table('policy_prc')
            ->select('prc_title', 'prc_agency', 'prc_author', 'prc_issues')
            ->where('prc_date', 'like', "%$duration%")
            ->get();

        // Policy analysis and advocacy (Policy Formulated...)
        $formulated = DB::table('policy_formulated')
            ->select('policy_type', 'policy_title', 'policy_agency', 'policy_author', 'policy_co_author', 'policy_beneficiary', 'policy_implementer', 'policy_issues')
            ->where('policy_date', 'like', "%$duration%")
            ->get();

        $programs_html = view('backend.reportlist.data.programs_table', compact('records'))->render();
        $projects_html = view('backend.reportlist.data.projects_table', compact('p_records'))->render();
        $sub_projects_html = view('backend.reportlist.data.sub_projects_table', compact('sp_records'))->render();
        $funded_counts_html = view('backend.reportlist.data.summary_aihrs', compact('fundedCounts'))->render();
        $linkages_table_html = view('backend.reportlist.data.linkages_table', compact('linkages_developed', 'linkages_maintained'))->render();
        $dbis_table_html = view('backend.reportlist.data.dbis_table', compact('db', 'is'))->render();
        $strat_proglist_table_html = view('backend.reportlist.data.strat_proglist_table', compact('stratProgramListProposal', 'stratProgramListApproved'))->render();
        $strat_collab_table_html = view('backend.reportlist.data.strat_collab_table', compact('strat_collaborative'))->render();
        $rdru_techlist_table_html = view('backend.reportlist.data.rdru_techlist_table', compact('ttp_proposal', 'ttp_approved'))->render();
        $strat_tech_table_html = view('backend.reportlist.data.strat_tech_table', compact('strat_tech_research', 'strat_tech_dev'))->render();
        $results_tech_com_table_html = view('backend.reportlist.data.results_tech_com_table', compact('tech_commercialized'))->render();
        $results_tpa_table_html = view('backend.reportlist.data.results_tpa_table', compact('tpa'))->render();

        $cbg_equip_table_html = view('backend.reportlist.data.cbg_equip_table', compact('equipments'))->render();
        $cbg_trainings_table_html = view('backend.reportlist.data.cbg_trainings_table', compact('trainings'))->render();
        $cbg_awards_table_html = view('backend.reportlist.data.cbg_awards_table', compact('awards'))->render();

        $cbg_meeting_table_html = view('backend.reportlist.data.cbg_meeting_table', compact('meetings'))->render();
        $cbg_cmi_table_html = view('backend.reportlist.data.cbg_cmi_table', compact('contributions'))->render();
        $cbg_initiative_table_html = view('backend.reportlist.data.cbg_initiative_table', compact('initiatives'))->render();

        $policy_prc_table_html = view('backend.reportlist.data.policy_prc_table', compact('issues'))->render();
        $policy_formulated_table_html = view('backend.reportlist.data.policy_formulated_table', compact('formulated'))->render();

        return view('backend.reportlist.reports_table', compact('programs_html', 'projects_html', 'sub_projects_html', 'linkages_table_html', 'dbis_table_html', 'strat_proglist_table_html', 'funded_counts_html', 'strat_collab_table_html', 'rdru_techlist_table_html', 'strat_tech_table_html', 'results_tech_com_table_html', 'cbg_trainings_table_html', 'cbg_equip_table_html', 'results_tpa_table_html', 'cbg_awards_table_html', 'cbg_meeting_table_html', 'cbg_cmi_table_html', 'policy_prc_table_html', 'policy_formulated_table_html', 'cbg_initiative_table_html', 'title', 'agency', 'duration', 'linkages_developed', 'linkages_maintained', 'db', 'is', 'stratProgramListProposal', 'stratProgramListApproved', 'strat_collaborative', 'ttp_proposal', 'ttp_approved'));
    }
}
