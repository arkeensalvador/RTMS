<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Personnel;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Redirector;

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
                'alert-type' => 'success'
            );

            return redirect()->route('subProjectsView', [$data['projectID']])->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('subProjectsView', [$data['projectID']])->with($notification);
        }
    }

    public function editSubProject($projectID, $id)
    {
        $title = 'Sub-projects | RDMC';
        $sub_project = DB::table('sub_projects')->where('id', $id)->first();
        $agency = DB::table('agency')->get();

        $sub_projects = DB::table('projects')->leftJoin('sub_projects', 'projects.id', '=', 'sub_projects.projectID')
            ->select('projects.*')
            ->where('projects.id', $projectID)
            ->first();
        return view('backend.report.rdmc.rdmc_sub_projects_edit', compact('title', 'sub_projects', 'agency', 'sub_project'));
    }

    public function UpdateSubProject(Request $request, $projectID, $id)
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

        $insert = DB::table('sub_projects')->where('projectID', $projectID)->where('id', $id)->update($data);
        if ($insert) {
            $notification = array(
                'message' => 'Sub-Project Successfully Updated!',
                'alert-type' => 'success'
            );

            return redirect()->route('subProjectsView', [$projectID])->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('subProjectsView', [$projectID])->with($notification);

        }
    }

    public function viewSubProjectIndex($id)
    {
        $title = 'Sub-projects | RDMC';
        // $program = DB::table('programs')->where('programID', $programID)->first();
        // $programs = DB::table('programs')->where('programID', $programID)->first();
        $sub_projects = DB::table('sub_projects')->where('projectID', $id)->get();

        // $program_leader = DB::table('personnels')->where('role', '=', "Program Leader")->where('programID', $programID)->get();

        // $personnels = DB::table('personnels')->orderByDesc("staff_name")->where('role', '=', "Staff")->where('projectID', $id)->get();
        // $all = DB::table('programs')->get();

        $agency = DB::table('projects')
            ->rightJoin('agency', 'projects.project_agency', '=', 'agency.abbrev')
            ->select('agency.agency_name')
            ->first();

        // $documents = DB::table('program_files')->where('projectID', $id)->get();
        // $upload_files = DB::table('files')->where('projectID', $id)->orderByDesc("created_at")->get();
        // $projects = DB::table('projects')->where('id', $id)->first();

        // return view('backend.projects.view_projects', compact('title', 'projects'));
        return view('backend.projects.view_projects', compact('title', 'sub_projects'));
    }

    public function viewSubProject($projectID, $id)
    {
        $title = 'Sub-project | RDMC';
        $sub_projects = DB::table('sub_projects')->where('id', $id)->first();
        $sub_project_leader = DB::table('personnels')->where('role', '=', "Project Leader")->where('projectID', $projectID)->orWhere('id', $id)->first();

        $personnels = DB::table('personnels')->orderByDesc("staff_name")->where('role', '=', "Staff")->where('projectID', $projectID)->where('subprojectID', $id)->get();

        $upload_files = DB::table('files')->where('subprojectID', $id)->orderByDesc("created_at")->get();

        $agency = DB::table('sub_projects')
            ->rightJoin('agency', 'sub_projects.sub_project_agency', '=', 'agency.abbrev')
            ->select('agency.agency_name')
            ->first();

        return view('backend.report.rdmc.rdmc_view_sub_project', compact('title', 'sub_projects', 'agency', 'sub_project_leader', 'personnels', 'upload_files'));
    }

    public function InsertSubProjectsPersonnelIndex($projectID, $id)
    {
        $title = 'Sub-project Staff | RDMC';
        $personnel = DB::table('personnels')->where('projectID', $projectID)->orWhere('id', $id)->get();
        return view('backend.report.rdmc.rdmc_sub_project_personnel_index', compact('title', 'personnel'));
    }

    public function AddSubProjectPersonnel(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        $request->validate([
            'moreFields.*.projectID' => 'required',
            'moreFields.*.subprojectID' => 'required'
        ]);

        foreach ($request->moreFields as $key => $value) {

            $staffs = Personnel::create($value);
        }
        if ($staffs) {

            $notification = array(
                'message' => 'Staff(s) Successfully Updated!',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('rdmcProjects')->with($notification);
        }
    }

    public function downloadTemplate()
    {
        $file_path = storage_path("app\public\import-templates\subprojects-template.xlsx");
        return Response::download($file_path);
    }

    public function DeleteSubProject($id)
    {
        $delete = DB::table('sub_projects')->where('id', $id)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Sub-Project Successfully Deleted!',
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

    public function DeleteSPStaff($id)
    {
        $delete = DB::table('personnels')->where('id', $id)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Staff Successfully Deleted!',
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
