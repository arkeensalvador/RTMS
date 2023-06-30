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
        return view('backend.report.rdmc.rdmc_create_program', compact('title'));
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

    public function activitiesAdd()
    {
        $title = 'Activities | RDMC';
        return view('backend.report.rdmc.rdmc_activities_add');
    }

    public function rdmcActivities()
    {
        $title = 'Activities | RDMC';
        return view('backend.report.rdmc.rdmc_activities', compact('title'));
    }
    public function rdmcAddActivities()
    {
        $title = 'Activities | RDMC';
        return view('backend.report.rdmc.rdmc_activities_add', compact('title'));
    }

    public function aihrsIndex()
    {
        $title = 'Agency In-House Reviews (AIHRs) | RDMC';
        return view('backend.report.rdmc.aihrs_index',compact('title'));
    }

    public function linkagesIndex()
    {
        return view('backend.report.rdmc.rdmc_linkages_index');
    }
    public function linkagesAddIndex()
    {
        return view('backend.report.rdmc.rdmc_linkages_add');
    }
    public function dbInfoSys()
    {
        return view('backend.report.rdmc.rdmc_dbinfosys_index');
    }
    public function dbInfoSysAdd()
    {
        return view('backend.report.rdmc.rdmc_dbinfosys_add');
    }

    public function strategicActivities()
    {
        return view('backend.report.strategic.strategic_activities');
    }

    public function addStrategicActivities()
    {
        return view('backend.report.strategic.add_strategic_activities');
    }

    public function rdruIndex()
    {
        return view('backend.report.rdru.rdru_index');
    }

    public function rdruList()
    {
        return view('backend.report.rdru.rdru_list');
    }

    public function rdruAdd()
    {
        return view('backend.report.rdru.rdru_add');
    }
    public function rdruTtm()
    {
        return view('backend.report.rdru.rdru_ttm');
    }
    public function rdruTtmAdd()
    {
        return view('backend.report.rdru.rdru_ttm_add');
    }
    public function rdruTpa()
    {
        return view('backend.report.rdru.rdru_tpa');
    }
    public function rdruTpaAdd()
    {
        return view('backend.report.rdru.rdru_tpa_add');
    }

    public function cbgIndex()
    {
        return view('backend.report.cbg.cbg_index');
    }

    public function cbgTraining()
    {
        return view('backend.report.cbg.cbg_training');
    }

    public function cbgAwards()
    {
        return view('backend.report.cbg.cbg_awards');
    }

    public function cbgEquipment()
    {
        return view('backend.report.cbg.cbg_equipment');
    }

    public function cbgTrainingAdd()
    {
        return view('backend.report.cbg.cbg_training_add');
    }

    public function cbgAwardsAdd()
    {
        return view('backend.report.cbg.cbg_awards_add');
    }

    public function cbgEquipmentAdd()
    {
        return view('backend.report.cbg.cbg_equipment_add');
    }


    // ************************************************************************************************************************************************
    // ************************************************************************************************************************************************
    // **************************************************** FUNCTIONALITIES ***************************************************************************
    // ************************************************************************************************************************************************
    // ************************************************************************************************************************************************
    public function AddProgram(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['programID'] = $request->programID;
        $data['agencyID'] = $request->agencyID;
        $data['fundingAgencyID'] = $request->fundingAgencyID;
        $data['researcherID'] = $request->researcherID;
        $data['fund_code'] = $request->fund_code;
        $data['program_title'] = $request->program_title;
        $data['program_status'] = $request->program_status;
        $data['program_category'] = $request->program_category;
        $data['funding_agency'] = $request->funding_agency;
        $data['coordination_fund'] = $request->coordination_fund;
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $data['extend_date'] = $request->extend_date;
        $data['program_leader'] = $request->program_leader;
        $data['assistant_leader'] = $request->assistant_leader;
        $data['program_description'] = $request->program_description;
        $data['approved_budget'] = $request->approved_budget;
        $data['amount_released'] = $request->amount_released;
        $data['budget_year'] = $request->budget_year;
        $data['form_of_development'] = $request->form_of_development;
        $data['created_at'] = now();

        $insert = DB::table('programs')->insert($data);
        if ($insert) {

            $notification = array(
                'message' => 'Program Successfully Added!',
                'alert-type' => 'test'
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
