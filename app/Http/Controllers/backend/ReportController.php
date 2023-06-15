<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
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
        $agency = DB::table('programs')
            ->rightJoin('agency', 'programs.agencyID', '=', 'agency.abbrev')
            ->select('agency.agency_name', 'agency.abbrev')
            ->first();
        return view('backend.report.report_index', compact('agency'));
    }
    public function rdmcIndex()
    {
        return view('backend.report.rdmc.rdmc_index');
    }

    public function monitoringEvaluation()
    {
        return view('backend.report.rdmc.monitoring_index');
    }

    public function rdmcProjects()
    {
        return view('backend.report.rdmc.rdmc_projects');
    }

    public function rdmcProgramsIndex()
    {
        $agency = DB::table('agency')->get();
        $all = DB::table('programs')
            ->select('*')
            ->orderByDesc("id")
            ->limit(1)
            ->get();

        return view('backend.report.rdmc.rdmc_programs', compact('all','agency'));
    }

    public function rdmcChooseProgram()
    {
        $programs = DB::table('programs')
            ->select('*')
            ->orderByDesc("id")
            ->get();
        return view('backend.report.rdmc.rdmc_program_chooser', compact('programs'));
    }
    public function rdmcCreateProgram()
    {
        return view('backend.report.rdmc.rdmc_create_program');
    }
    public function projectsAdd()
    {
        return view('backend.report.rdmc.rdmc_projects_add');
    }

    public function projectsUnderProgramAdd($programID)
    {
        $program = DB::table('programs')->where('programID', $programID)->first();
        return view('backend.report.rdmc.rdmc_projects_under_program_add', compact('program'));
    }
    public function subProjectsAdd()
    {
        return view('backend.report.rdmc.rdmc_sub_project_add');
    }

    public function activitiesAdd()
    {
        return view('backend.report.rdmc.rdmc_activities_add');
    }

    public function rdmcActivities()
    {
        return view('backend.report.rdmc.rdmc_activities');
    }
    public function rdmcAddActivities()
    {
        return view('backend.report.rdmc.rdmc_activities_add');
    }

    public function aihrsIndex()
    {
        return view('backend.report.rdmc.aihrs_index');
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
        $data['category'] = $request->category;
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
    
}
