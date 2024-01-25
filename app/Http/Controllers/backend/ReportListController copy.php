<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Programs;
use App\Models\Projects;
use App\Models\SubProjects;
use PDF;
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

        foreach ($data as $agency) {
            $lists[] = $agency->abbrev;
        }

        $total_new = $new + $new_proj + $new_sub_proj;
        $total_ongoing = $ongoing + $ongoing_proj + $ongoing_sub_proj;
        $total_terminated = $terminated + $terminated_proj + $terminated_sub_proj;
        $total_completed = $completed + $completed_proj + $completed_sub_proj;

        $all_programs = DB::table('programs')->get();
        $all_projects = DB::table('projects')->get();
        $all_sub_projects = DB::table('sub_projects')->get();

        $plist = Projects::get();
        $list = Programs::get();
        $splist = SubProjects::get();
        $stratProgramListProposal = DB::table('strategic_program_list')
            ->where('str_p_type', '=', 'Proposals')
            ->get();

        $stratProgramListApproved = DB::table('strategic_program_list')
            ->where('str_p_type', '=', 'Approved')
            ->get();

        $linkages_developed = DB::table('rdmc_linkages')
            ->where('type', '=', 'Developed')
            ->orderBy('form_of_development') // Order by alphabetical order of form_of_development
            ->orderBy('year')
            ->get();

        $linkages_maintained = DB::table('rdmc_linkages')
            ->where('type', '=', 'Maintained')
            ->orderBy('form_of_development') // Order by alphabetical order of form_of_development
            ->orderBy('year')
            ->get();

        $db = DB::table('rdmc_dbinfosys')
            ->where('dbinfosys_category', '=', 'Database')
            ->get();
        $is = DB::table('rdmc_dbinfosys')
            ->where('dbinfosys_category', '=', 'Information System')
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
        $strat_collaborative = DB::table('strategic_collaborative_list')->get();

        // strategic tech/info list
        $strat_tech_research = DB::table('strategic_tech_list')
            ->where('tech_type', '=', 'Research')
            ->get();
        $strat_tech_dev = DB::table('strategic_tech_list')
            ->where('tech_type', '=', 'Development')
            ->get();

        /* The code is querying the database table 'rdmc_linkages' to retrieve records where the 'type'
        column is equal to 'Developed' and the 'form_of_development' column is equal to 'Local'. The
        results are then ordered by the 'year' column in ascending order. The retrieved records are
        stored in the variables  and
        respectively. */
        $linkages_local_developed = DB::table('rdmc_linkages')
            ->where('type', '=', 'Developed')
            ->where('form_of_development', '=', 'Local')
            ->orderBy('form_of_development') // Order by alphabetical order of form_of_development
            ->orderBy('year')
            ->get();

        $linkages_local_maintained = DB::table('rdmc_linkages')
            ->where('type', '=', 'Maintained')
            ->where('form_of_development', '=', 'Local')
            ->orderBy('form_of_development') // Order by alphabetical order of form_of_development
            ->orderBy('year')
            ->get();

        /* The code is querying the database table 'rdmc_linkages' to retrieve records where the 'type'
       column is equal to 'Developed' and the 'form_of_development' column is equal to 'National'.
       The results are then ordered by the 'year' column in ascending order. The retrieved records
       are stored in the variables  and
       respectively. */
        $linkages_national_developed = DB::table('rdmc_linkages')
            ->where('type', '=', 'Developed')
            ->where('form_of_development', '=', 'National')
            ->orderBy('form_of_development') // Order by alphabetical order of form_of_development
            ->orderBy('year')
            ->get();

        $linkages_national_maintained = DB::table('rdmc_linkages')
            ->where('type', '=', 'Maintained')
            ->where('form_of_development', '=', 'National')
            ->orderBy('form_of_development') // Order by alphabetical order of form_of_development
            ->orderBy('year')
            ->get();

        /* The above code is performing database queries using the Laravel framework's query builder. */
        $linkages_international_developed = DB::table('rdmc_linkages')
            ->where('type', '=', 'Developed')
            ->where('form_of_development', '=', 'International')
            ->orderBy('form_of_development') // Order by alphabetical order of form_of_development
            ->orderBy('year')
            ->get();

        $linkages_international_maintained = DB::table('rdmc_linkages')
            ->where('type', '=', 'Maintained')
            ->where('form_of_development', '=', 'International')
            ->orderBy('form_of_development') // Order by alphabetical order of form_of_development
            ->orderBy('year')
            ->get();

        // list of Technology Transfer Program/Projects Packaged, Approved and Implemented
        $ttp_proposal = DB::table('results_ttp')
            ->where('ttp_type', '=', 'Packaged')
            ->get();

        $ttp_approved = DB::table('results_ttp')
            ->where('ttp_type', '=', 'Approved')
            ->get();

        //List of Technologies Commercialized or Pre-Commercialization Initiatives
        $tech_commercialized = DB::table('results_ttm')
            ->orderBy('ttm_type')
            ->get();

        //List of Technology Promotion Approaches
        $tpa = DB::table('results_tpa')
            ->orderBy('tpa_title')
            ->get();

        // CBG trainings
        $trainings = DB::table('cbg_trainings')->get();
        // CBG equipments
        $equipments = DB::table('cbg_equipments')->get();
        // CBG awards
        $awards = DB::table('cbg_awards')->get();
        // CBG meetings
        $meetings = DB::table('cbg_meetings')->get();
        // CBG CMI Contributions
        $contributions = DB::table('cbg_contributions')->get();
        // CBG new initiatives
        $initiatives = DB::table('cbg_initiatives')->get();
        return view(
            'backend.reportlist.report_list',
            [
                'total_new' => $total_new,
                'total_ongoing' => $total_ongoing,
                'total_terminated' => $total_terminated,
                'total_completed' => $total_completed,
                'lists' => $lists,
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
                'linkages_local_developed' => $linkages_local_developed,
                'linkages_local_maintained' => $linkages_local_maintained,
                'linkages_national_developed' => $linkages_national_developed,
                'linkages_national_maintained' => $linkages_national_maintained,
                'linkages_international_developed' => $linkages_international_developed,
                'linkages_international_maintained' => $linkages_international_maintained,
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
            ],
            compact('title', 'all_programs', 'all_projects', 'all_sub_projects', 'fundedCounts', 'stratProgramListApproved', 'stratProgramListProposal'),
        );
    }

    public function createPDF()
    {
        // retreive all records from db
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
        $pdf = PDF::loadView('backend.reportlist.export_report', [
            'list' => $list,
            'plist' => $plist,
            'splist' => $splist,
            'linkages_developed' => $linkages_developed,
            'linkages_maintained' => $linkages_maintained,
            'db' => $db,
            'is' => $is,
        ])->setPaper('a4', 'portrait');
        return $pdf->download('reports.pdf');
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
