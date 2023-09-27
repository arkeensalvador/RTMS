<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Personnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // ************************************************************************************************************************************************
    // ************************************************************************************************************************************************
    // **************************************************** CONTROLLER ROUTES *************************************************************************
    // ************************************************************************************************************************************************
    // ************************************************************************************************************************************************

    //R & D Management and Coordination
    public function reportIndex()
    {
        $title = 'Reports | RTMS';
        $agency = DB::table('programs')
            ->rightJoin('agency', 'programs.funding_agency', '=', 'agency.abbrev')
            ->select('agency.agency_name', 'agency.abbrev')
            ->first();
        return view('backend.report.report_index', compact('agency', 'title'));
    }
    public function rdmcIndex()
    {
        $title = 'RDMC';
        return view('backend.report.rdmc.rdmc_index', compact('title'));
    }

    public function monitoringEvaluation()
    {
        $title = 'Monitoring and Evaluation | RDMC';
        return view('backend.report.rdmc.monitoring_index', compact('title'));
    }

    public function rdmcProjects()
    {
        $title = 'Projects | RDMC';
        $projects = DB::table('projects')->get();
        return view('backend.report.rdmc.rdmc_projects', compact('title', 'projects'));
    }

    public function rdmcProgramsIndex()
    {
        $title = 'Programs | RDMC';
        $agency = DB::table('agency')->get();
        $all = DB::table('programs')
            ->select('*')
            ->get();

        $researchers = DB::table('researchers')->get();

        return view('backend.report.rdmc.rdmc_programs', compact('all', 'agency', 'title', 'researchers'));
    }

    public function rdmcChooseProgram()
    {
        $title = 'Programs | RDMC';
        $programs = DB::table('programs')
            ->select('*')
            ->orderByDesc("id")
            ->get();
        return view('backend.report.rdmc.rdmc_program_chooser', compact('programs', 'title'));
    }
    public function rdmcCreateProgram()
    {
        $title = 'Programs | RDMC';
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();
        return view('backend.report.rdmc.rdmc_create_program', compact('title', 'agency', 'researchers'));
    }
    // ADD PROJECTS WITHOUT PROGRAM
    public function projectsAdd()
    {
        $title = 'Projects | RDMC';
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();
        return view('backend.report.rdmc.rdmc_projects_add', compact('title', 'agency', 'researchers'));
    }
    // ADD PROJECTS TO PROGRAM IN CONTINUOUS METHOD
    public function programProjectsAdd()
    {
        $title = 'Program - projects | RDMC';
        $programs = DB::table('programs')
            ->select('*')
            ->orderByDesc("id")
            ->limit(1)
            ->first();

        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();
        return view('backend.report.rdmc.rdmc_program_projects_add', compact('programs', 'title', 'agency', 'researchers'));
    }
    // ADD PROJECTS TO PROGRAM IN NOT CONTINUOUS METHOD
    public function projectsUnderProgramAdd($programID)
    {
        $title = 'Program - projects | RDMC';
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();
        $programs = DB::table('programs')->where('programID', $programID)->first();
        return view('backend.report.rdmc.rdmc_projects_under_program_add', compact('programs', 'title', 'agency', 'researchers'));
    }
    public function subProjectsView($projectID)
    {
        $title = 'Sub-projects | RDMC';
        $sub_projects = DB::table('sub_projects')
            ->select('*')
            ->where('projectID', $projectID)
            ->orderByDesc("id")
            ->get();
        $sub_project_title = DB::table('projects')
            ->select('*')
            ->where('id', $projectID)
            ->first();
        $agency = DB::table('agency')->get();
        return view('backend.report.rdmc.rdmc_sub_project_view_index', compact('title', 'sub_project_title', 'sub_projects', 'agency'));
    }
    public function ProjectSubProjectsAdd($id)
    {
        $title = 'Sub-projects | RDMC';
        $projects = DB::table('projects')
            ->select('*')
            ->orderByDesc("id")
            ->limit(1)
            ->get();
        $agency = DB::table('agency')->get();
        return view('backend.report.rdmc.rdmc_sub_project_add', compact('title', 'projects', 'agency'));
    }

    // public function activitiesAdd()
    // {
    //     $title = 'Activities | RDMC';
    //     $agency = DB::table('agency')->get();
    //     return view('backend.report.rdmc.rdmc_activities_add', compact('title', 'agency'));
    // }

    public function rdmcActivities()
    {
        $title = 'Activities | RDMC';
        $all = DB::table('rdmc_activities')->get();
        return view('backend.report.rdmc.rdmc_activities', compact('title', 'all'));
    }

    public function rdmcAddActivities()
    {
        $title = 'Activities | RDMC';
        $agency = DB::table('agency')->get();
        return view('backend.report.rdmc.rdmc_activities_add', compact('title', 'agency'));
    }

    public function aihrsIndex()
    {
        $title = 'Agency In-House Reviews (AIHRs) | RDMC';
        // Program
        $new = DB::table('programs')->where('program_status', '=', 'new')->count();
        $ongoing = DB::table('programs')->where('program_status', '=', 'on-going')->count();
        $terminated = DB::table('programs')->where('program_status', '=', 'terminated')->count();
        $completed = DB::table('programs')->where('program_status', '=', 'completed')->count();
        // Project
        $new_proj = DB::table('projects')->where('project_status', '=', 'new')->count();
        $ongoing_proj = DB::table('projects')->where('project_status', '=', 'on-going')->count();
        $terminated_proj = DB::table('projects')->where('project_status', '=', 'terminated')->count();
        $completed_proj = DB::table('projects')->where('project_status', '=', 'completed')->count();
        return view('backend.report.rdmc.aihrs_index', compact('title', 'completed', 'new', 'ongoing', 'terminated', 'completed_proj', 'new_proj', 'ongoing_proj', 'terminated_proj'));
    }

    public function linkagesIndex()
    {
        $title = 'Linkages | RDMC';
        $all = DB::table('rdmc_linkages')->get();
        return view('backend.report.rdmc.rdmc_linkages_index', compact('title', 'all'));
    }
    public function linkagesAddIndex()
    {
        $title = 'Linkages | RDMC';
        return view('backend.report.rdmc.rdmc_linkages_add', compact('title'));
    }
    public function dbInfoSys()
    {
        $title = 'DBIS | RDMC';
        $all = DB::table('rdmc_dbinfosys')->get();
        return view('backend.report.rdmc.rdmc_dbinfosys_index', compact('title', 'all'));
    }
    public function dbInfoSysAdd()
    {
        $title = 'DBIS | RDMC';
        return view('backend.report.rdmc.rdmc_dbinfosys_add', compact('title'));
    }

    public function strategicActivities()
    {
        $title = 'Strategic R&D Activities';
        $all = DB::table('strategic_activities')->get();
        return view('backend.report.strategic.strategic_activities', compact('title', 'all'));
    }

    public function addStrategicActivities()
    {
        $title = 'Strategic R&D Activities';
        $researchers = DB::table('researchers')->get();
        $agency = DB::table('agency')->get();
        return view('backend.report.strategic.add_strategic_activities', compact('title', 'researchers', 'agency'));
    }

    public function rdruIndex()
    {
        $title = 'R&D Results Utilizations';
        return view('backend.report.rdru.rdru_index', compact('title'));
    }

    public function rdruTtp()
    {
        $title = 'TTP | R&D Results Utilizations';
        $all = DB::table('results_ttp')->get();
        $agency = DB::table('agency')->get();
        return view('backend.report.rdru.rdru_ttp', compact('title', 'all', 'agency'));
    }

    public function rdruAdd()
    {
        $title = 'TTP | R&D Results Utilizations';
        $agency = DB::table('agency')->get();
        return view('backend.report.rdru.rdru_ttp_add', compact('title', 'agency'));
    }
    public function rdruTtm()
    {
        $title = 'TTM | R&D Results Utilizations';
        $all = DB::table('results_ttm')->get();
        $agency = DB::table('agency')->get();
        return view('backend.report.rdru.rdru_ttm', compact('title', 'all', 'agency'));
    }
    public function rdruTtmAdd()
    {
        $title = 'TTM | R&D Results Utilizations';
        $agency = DB::table('agency')->get();
        return view('backend.report.rdru.rdru_ttm_add', compact('title', 'agency'));
    }
    public function rdruTpa()
    {
        $title = 'TPA | R&D Results Utilizations';
        $all = DB::table('results_tpa')->get();
        return view('backend.report.rdru.rdru_tpa', compact('title', 'all'));
    }
    public function rdruTpaAdd()
    {
        $title = 'TPA | R&D Results Utilizations';
        return view('backend.report.rdru.rdru_tpa_add', compact('title'));
    }

    public function cbgIndex()
    {
        $title = 'CBG';
        return view('backend.report.cbg.cbg_index', compact('title'));
    }

    public function cbgTraining()
    {
        $title = 'Trainings | CBG';
        $all = DB::table('cbg_trainings')->get();
        return view('backend.report.cbg.cbg_training', compact('title', 'all'));
    }

    public function cbgAwards()
    {
        $title = 'Awards | CBG';
        $award = DB::table('cbg_awards')->get();
        return view('backend.report.cbg.cbg_awards', compact('title', 'award'));
    }

    public function cbgEquipment()
    {
        $title = 'Equipments | CBG';
        $equipment = DB::table('cbg_equipments')->get();
        return view('backend.report.cbg.cbg_equipment', compact('title', 'equipment'));
    }

    public function cbgTrainingAdd()
    {
        $title = 'Trainings | CBG';
        $agency = DB::table('agency')->get();
        return view('backend.report.cbg.cbg_training_add', compact('title', 'agency'));
    }

    public function cbgAwardsAdd()
    {
        $title = 'Awards | CBG';
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();
        return view('backend.report.cbg.cbg_awards_add', compact('title', 'agency', 'researchers'));
    }

    public function cbgEquipmentAdd()
    {
        $title = 'Equipments | CBG';
        $agency = DB::table('agency')->get();
        return view('backend.report.cbg.cbg_equipment_add', compact('title', 'agency'));
    }


    // ************************************************************************************************************************************************
    // ************************************************************************************************************************************************
    // **************************************************** FUNCTIONALITIES ***************************************************************************
    // ************************************************************************************************************************************************
    // ************************************************************************************************************************************************


    public function AddProgramPersonnel(Request $request)
    {
        $request->validate([
            'moreFields.*.programID' => 'required'
        ]);

        foreach ($request->moreFields as $key => $value) {

            Personnel::create($value);
            $notification = array(
                'message' => 'Personnel(s) Successfully Added!',
                'alert-type' => 'success'
            );
        }
        return back()->with($notification);
    }
}
