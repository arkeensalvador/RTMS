<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Programs;
use App\Models\Projects;
use App\Models\SubProjects;
use Mpdf\Mpdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
// use DB;

use Illuminate\Support\Facades\DB;

class ReportListController extends Controller
{
    public function reportListIndex()
    {
        $title = 'List of Reports | RTMS';
        $new = DB::table('programs')
            ->where('program_status', '=', 'new')
            ->pluck('program_status')
            ->count();
        $ongoing = DB::table('programs')
            ->where('program_status', '=', 'on-going')
            ->pluck('program_status')
            ->count();
        $terminated = DB::table('programs')
            ->where('program_status', '=', 'terminated')
            ->pluck('program_status')
            ->count();
        $completed = DB::table('programs')
            ->where('program_status', '=', 'completed')
            ->pluck('program_status')
            ->count();
        // Project
        $new_proj = DB::table('projects')
            ->where('project_status', '=', 'new')
            ->pluck('project_status')
            ->count();
        $ongoing_proj = DB::table('projects')
            ->where('project_status', '=', 'on-going')
            ->pluck('project_status')
            ->count();
        $terminated_proj = DB::table('projects')
            ->where('project_status', '=', 'terminated')
            ->pluck('project_status')
            ->count();
        $completed_proj = DB::table('projects')
            ->where('project_status', '=', 'completed')
            ->pluck('project_status')
            ->count();

        $new_sub_proj = DB::table('projects')
            ->where('project_status', '=', 'new')
            ->pluck('project_status')
            ->count();
        $ongoing_sub_proj = DB::table('projects')
            ->where('project_status', '=', 'on-going')
            ->pluck('project_status')
            ->count();
        $terminated_sub_proj = DB::table('projects')
            ->where('project_status', '=', 'terminated')
            ->pluck('project_status')
            ->count();
        $completed_sub_proj = DB::table('projects')
            ->where('project_status', '=', 'completed')
            ->pluck('project_status')
            ->count();

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

        $db = DB::table('rdmc_dbinfosys')
            ->select('dbinfosys_title', 'dbinfosys_type', 'dbinfosys_date_created', 'dbinfosys_purpose')
            ->where('dbinfosys_category', '=', 'Database')
            ->get();

        $is = DB::table('rdmc_dbinfosys')
            ->select('dbinfosys_title', 'dbinfosys_type', 'dbinfosys_date_created', 'dbinfosys_purpose')
            ->where('dbinfosys_category', '=', 'Information System')
            ->get();

        $stratProgramListProposal = DB::table('strategic_program_list')
            ->select('str_p_title', 'str_p_imp_agency', 'str_p_sof', 'str_p_date', 'str_p_budget', 'str_p_regional')
            ->where('str_p_type', '=', 'Proposals')
            ->get();

        $stratProgramListApproved = DB::table('strategic_program_list')
            ->select('str_p_title', 'str_p_imp_agency', 'str_p_sof', 'str_p_date', 'str_p_budget', 'str_p_regional')
            ->where('str_p_type', '=', 'Approved')
            ->get();

        $agencyAbbreviations = DB::table('agency')
            ->pluck('abbrev')
            ->toArray();

        $fundedCounts = [];

        foreach ($agencyAbbreviations as $abbrev) {
            // $fundedProgramsCount = DB::table('programs')
            //     ->whereJsonContains('implementing_agency', $abbrev)
            //     ->where('program_status', '=', 'Ongoing')
            //     ->count();

            $fundedProjectsCount1 = DB::table('projects')
                ->whereJsonContains('project_implementing_agency', $abbrev)
                ->where('project_status', '=', 'New')
                ->count();

            $fundedProjectsCount2 = DB::table('projects')
                ->whereJsonContains('project_implementing_agency', $abbrev)
                ->where('project_status', '=', 'Ongoing')
                ->count();

            $fundedProjectsCount3 = DB::table('projects')
                ->whereJsonContains('project_implementing_agency', $abbrev)
                ->where('project_status', '=', 'Terminated')
                ->count();

            $fundedProjectsCount4 = DB::table('projects')
                ->whereJsonContains('project_implementing_agency', $abbrev)
                ->where('project_status', '=', 'Completed')
                ->count();

            $totalProjectCount = $fundedProjectsCount1 + $fundedProjectsCount2 + $fundedProjectsCount3 + $fundedProjectsCount4;

            // $fundedSubProjectsCount = DB::table('sub_projects')
            //     ->whereJsonContains('sub_project_implementing_agency', $abbrev)
            //     ->count();

            $fundedCounts[$abbrev] = [
                'new' => $fundedProjectsCount1,
                'ongoing' => $fundedProjectsCount2,
                'terminated' => $fundedProjectsCount3,
                'completed' => $fundedProjectsCount4,
                'totalCount' => $totalProjectCount,
            ];
        }

        // strategic collaborative
        $strat_collaborative = DB::table('strategic_collaborative_list')
            ->select('str_collab_program', 'str_collab_project', 'str_collab_imp_agency', 'str_collab_agency', 'str_collab_budget', 'str_collab_date', 'str_collab_roc')
            ->get();

        // strategic tech/info list
        $strat_tech_research = DB::table('strategic_tech_list')
            ->select('tech_researchers', 'tech_title', 'tech_agency', 'tech_impact')
            ->where('tech_type', '=', 'Research')
            ->get();
        $strat_tech_dev = DB::table('strategic_tech_list')
            ->select('tech_researchers', 'tech_title', 'tech_agency', 'tech_impact')
            ->where('tech_type', '=', 'Development')
            ->get();

        // list of Technology Transfer Program/Projects Packaged, Approved and Implemented
        $ttp_proposal = DB::table('results_ttp')
            ->select('ttp_proponent', 'ttp_researchers', 'ttp_implementing_agency', 'ttp_sof', 'ttp_title', 'ttp_date', 'ttp_budget', 'ttp_priorities')
            ->where('ttp_type', '=', 'Packaged')
            ->get();

        $ttp_approved = DB::table('results_ttp')
            ->select('ttp_proponent', 'ttp_researchers', 'ttp_implementing_agency', 'ttp_sof', 'ttp_title', 'ttp_date', 'ttp_budget', 'ttp_priorities')
            ->where('ttp_type', '=', 'Approved')
            ->get();

        //List of Technologies Commercialized or Pre-Commercialization Initiatives
        $tech_commercialized = DB::table('results_ttm')
            ->select('ttm_type', 'ttm_title', 'ttm_agency', 'ttm_status')
            ->orderBy('ttm_type')
            ->get();

        //List of Technology Promotion Approaches
        $tpa = DB::table('results_tpa')
            ->select('tpa_approaches', 'tpa_title', 'tpa_agency', 'tpa_details')
            ->orderBy('tpa_title')
            ->get();

        // CBG trainings
        $trainings = DB::table('cbg_trainings')
            ->select('trainings_title', 'trainings_start', 'trainings_venue', 'trainings_no_participants', 'trainings_expenditures', 'trainings_sof')
            ->get();
        // CBG equipments
        $equipments = DB::table('cbg_equipments')
            ->select('equipments_type', 'equipments_name', 'equipments_agency', 'equipments_total', 'equipments_sof')
            ->get();
        // CBG awards
        $awards = DB::table('cbg_awards')
            ->select('awards_type', 'awards_title', 'awards_recipients', 'awards_agency', 'awards_sponsor', 'awards_event', 'awards_place', 'awards_date')
            ->get();
        // CBG meetings
        $meetings = DB::table('cbg_meetings')
            ->select('meeting_type', 'meeting_venue', 'meeting_date', 'meeting_host')
            ->get();
        // CBG CMI Contributions
        $contributions = DB::table('cbg_contributions')
            ->select('con_name', 'con_amount')
            ->get();
        // CBG new initiatives
        $initiatives = DB::table('cbg_initiatives')
            ->select('ini_initiates', 'ini_date')
            ->get();

        // Policy analysis and advocacy (Policy Researches Conducted)
        $issues = DB::table('policy_prc')
            ->select('prc_title', 'prc_agency', 'prc_author', 'prc_issues')
            ->get();

        // Policy analysis and advocacy (Policy Formulated...)
        $formulated = DB::table('policy_formulated')
            ->select('policy_type', 'policy_title', 'policy_agency', 'policy_author', 'policy_co_author', 'policy_proponent', 'policy_beneficiary', 'policy_implementer', 'policy_issues')
            ->get();

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

    public function createPDF()
    {
        $title = 'List of Reports | RTMS';
        $new = DB::table('programs')
            ->where('program_status', '=', 'new')
            ->pluck('program_status')
            ->count();
        $ongoing = DB::table('programs')
            ->where('program_status', '=', 'on-going')
            ->pluck('program_status')
            ->count();
        $terminated = DB::table('programs')
            ->where('program_status', '=', 'terminated')
            ->pluck('program_status')
            ->count();
        $completed = DB::table('programs')
            ->where('program_status', '=', 'completed')
            ->pluck('program_status')
            ->count();
        // Project
        $new_proj = DB::table('projects')
            ->where('project_status', '=', 'new')
            ->pluck('project_status')
            ->count();
        $ongoing_proj = DB::table('projects')
            ->where('project_status', '=', 'on-going')
            ->pluck('project_status')
            ->count();
        $terminated_proj = DB::table('projects')
            ->where('project_status', '=', 'terminated')
            ->pluck('project_status')
            ->count();
        $completed_proj = DB::table('projects')
            ->where('project_status', '=', 'completed')
            ->pluck('project_status')
            ->count();

        $new_sub_proj = DB::table('projects')
            ->where('project_status', '=', 'new')
            ->pluck('project_status')
            ->count();
        $ongoing_sub_proj = DB::table('projects')
            ->where('project_status', '=', 'on-going')
            ->pluck('project_status')
            ->count();
        $terminated_sub_proj = DB::table('projects')
            ->where('project_status', '=', 'terminated')
            ->pluck('project_status')
            ->count();
        $completed_sub_proj = DB::table('projects')
            ->where('project_status', '=', 'completed')
            ->pluck('project_status')
            ->count();

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

        $db = DB::table('rdmc_dbinfosys')
            ->select('dbinfosys_title', 'dbinfosys_type', 'dbinfosys_date_created', 'dbinfosys_purpose')
            ->where('dbinfosys_category', '=', 'Database')
            ->get();

        $is = DB::table('rdmc_dbinfosys')
            ->select('dbinfosys_title', 'dbinfosys_type', 'dbinfosys_date_created', 'dbinfosys_purpose')
            ->where('dbinfosys_category', '=', 'Information System')
            ->get();

        $stratProgramListProposal = DB::table('strategic_program_list')
            ->select('str_p_title', 'str_p_imp_agency', 'str_p_sof', 'str_p_date', 'str_p_budget', 'str_p_regional')
            ->where('str_p_type', '=', 'Proposals')
            ->get();

        $stratProgramListApproved = DB::table('strategic_program_list')
            ->select('str_p_title', 'str_p_imp_agency', 'str_p_sof', 'str_p_date', 'str_p_budget', 'str_p_regional')
            ->where('str_p_type', '=', 'Approved')
            ->get();

        $agencyAbbreviations = DB::table('agency')
            ->pluck('abbrev')
            ->toArray();

        $fundedCounts = [];

        foreach ($agencyAbbreviations as $abbrev) {
            // $fundedProgramsCount = DB::table('programs')
            //     ->whereJsonContains('implementing_agency', $abbrev)
            //     ->where('program_status', '=', 'Ongoing')
            //     ->count();

            $fundedProjectsCount1 = DB::table('projects')
                ->whereJsonContains('project_implementing_agency', $abbrev)
                ->where('project_status', '=', 'New')
                ->count();

            $fundedProjectsCount2 = DB::table('projects')
                ->whereJsonContains('project_implementing_agency', $abbrev)
                ->where('project_status', '=', 'Ongoing')
                ->count();

            $fundedProjectsCount3 = DB::table('projects')
                ->whereJsonContains('project_implementing_agency', $abbrev)
                ->where('project_status', '=', 'Terminated')
                ->count();

            $fundedProjectsCount4 = DB::table('projects')
                ->whereJsonContains('project_implementing_agency', $abbrev)
                ->where('project_status', '=', 'Completed')
                ->count();

            $totalProjectCount = $fundedProjectsCount1 + $fundedProjectsCount2 + $fundedProjectsCount3 + $fundedProjectsCount4;

            // $fundedSubProjectsCount = DB::table('sub_projects')
            //     ->whereJsonContains('sub_project_implementing_agency', $abbrev)
            //     ->count();

            $fundedCounts[$abbrev] = [
                'new' => $fundedProjectsCount1,
                'ongoing' => $fundedProjectsCount2,
                'terminated' => $fundedProjectsCount3,
                'completed' => $fundedProjectsCount4,
                'totalCount' => $totalProjectCount,
            ];
        }

        // strategic collaborative
        $strat_collaborative = DB::table('strategic_collaborative_list')
            ->select('str_collab_program', 'str_collab_project', 'str_collab_imp_agency', 'str_collab_agency', 'str_collab_budget', 'str_collab_date', 'str_collab_roc')
            ->get();

        // strategic tech/info list
        $strat_tech_research = DB::table('strategic_tech_list')
            ->select('tech_researchers', 'tech_title', 'tech_agency', 'tech_impact')
            ->where('tech_type', '=', 'Research')
            ->get();
        $strat_tech_dev = DB::table('strategic_tech_list')
            ->select('tech_researchers', 'tech_title', 'tech_agency', 'tech_impact')
            ->where('tech_type', '=', 'Development')
            ->get();

        // list of Technology Transfer Program/Projects Packaged, Approved and Implemented
        $ttp_proposal = DB::table('results_ttp')
            ->select('ttp_proponent', 'ttp_researchers', 'ttp_implementing_agency', 'ttp_sof', 'ttp_title', 'ttp_date', 'ttp_budget', 'ttp_priorities')
            ->where('ttp_type', '=', 'Packaged')
            ->get();

        $ttp_approved = DB::table('results_ttp')
            ->select('ttp_proponent', 'ttp_researchers', 'ttp_implementing_agency', 'ttp_sof', 'ttp_title', 'ttp_date', 'ttp_budget', 'ttp_priorities')
            ->where('ttp_type', '=', 'Approved')
            ->get();

        //List of Technologies Commercialized or Pre-Commercialization Initiatives
        $tech_commercialized = DB::table('results_ttm')
            ->select('ttm_type', 'ttm_title', 'ttm_agency', 'ttm_status')
            ->orderBy('ttm_type')
            ->get();

        //List of Technology Promotion Approaches
        $tpa = DB::table('results_tpa')
            ->select('tpa_approaches', 'tpa_title', 'tpa_agency', 'tpa_details')
            ->orderBy('tpa_title')
            ->get();

        // CBG trainings
        $trainings = DB::table('cbg_trainings')
            ->select('trainings_title', 'trainings_start', 'trainings_venue', 'trainings_no_participants', 'trainings_expenditures', 'trainings_sof')
            ->get();
        // CBG equipments
        $equipments = DB::table('cbg_equipments')
            ->select('equipments_type', 'equipments_name', 'equipments_agency', 'equipments_total', 'equipments_sof')
            ->get();
        // CBG awards
        $awards = DB::table('cbg_awards')
            ->select('awards_type', 'awards_title', 'awards_recipients', 'awards_agency', 'awards_sponsor', 'awards_event', 'awards_place', 'awards_date')
            ->get();
        // CBG meetings
        $meetings = DB::table('cbg_meetings')
            ->select('meeting_type', 'meeting_venue', 'meeting_date', 'meeting_host')
            ->get();
        // CBG CMI Contributions
        $contributions = DB::table('cbg_contributions')
            ->select('con_name', 'con_amount')
            ->get();
        // CBG new initiatives
        $initiatives = DB::table('cbg_initiatives')
            ->select('ini_initiates', 'ini_date')
            ->get();

        // Policy analysis and advocacy (Policy Researches Conducted)
        $issues = DB::table('policy_prc')
            ->select('prc_title', 'prc_agency', 'prc_author', 'prc_issues')
            ->get();

        // Policy analysis and advocacy (Policy Formulated...)
        $formulated = DB::table('policy_formulated')
            ->select('policy_type', 'policy_title', 'policy_agency', 'policy_author', 'policy_co_author', 'policy_proponent', 'policy_beneficiary', 'policy_implementer', 'policy_issues')
            ->get();

        $pdf = [
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
        ];
        // Create an mPDF instance
        $mpdf = new Mpdf();

        // Get the Blade view content
        $html = view('backend.reportlist.report', $pdf)->render();

        // Write the HTML content to the PDF
        $mpdf->WriteHTML($html);

        // Output the PDF to the browser
        $mpdf->Output('output.pdf', 'D');
    }

    public function reportTest()
    {
        $title = 'REPORTS | RTMS';
        $plist = Projects::get();
        $list = Programs::get();
        $splist = SubProjects::get();
        $linkages_developed = DB::table('rdmc_linkages')
            ->where('type', '=', 'Developed')
            ->get();
        $linkages_maintained = DB::table('rdmc_linkages')
            ->where('type', '=', 'Maintained')
            ->get();
        $db = DB::table('rdmc_dbinfosys')
            ->where('dbinfosys_category', '=', 'Database')
            ->get();
        $is = DB::table('rdmc_dbinfosys')
            ->where('dbinfosys_category', '=', 'Information System')
            ->get();
        return view(
            'backend.reportlist.export_report',
            [
                'list' => $list,
                'plist' => $plist,
                'splist' => $splist,
                'linkages_developed' => $linkages_developed,
                'linkages_maintained' => $linkages_maintained,
                'db' => $db,
                'is' => $is,
            ],
            compact('title'),
        );
    }
}
