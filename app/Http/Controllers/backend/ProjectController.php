<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Personnel;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Response;

class ProjectController extends Controller
{
    // show all projects
    public function AddProject(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['programID'] = $request->programID;
        $data['project_fund_code'] = $request->project_fund_code;
        $data['project_funding_years'] = $request->project_funding_years;
        $data['project_funding_duration'] = $request->project_funding_duration;
        $data['project_title'] = $request->project_title;
        $data['project_status'] = $request->project_status;
        $data['project_category'] = $request->project_category;
        $data['project_agency'] = $request->project_agency;
        $data['project_implementing_agency'] = json_encode($request->project_implementing_agency);
        $data['project_research_center'] = htmlspecialchars_decode(json_encode($request->project_research_center));
        $data['project_start_date'] = $request->project_start_date;
        $data['project_end_date'] = $request->project_end_date;
        $data['project_leader'] = $request->project_leader;
        $data['project_assistant_leader'] = $request->project_assistant_leader;
        $data['project_extend_date'] = $request->project_extend_date;
        $data['project_description'] = $request->project_description;
        $data['project_approved_budget'] = str_replace(',', '', $request->project_approved_budget);
        $data['project_amount_released'] =  str_replace(',', '', $request->project_amount_released);
        $data['project_budget_year'] = $request->project_budget_year;
        $data['project_form_of_development'] = $request->project_form_of_development;
        $data['keywords'] = htmlspecialchars_decode(json_encode($request->keywords));
        $data['created_at'] = now();

        $insert = DB::table('projects')->insert($data);
        if ($insert) {
            return response()->json(['success' => 'Project Successfully Added!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function editProject($id)
    {
        $title = 'Projects | RDMC';
        $projects = DB::table('projects')->where('id', $id)->first();
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();
        $programs = DB::table('programs')->leftJoin('projects', 'programs.programID', '=', 'projects.programID')
            ->select('programs.*')
            ->where('projects.id', $id)
            ->first();

        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->get();

        $researchers_filter = DB::table('researchers')
            ->where('agency',  auth()->user()->agencyID)
            ->get();


        return view(
            'backend.report.rdmc.rdmc_projects_under_program_edit',
            compact(
                'title',
                'projects',
                'agency',
                'programs',
                'researchers',
                'researchers_filter',
                'user_agency'
            )
        );
    }

    public function UpdateProject(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['programID'] = $request->programID;
        $data['project_fund_code'] = $request->project_fund_code;
        $data['project_funding_years'] = $request->project_funding_years;
        $data['project_funding_duration'] = $request->project_funding_duration;
        $data['project_title'] = $request->project_title;
        $data['project_status'] = $request->project_status;
        $data['project_category'] = $request->project_category;
        $data['project_agency'] = $request->project_agency;
        $data['project_implementing_agency'] = json_encode($request->project_implementing_agency);
        $data['project_research_center'] = htmlspecialchars_decode(json_encode($request->project_research_center));
        $data['project_start_date'] = $request->project_start_date;
        $data['project_end_date'] = $request->project_end_date;
        $data['project_leader'] = $request->project_leader;
        $data['project_assistant_leader'] = $request->project_assistant_leader;
        $data['project_extend_date'] = $request->project_extend_date;
        $data['project_description'] = $request->project_description;
        $data['project_approved_budget'] = str_replace(',', '', $request->project_approved_budget);
        $data['project_amount_released'] = str_replace(',', '', $request->project_amount_released);
        $data['project_budget_year'] = $request->project_budget_year;
        $data['project_form_of_development'] = $request->project_form_of_development;
        $data['keywords'] = htmlspecialchars_decode(json_encode($request->keywords));
        $data['updated_at'] = now();

        $update = DB::table('projects')->where('id', $id)->update($data);
        if ($update) {
            return response()->json(['success' => 'Project Successfully Added!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }


    public function editNoProgramProjectIndex($id)
    {
        $title = 'Projects | RDMC';
        $projects = DB::table('projects')->where('id', $id)->first();
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();

        // CMI
        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->get();

        $researchers_filter = DB::table('researchers')
            ->where('agency',  auth()->user()->agencyID)
            ->get();

        return view(
            'backend.report.rdmc.rdmc_projects_edit',
            compact(
                'title',
                'projects',
                'agency',
                'researchers',
                'researchers_filter',
                'user_agency'
            )
        );
    }


    public function viewProjectIndex($id)
    {
        $title = 'Projects | RDMC';
        // $program = DB::table('programs')->where('programID', $programID)->first();
        // $programs = DB::table('programs')->where('programID', $programID)->first();
        $projects = DB::table('projects')->where('id', $id)->get();
        $sub_projects = DB::table('sub_projects')->where('projectID', $id)->get();

        // $program_leader = DB::table('personnels')->where('role', '=', "Program Leader")->where('programID', $programID)->get();

        $personnels = DB::table('personnels')->orderByDesc("staff_name")->where('role', '=', "Staff")->where('projectID', $id)->get();
        // $all = DB::table('programs')->get();

        $agency = DB::table('projects')
            ->join('agency', 'projects.project_agency', '=', 'agency.abbrev')
            ->select('agency.*')
            ->where('projects.id', $id)
            ->first();

        // $documents = DB::table('program_files')->where('projectID', $id)->get();
        $upload_files = DB::table('files')->where('projectID', $id)->orderByDesc("created_at")->get();
        $projects = DB::table('projects')->where('id', $id)->first();

        return view('backend.report.rdmc.rdmc_view_project', compact('title', 'projects', 'agency', 'personnels', 'upload_files', 'sub_projects'));
    }

    public function InsertProjectsPersonnelIndex($id)
    {
        $title = 'Project Staff | RDMC';
        $personnel = DB::table('personnels')->where('projectID', $id)->get();
        return view('backend.projects.add_project_personnel', compact('title', 'personnel'));
    }

    public function downloadTemplate()
    {
        $file_path = storage_path("import-templates\projects-template.xlsx");
        return Response::download($file_path);
    }

    // public function downloadTemplate2()
    // {
    //     $file_path = storage_path("import-templates\under-program-projects-template.xlsx");
    //     return Response::download($file_path);
    // }

    public function AddProjectPersonnel(Request $request)
    {
        $request->validate([
            'moreFields.*.projectID' => 'required',
            'moreFields.*.staff_name' => 'required'
        ]);

        foreach ($request->moreFields as $key => $value) {

            $staffs = Personnel::create($value);
        }
        if ($staffs) {

            $notification = array(
                'message' => 'Staff(s) Successfully Added!',
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

    public function DeleteStaff($id)
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
