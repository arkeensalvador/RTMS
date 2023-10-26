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

        foreach ($data as $agency) {
            $lists[] = $agency->abbrev;
        }

        $total_new = $new + $new_proj + $new_sub_proj;
        $total_ongoing = $ongoing + $ongoing_proj + $ongoing_sub_proj;
        $total_terminated = $terminated + $terminated_proj + $terminated_sub_proj;
        $total_completed = $completed + $completed_proj +  $completed_sub_proj;


        $all_programs = DB::table('programs')->get();
        $all_projects = DB::table('projects')->get();
        $all_sub_projects = DB::table('sub_projects')->get();


        $plist = Projects::get();
        $list = Programs::get();
        $splist = SubProjects::get();
        $linkages_developed = DB::table('rdmc_linkages')->where('type', '=', 'Developed')->get();
        $linkages_maintained = DB::table('rdmc_linkages')->where('type', '=', 'Maintained')->get();
        $db = DB::table('rdmc_dbinfosys')->where('dbinfosys_category', '=', 'Database')->get();
        $is = DB::table('rdmc_dbinfosys')->where('dbinfosys_category', '=', 'Information System')->get();


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
                'is' => $is
            ],
            compact('title', 'all_programs', 'all_projects', 'all_sub_projects')
        );
    }

    public function createPDF()
    {
        // retreive all records from db
        $plist = Projects::get();
        $list = Programs::get();
        $splist = SubProjects::get();
        $linkages_developed = DB::table('rdmc_linkages')->where('type', '=', 'Developed')->get();
        $linkages_maintained = DB::table('rdmc_linkages')->where('type', '=', 'Maintained')->get();
        $db = DB::table('rdmc_dbinfosys')->where('dbinfosys_category', '=', 'Database')->get();
        $is = DB::table('rdmc_dbinfosys')->where('dbinfosys_category', '=', 'Information System')->get();
        $pdf = PDF::loadView('backend.reportlist.export_report', [
            'list' => $list,
            'plist' => $plist,
            'splist' => $splist,
            'linkages_developed' => $linkages_developed,
            'linkages_maintained' => $linkages_maintained,
            'db' => $db,
            'is' => $is
        ])->setPaper('a4', 'portrait');


        return $pdf->download('reports.pdf');
    }

    public function reportTest()
    {
        $title = 'REPORTS | RTMS';
        $plist = Projects::get();
        $list = Programs::get();
        $splist = SubProjects::get();
        $linkages_developed = DB::table('rdmc_linkages')->where('type', '=', 'Developed')->get();
        $linkages_maintained = DB::table('rdmc_linkages')->where('type', '=', 'Maintained')->get();
        $db = DB::table('rdmc_dbinfosys')->where('dbinfosys_category', '=', 'Database')->get();
        $is = DB::table('rdmc_dbinfosys')->where('dbinfosys_category', '=', 'Information System')->get();
        return view(
            'backend.reportlist.export_report',
            [
                'list' => $list,
                'plist' => $plist,
                'splist' => $splist,
                'linkages_developed' => $linkages_developed,
                'linkages_maintained' => $linkages_maintained,
                'db' => $db,
                'is' => $is
            ],
            compact('title')
        );
    }
}
