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
        return view('backend.report.rdmc.monitoring.monitoring_index');
    }

    public function aihrsIndex() {
        return view('backend.report.rdmc.monitoring.aihrs.aihrs_index');
    }

    public function linkages()
    {
        return view('backend.report.linkages.linkages_index');
    }
    public function dbInfoSys()
    {
        return view('backend.report.dbinfosys.dbinfosys_index');
    }
}
