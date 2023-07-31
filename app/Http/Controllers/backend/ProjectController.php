<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class ProjectController extends Controller
{
    // show all projects
    public function AddProject(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['programID'] = $request->programID;
        $data['agencyID'] = $request->agencyID;
        $data['project_fund_code'] = $request->project_fund_code;
        $data['project_funding_years'] = $request->project_funding_years;
        $data['project_funding_duration'] = $request->project_funding_duration;
        $data['project_title'] = $request->project_title;
        $data['project_status'] = $request->project_status;
        $data['project_category'] = $request->project_category;
        $data['project_agency'] = $request->project_agency;
        $data['project_start_date'] = $request->project_start_date;
        $data['project_end_date'] = $request->project_end_date;
        $data['project_leader'] = $request->project_leader;
        $data['project_assistant_leader'] = $request->project_assistant_leader;
        $data['project_extend_date'] = $request->project_extend_date;
        $data['project_description'] = $request->project_description;
        $data['project_approved_budget'] = $request->project_approved_budget;
        $data['project_amount_released'] = $request->project_amount_released;
        $data['project_budget_year'] = $request->project_budget_year;
        $data['project_form_of_development'] = $request->project_form_of_development;
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

    public function DeleteProject($id)
    {
        $delete = DB::table('projects')->where('id', $id)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Project Successfully Deleted!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
