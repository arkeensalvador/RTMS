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

        // CMI
        $all_filter = DB::table('projects')
            ->select('*')
            ->where('project_implementing_agency', 'LIKE', "%" . auth()->user()->agencyID . "%")
            ->get();

        $researchers_filter = DB::table('researchers')
            ->where('agency',  auth()->user()->agencyID)
            ->get();

        $user_agency = DB::table('users')
            ->where('agencyID', auth()->user()->agencyID)
            ->get();

        return view('backend.report.rdmc.rdmc_projects', compact('title', 'projects', 'all_filter', 'researchers_filter', 'user_agency'));
    }

    public function rdmcProgramsIndex()
    {
        $title = 'Programs | RDMC';
        $agency = DB::table('agency')->get();
        $all = DB::table('programs')
            ->select('*')
            ->get();

        $researchers = DB::table('researchers')->get();

        // CMI (fetch program implementing agency even data in db is in array)
        $all_filter = DB::table('programs')
            ->select('*')
            ->where('implementing_agency', 'LIKE', "%" . auth()->user()->agencyID . "%")
            ->get();

        $researchers_filter = DB::table('researchers')
            ->where('agency',  auth()->user()->programID)
            ->get();

        $user_agency = DB::table('users')
            ->where('agencyID', auth()->user()->agencyID)
            ->first();

        return view('backend.report.rdmc.rdmc_programs', compact('all', 'agency', 'title', 'researchers', 'researchers_filter', 'all_filter', 'user_agency'));
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

        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->first();

        $researchers_filter = DB::table('researchers')
            ->where('agency',  auth()->user()->agencyID)
            ->get();

        return view('backend.report.rdmc.rdmc_create_program', compact('title', 'agency', 'researchers', 'user_agency', 'researchers_filter'));
    }
    // ADD PROJECTS WITHOUT PROGRAM
    public function projectsAdd()
    {
        $title = 'Projects | RDMC';
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();

        // CMI

        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->first();

        $researchers_filter = DB::table('researchers')
            ->where('agency',  auth()->user()->agencyID)
            ->get();

        return view('backend.report.rdmc.rdmc_projects_add', compact('title', 'agency', 'researchers', 'researchers_filter', 'user_agency'));
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

        // CMI
        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->first();

        $researchers_filter = DB::table('researchers')
            ->where('agency',  auth()->user()->agencyID)
            ->get();
        return view(
            'backend.report.rdmc.rdmc_program_projects_add',
            compact(
                'programs',
                'title',
                'agency',
                'researchers',
                'user_agency',
                'researchers_filter'
            )
        );
    }
    // ADD PROJECTS TO PROGRAM IN NOT CONTINUOUS METHOD
    public function projectsUnderProgramAdd($programID)
    {
        $title = 'Program - projects | RDMC';
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();
        $programs = DB::table('programs')->where('programID', $programID)->first();


        // CMI
        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->get();

        $researchers_filter = DB::table('researchers')
            ->where('agency',  auth()->user()->agencyID)
            ->get();

        return view(
            'backend.report.rdmc.rdmc_projects_under_program_add',
            compact(
                'programs',
                'title',
                'agency',
                'researchers',
                'user_agency',
                'researchers_filter'
            )
        );
    }

    public function projectsUnderProgramEdit($programID, $id)
    {
        $title = 'Program - projects | RDMC';
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();
        $programs = DB::table('programs')->where('programID', $programID)->first();

        // CMI
        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->first();

        $researchers_filter = DB::table('researchers')
            ->where('agency',  auth()->user()->agencyID)
            ->get();

        return view(
            'backend.report.rdmc.rdmc_projects_under_program_edit',
            compact(
                'programs',
                'title',
                'agency',
                'researchers',
                'user_agency',
                'researchers_filter'
            )
        );
    }

    public function projectsUnderProgramIndex($programID)
    {
        $title = 'Program - projects | RDMC';
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();
        $projects = DB::table('projects')->where('programID', $programID)->get();

        $program_title = DB::table('programs')
            ->select('*')
            ->where('programID', $programID)
            ->first();

        $all_filter = DB::table('programs')
            ->select('*')
            ->where('funding_agency', auth()->user()->agencyID)
            ->get();

        return view(
            'backend.report.rdmc.rdmc_projects_under_program',
            compact(
                'projects',
                'title',
                'agency',
                'researchers',
                'program_title',
                'all_filter'
            )
        );
    }
    public function subProjectsView($projectID)
    {
        $title = 'Sub-projects | RDMC';
        $sub_projects = DB::table('sub_projects')
            ->select('*')
            ->where('projectID', $projectID)
            ->orderByDesc("id")
            ->get();

        $project_title = DB::table('projects')
            ->select('*')
            ->where('id', $projectID)
            ->first();
        $agency = DB::table('agency')->get();
        return view('backend.report.rdmc.rdmc_sub_project_view_index', compact('title', 'project_title', 'sub_projects', 'agency'));
    }
    public function ProjectSubProjectsAdd($id)
    {
        $title = 'Sub-projects | RDMC';
        $projects = DB::table('projects')
            ->select('*')
            ->where('id', $id)
            ->limit(1)
            ->first();

        $researchers = DB::table('researchers')->get();
        $agency = DB::table('agency')->get();

        // CMI
        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->first();

        $researchers_filter = DB::table('researchers')
            ->where('agency',  auth()->user()->agencyID)
            ->get();

        return view(
            'backend.report.rdmc.rdmc_sub_project_add',
            compact(
                'title',
                'projects',
                'agency',
                'researchers',
                'user_agency',
                'researchers_filter'
            )
        );
    }

    public function ProjectSubProjectsAdd2()
    {
        $title = 'Sub-projects | RDMC';
        $projects = DB::table('projects')
            ->select('*')
            ->orderByDesc("id")
            ->limit(1)
            ->first();

        $researchers = DB::table('researchers')->get();
        $agency = DB::table('agency')->get();
        return view('backend.report.rdmc.rdmc_sub_project_add', compact('title', 'projects', 'agency', 'researchers'));
    }


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

        // CMI
        // Program
        $cmi_new = DB::table('programs')
            ->where('implementing_agency',  'LIKE', "%" . auth()->user()->agencyID . "%")
            ->where('program_status', '=', 'new')->count();

        $cmi_ongoing = DB::table('programs')
            ->where('implementing_agency',  'LIKE', "%" . auth()->user()->agencyID . "%")
            ->where('program_status', '=', 'ongoing')->count();

        $cmi_terminated = DB::table('programs')
            ->where('implementing_agency',  'LIKE', "%" . auth()->user()->agencyID . "%")
            ->where('program_status', '=', 'terminated')->count();

        $cmi_completed = DB::table('programs')
            ->where('implementing_agency',  'LIKE', "%" . auth()->user()->agencyID . "%")
            ->where('program_status', '=', 'completed')->count();

        // Project
        $cmi_new_proj = DB::table('projects')
            ->where('project_implementing_agency',  'LIKE', "%" . auth()->user()->agencyID . "%")
            ->where('project_status', '=', 'new')->count();

        $cmi_ongoing_proj = DB::table('projects')
            ->where('project_implementing_agency',  'LIKE', "%" . auth()->user()->agencyID . "%")
            ->where('project_status', '=', 'ongoing')->count();

        $cmi_terminated_proj = DB::table('projects')
            ->where('project_implementing_agency',  'LIKE', "%" . auth()->user()->agencyID . "%")
            ->where('project_status', '=', 'terminated')->count();

        $cmi_completed_proj = DB::table('projects')
            ->where('project_implementing_agency',  'LIKE', "%" . auth()->user()->agencyID . "%")
            ->where('project_status', '=', 'completed')->count();

        // Sub-Project
        $cmi_new_subproj = DB::table('sub_projects')
            ->where('sub_project_implementing_agency', auth()->user()->agencyID)
            ->where('sub_project_status', '=', 'new')->count();

        $cmi_ongoing_subproj = DB::table('sub_projects')
            ->where('sub_project_implementing_agency', auth()->user()->agencyID)
            ->where('sub_project_status', '=', 'ongoing')->count();

        $cmi_terminated_subproj = DB::table('sub_projects')
            ->where('sub_project_implementing_agency', auth()->user()->agencyID)
            ->where('sub_project_status', '=', 'terminated')->count();

        $cmi_completed_subproj = DB::table('sub_projects')
            ->where('sub_project_implementing_agency', auth()->user()->agencyID)
            ->where('sub_project_status', '=', 'completed')->count();


        return view(
            'backend.report.rdmc.aihrs_index',
            compact(
                'title',
                'completed',
                'new',
                'ongoing',
                'terminated',
                'completed_proj',
                'new_proj',
                'ongoing_proj',
                'terminated_proj',
                'completed_subproj',
                'new_subproj',
                'ongoing_subproj',
                'terminated_subproj',
                'cmi_completed',
                'cmi_new',
                'cmi_ongoing',
                'cmi_terminated',
                'cmi_completed_proj',
                'cmi_new_proj',
                'cmi_ongoing_proj',
                'cmi_terminated_proj',
                'cmi_completed_subproj',
                'cmi_new_subproj',
                'cmi_ongoing_subproj',
                'cmi_terminated_subproj'
            )
        );
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
        $iec = DB::table('iec_approaches')->get();
        return view('backend.report.rdru.rdru_tpa_add', compact('title', 'iec'));
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
        $programs = DB::table('programs')->get();
        return view('backend.report.cbg.cbg_awards_add', compact('title', 'agency', 'researchers', 'programs'));
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
