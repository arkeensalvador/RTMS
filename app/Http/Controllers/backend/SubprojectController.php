<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SubprojectController extends Controller
{

   
    public function AddSubProject(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['projectID'] = $request->projectID;
        $data['sub_project_fund_code'] = $request->sub_project_fund_code;
        $data['sub_project_funding_years'] = $request->sub_project_funding_years;
        $data['sub_project_funding_duration'] = $request->sub_project_funding_duration;
        $data['sub_project_title'] = $request->sub_project_title;
        $data['sub_project_status'] = $request->sub_project_status;
        $data['sub_project_category'] = $request->sub_project_category;
        $data['sub_project_agency'] = $request->sub_project_agency;
        $data['sub_project_start_date'] = $request->sub_project_start_date;
        $data['sub_project_end_date'] = $request->sub_project_end_date;
        $data['sub_project_leader'] = $request->sub_project_leader;
        $data['sub_project_assistant_leader'] = $request->sub_project_assistant_leader;
        $data['sub_project_extend_date'] = $request->sub_project_extend_date;
        $data['sub_project_description'] = $request->sub_project_description;
        $data['sub_project_approved_budget'] = $request->sub_project_approved_budget;
        $data['sub_project_amount_released'] = $request->sub_project_amount_released;
        $data['sub_project_budget_year'] = $request->sub_project_budget_year;
        $data['sub_project_form_of_development'] = $request->sub_project_form_of_development;
        $data['created_at'] = now();

        $insert = DB::table('sub_projects')->insert($data);
        if ($insert) {
            $notification = array(
                'message' => 'Sub-Project Successfully Added!',
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

    public function editSubProject($id)
    {
        $title = 'Sub-projects | RDMC';
        $projects = DB::table('projects')->where('id', $id)->first();
        $agency = DB::table('agency')->get();

        $program = DB::table('programs')->leftJoin('projects', 'programs.programID', '=', 'projects.programID')
            ->select('programs.*')
            ->where('projects.id', $id)
            ->first();
        return view('backend.report.rdmc.rdmc_projects_under_program_edit', compact('title', 'projects', 'agency', 'program'));
    }

    public function UpdateProject(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['projectID'] = $request->projectID;
        $data['sub_project_fund_code'] = $request->sub_project_fund_code;
        $data['sub_project_funding_years'] = $request->sub_project_funding_years;
        $data['sub_project_funding_duration'] = $request->sub_project_funding_duration;
        $data['sub_project_title'] = $request->sub_project_title;
        $data['sub_project_status'] = $request->sub_project_status;
        $data['sub_project_category'] = $request->sub_project_category;
        $data['sub_project_agency'] = $request->sub_project_agency;
        $data['sub_project_start_date'] = $request->sub_project_start_date;
        $data['sub_project_end_date'] = $request->sub_project_end_date;
        $data['sub_project_leader'] = $request->sub_project_leader;
        $data['sub_project_assistant_leader'] = $request->sub_project_assistant_leader;
        $data['sub_project_extend_date'] = $request->sub_project_extend_date;
        $data['sub_project_description'] = $request->sub_project_description;
        $data['sub_project_approved_budget'] = $request->sub_project_approved_budget;
        $data['sub_project_amount_released'] = $request->sub_project_amount_released;
        $data['sub_project_budget_year'] = $request->sub_project_budget_year;
        $data['sub_project_form_of_development'] = $request->sub_project_form_of_development;
        $data['updated_at'] = now();

        $insert = DB::table('sub_projects')->where('id', $id)->update($data);
        if ($insert) {

            $notification = array(
                'message' => 'Sub-Project Successfully Updated!',
                'alert-type' => 'success'
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

    public function viewProjectIndex($id)
    {
        $title = 'Sub-projects | RDMC';
        // $program = DB::table('programs')->where('programID', $programID)->first();
        // $programs = DB::table('programs')->where('programID', $programID)->first();
        $projects = DB::table('projects')->where('id', $id)->get();

        // $program_leader = DB::table('personnels')->where('role', '=', "Program Leader")->where('programID', $programID)->get();

        $personnels = DB::table('personnels')->orderByDesc("staff_name")->where('role', '=', "Staff")->where('projectID', $id)->get();
        // $all = DB::table('programs')->get();

        $agency = DB::table('projects')
            ->rightJoin('agency', 'projects.project_agency', '=', 'agency.abbrev')
            ->select('agency.agency_name')
            ->first();

        // $documents = DB::table('program_files')->where('projectID', $id)->get();
        $upload_files = DB::table('files')->where('projectID', $id)->orderByDesc("created_at")->get();
        $projects = DB::table('projects')->where('id', $id)->first();

        return view('backend.projects.view_projects', compact('title', 'projects', 'agency', 'personnels', 'upload_files'));
    }

    public function InsertProjectsPersonnelIndex($id)
    {
        $title = 'Sub-project Staff | RDMC';
        $personnel = DB::table('personnels')->where('projectID', $id)->get();
        return view('backend.projects.add_project_personnel', compact('title', 'personnel'));
    }

    public function downloadTemplate()
    {
        $file_path = storage_path("app\public\import-templates\projects-template.xlsx");
        return Response::download($file_path);
    }

   
}
