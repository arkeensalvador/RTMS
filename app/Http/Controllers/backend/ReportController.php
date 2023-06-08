<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
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
    public function rdmcChooseProgram()
    {  
        return view('backend.report.rdmc.rdmc_program_chooser');
    }
    public function rdmcCreateProgram()
    {  
        return view('backend.report.rdmc.rdmc_create_program');
    }
    public function projectsAdd()
    {
        return view('backend.report.rdmc.rdmc_projects_add');
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
        return view('backend.report.rdmc_linkages_index');
    }
    public function dbInfoSys()
    {
        return view('backend.report.rdmc_dbinfosys_index');
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
}
