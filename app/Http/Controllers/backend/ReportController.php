<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Personnel;
use Illuminate\Http\Request;
use DB;

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
            ->rightJoin('agency', 'programs.agencyID', '=', 'agency.abbrev')
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
        return view('backend.report.rdmc.rdmc_projects', compact('title'));
    }

    public function rdmcProgramsIndex()
    {
        $title = 'Programs | RDMC';
        $agency = DB::table('agency')->get();
        $all = DB::table('programs')
            ->select('*')
            ->get();

        return view('backend.report.rdmc.rdmc_programs', compact('all', 'agency', 'title'));
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
        return view('backend.report.rdmc.rdmc_create_program', compact('title', 'agency'));
    }
    // ADD PROJECTS WITHOUT PROGRAM
    public function projectsAdd()
    {
        $title = 'Projects | RDMC';
        return view('backend.report.rdmc.rdmc_projects_add', compact('title'));
    }
    // ADD PROJECTS TO PROGRAM IN CONTINUOUS METHOD
    public function programProjectsAdd()
    {
        $title = 'Program - projects | RDMC';
        $programs = DB::table('programs')
            ->select('*')
            ->orderByDesc("id")
            ->limit(1)
            ->get();
        return view('backend.report.rdmc.rdmc_program_projects_add',compact('programs', 'title'));
    }
    // ADD PROJECTS TO PROGRAM IN NOT CONTINUOUS METHOD
    public function projectsUnderProgramAdd($programID)
    {
        $title = 'Program - projects | RDMC';
        $program = DB::table('programs')->where('programID', $programID)->first();
        return view('backend.report.rdmc.rdmc_projects_under_program_add', compact('program'));
    }
    public function subProjectsAdd()
    {
        $title = 'Sub-projects | RDMC';
        return view('backend.report.rdmc.rdmc_sub_project_add', compact('title'));
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
        return view('backend.report.rdmc.aihrs_index',compact('title'));
    }

    public function linkagesIndex()
    {
        $title = 'Linkages | RDMC';
        return view('backend.report.rdmc.rdmc_linkages_index', compact('title'));
    }
    public function linkagesAddIndex()
    {
        $title = 'Linkages | RDMC';
        return view('backend.report.rdmc.rdmc_linkages_add', compact('title'));
    }
    public function dbInfoSys()
    {
        $title = 'DBIS | RDMC';
        return view('backend.report.rdmc.rdmc_dbinfosys_index', compact('title'));
    }
    public function dbInfoSysAdd()
    {
        $title = 'DBIS | RDMC';
        return view('backend.report.rdmc.rdmc_dbinfosys_add', compact('title'));
    }

    public function strategicActivities()
    {
        $title = 'Strategic R&D Activities';
        return view('backend.report.strategic.strategic_activities', compact('title'));
    }

    public function addStrategicActivities()
    {
        $title = 'Strategic R&D Activities';
        return view('backend.report.strategic.add_strategic_activities', compact('title'));
    }

    public function rdruIndex()
    {
        $title = 'R&D Results Utilizations';
        return view('backend.report.rdru.rdru_index', compact('title'));
    }

    public function rdruTtp()
    {
        $title = 'TTP | R&D Results Utilizations';
        return view('backend.report.rdru.rdru_ttp', compact('title'));
    }

    public function rdruAdd()
    {
        $title = 'TTP | R&D Results Utilizations';
        return view('backend.report.rdru.rdru_add', compact('title'));
    }
    public function rdruTtm()
    {
        $title = 'TTM | R&D Results Utilizations';
        return view('backend.report.rdru.rdru_ttm', compact('title'));
    }
    public function rdruTtmAdd()
    {
        $title = 'TTM | R&D Results Utilizations';
        return view('backend.report.rdru.rdru_ttm_add', compact('title'));
    }
    public function rdruTpa()
    {
        $title = 'TPA | R&D Results Utilizations';
        return view('backend.report.rdru.rdru_tpa', compact('title'));
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
        return view('backend.report.cbg.cbg_training', compact('title'));
    }

    public function cbgAwards()
    {
        $title = 'Awards | CBG';
        return view('backend.report.cbg.cbg_awards', compact('title'));
    }

    public function cbgEquipment()
    {
        $title = 'Equipments | CBG';
        return view('backend.report.cbg.cbg_equipment', compact('title'));
    }

    public function cbgTrainingAdd()
    {
        $title = 'Trainings | CBG';
        return view('backend.report.cbg.cbg_training_add', compact('title'));
    }

    public function cbgAwardsAdd()
    {
        $title = 'Awards | CBG';
        return view('backend.report.cbg.cbg_awards_add', compact('title'));
    }

    public function cbgEquipmentAdd()
    {
        $title = 'Equipments | CBG';
        return view('backend.report.cbg.cbg_equipment_add', compact('title'));
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

    public function AddProjects(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['programID'] = $request->programID;
        $data['agencyID'] = $request->agencyID;
        $data['fund_code'] = $request->fund_code;
        $data['project_title'] = $request->project_title;
        $data['project_status'] = $request->project_status;
        $data['category'] = $request->project_category;
        // $data['funding_agency'] = $request->funding_agency;
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $data['extend_date'] = $request->extend_date;
        $data['project_description'] = $request->project_description;
        $data['approved_budget'] = $request->approved_budget;
        $data['amount_released'] = $request->amount_released;
        $data['budget_year'] = $request->budget_year;
        $data['form_of_development'] = $request->form_of_development;
        $data['created_at'] = now();

        $insert = DB::table('projects')->insert($data);
        if ($insert) {

            $notification = array(
                'message' => 'Project Successfully Added!',
                'alert-type' => 'project'
            );

            return redirect()->route('rdmcProjects')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('rdmcProjects')->with($notification);
        }
    }
}
