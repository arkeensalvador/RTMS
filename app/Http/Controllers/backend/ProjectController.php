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
        $request->validate(
            [
                // 'project_fund_code' => 'required',
                'project_funding_grant' => 'required',
                'project_title' => 'required',
                'project_status' => 'required',
                'project_category' => 'required',
                'project_agency' => 'required|array|min:1',
                'project_collaborating_agency' => 'required|array|min:1',
                'project_implementing_agency' => 'required|array|min:1',
                'project_research_center' => 'required|array|min:1',
                'project_duration' => 'required',
                'project_leader' => 'required',
                'project_description' => 'required',
                'project_amount_released' => 'required',
                'project_form_of_development' => 'required',
                'keywords' => 'required',
            ],
            [
                // 'project_fund_code.required' => 'Fund code is required!',
                'project_funding_grant.required' => 'Funding grant is required!',
                'project_title.required' => 'Title is required!',
                'project_status.required' => 'Status is required!',
                'project_category.required' => 'Category is required!',
                'project_agency.required' => 'Funding agency is required!',
                'project_collaborating_agency.required' => 'Collaborating agency is required!',
                'project_implementing_agency.required' => 'Implementing agency is required!',
                'project_research_center.required' => 'Research center is required!',
                'project_duration.required' => 'Duration is required!',
                'project_project_leader.required' => 'Program leader is required!',
                'project_description.required' => 'Description is required!',
                'project_amount_released.required' => 'Released amount is required!',
                'project_form_of_development.required' => 'Form of development is required!',
                'keywords.required' => 'Keywords is/are required!',
            ],
        );

        $data = [];
        $data['programID'] = $request->programID;
        $data['project_fund_code'] = $request->project_fund_code;
        $data['project_funding_grant'] = $request->project_funding_grant;
        $data['project_title'] = $request->project_title;
        $data['project_status'] = $request->project_status;
        $data['project_category'] = $request->project_category;
        $data['project_agency'] = json_encode($request->project_agency);
        $data['project_collaborating_agency'] = json_encode($request->project_collaborating_agency);
        $data['project_implementing_agency'] = json_encode($request->project_implementing_agency);
        $data['project_research_center'] = htmlspecialchars_decode(json_encode($request->project_research_center));
        $data['project_duration'] = $request->project_duration;
        $data['project_leader'] = $request->project_leader;
        $data['project_description'] = $request->project_description;
        $data['project_amount_released'] = $request->project_amount_released;
        $data['project_form_of_development'] = $request->project_form_of_development;
        $data['keywords'] = htmlspecialchars_decode(json_encode($request->keywords));
        $data['encoder_agency'] = auth()->user()->agencyID;
        $data['created_at'] = now();

        $insert = DB::table('projects')->insertGetId($data);

        $data_budget = [];

        foreach ($request->approved_budget as $key => $budget) {
            // $grantType = count($request->approved_budget) == 1 ? 'One-time' : 'Multi-year';
            $data_budget[] = [
                'projectID' => $insert,
                'approved_budget' => $budget,
                'budget_year' => $request->budget_year[$key],
                'grant_type' => $request->project_funding_grant,
                'created_at' => now(),
            ];
        }

        // Insert data into the 'budgets' table
        $insert_budget = DB::table('project_budget')->insert($data_budget);

        if ($insert) {
            return response()->json(['success' => 'Project Successfully Added!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function editProject($id)
    {
        $title = 'Projects | RDMC';
        $projects = DB::table('projects')
            ->where('id', $id)
            ->first();
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();
        $programs = DB::table('programs')
            ->leftJoin('projects', 'programs.programID', '=', 'projects.programID')
            ->select('programs.*')
            ->where('projects.id', $id)
            ->first();

        $budgetData = DB::table('project_budget')
            ->where('projectID', $id)
            ->get();

        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->get();

        $researchers_filter = DB::table('researchers')
            ->where('agency', auth()->user()->agencyID)
            ->get();

        return view('backend.report.rdmc.rdmc_projects_under_program_edit', compact('title', 'projects', 'agency', 'programs', 'researchers', 'researchers_filter', 'user_agency', 'budgetData'));
    }

    public function UpdateProject(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');
        $request->validate(
            [
                // 'project_fund_code' => 'required',
                'project_funding_grant' => 'required',
                'project_title' => 'required',
                'project_status' => 'required',
                'project_category' => 'required',
                'project_agency' => 'required|array|min:1',
                'project_collaborating_agency' => 'required|array|min:1',
                'project_implementing_agency' => 'required|array|min:1',
                'project_research_center' => 'required|array|min:1',
                'project_duration' => 'required',
                'project_leader' => 'required',
                'project_description' => 'required',
                'project_amount_released' => 'required',
                'project_form_of_development' => 'required',
                'keywords' => 'required',
            ],
            [
                // 'project_fund_code.required' => 'Fund code is required!',
                'project_funding_grant.required' => 'Funding grant is required!',
                'project_title.required' => 'Title is required!',
                'project_status.required' => 'Status is required!',
                'project_category.required' => 'Category is required!',
                'project_agency.required' => 'Funding agency is required!',
                'project_collaborating_agency.required' => 'Collaborating agency is required!',
                'project_implementing_agency.required' => 'Implementing agency is required!',
                'project_research_center.required' => 'Research center is required!',
                'project_duration.required' => 'Duration is required!',
                'project_project_leader.required' => 'Program leader is required!',
                'project_description.required' => 'Description is required!',
                'project_amount_released.required' => 'Released amount is required!',
                'project_form_of_development.required' => 'Form of development is required!',
                'keywords.required' => 'Keywords is/are required!',
            ],
        );

        $data = [];
        $data['programID'] = $request->programID;
        $data['project_fund_code'] = $request->project_fund_code;
        $data['project_funding_grant'] = $request->project_funding_grant;
        $data['project_title'] = $request->project_title;
        $data['project_status'] = $request->project_status;
        $data['project_category'] = $request->project_category;
        $data['project_agency'] = json_encode($request->project_agency);
        $data['project_collaborating_agency'] = json_encode($request->project_collaborating_agency);
        $data['project_implementing_agency'] = json_encode($request->project_implementing_agency);
        $data['project_research_center'] = htmlspecialchars_decode(json_encode($request->project_research_center));
        $data['project_duration'] = $request->project_duration;
        $data['project_leader'] = $request->project_leader;
        $data['project_description'] = $request->project_description;
        $data['project_amount_released'] = $request->project_amount_released;
        $data['project_form_of_development'] = $request->project_form_of_development;
        $data['keywords'] = htmlspecialchars_decode(json_encode($request->keywords));
        $data['updated_at'] = now();

        $this->processBudgetData($request, $id);

        $update = DB::table('projects')
            ->where('id', $id)
            ->update($data);

        if ($update) {
            return response()->json(['success' => 'Project Successfully Updated!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    private function processBudgetData(Request $request, $id)
    {
        // Retrieve existing data for the specified projectID
        $existingData = DB::table('project_budget')
            ->where('projectID', $id)
            ->get();

        $data_update = [];

        foreach ($existingData as $key => $existing) {
            // $grantType = count($existingData) == 1 ? 'One-time' : 'Multi-year';
            $data_update[] = [
                'id' => $existing->id, // Assuming there is an 'id' column
                'approved_budget' => $request->approved_budget[$key],
                'grant_type' => $request->project_funding_grant,
                'budget_year' => $request->budget_year[$key],
            ];
        }

        // Update existing data in the 'budgets' table based on programID
        foreach ($data_update as $item) {
            DB::table('project_budget')
                ->where('id', $item['id'])
                ->update([
                    'approved_budget' => $item['approved_budget'],
                    'budget_year' => $item['budget_year'],
                    'grant_type' => $item['grant_type'],
                    'updated_at' => now(),
                ]);
        }

        // Insert new data into the 'budgets' table
        if ($request->has('new_approved_budget')) {
            foreach ($request->new_approved_budget as $key => $newBudget) {
                // $grantType = count($request->approved_budget) >= 1 ? 'Multi-year' : 'One-time';
                DB::table('project_budget')->insert([
                    'projectID' => $id,
                    'approved_budget' => $newBudget,
                    'budget_year' => $request->new_budget_year[$key],
                    'grant_type' => $request->project_funding_grant,
                    'created_at' => now(),
                ]);
            }
        }
    }

    public function editNoProgramProjectIndex($id)
    {
        $title = 'Projects | RDMC';
        $projects = DB::table('projects')
            ->where('id', $id)
            ->first();
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();

        $budgetData = DB::table('project_budget')
            ->where('projectID', $id)
            ->get();

        // CMI
        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->get();

        $researchers_filter = DB::table('researchers')
            ->where('agency', auth()->user()->agencyID)
            ->get();

        return view('backend.report.rdmc.rdmc_projects_edit', compact('title', 'projects', 'agency', 'researchers', 'researchers_filter', 'user_agency', 'budgetData'));
    }

    public function viewProjectIndex($id)
    {
        $title = 'Projects | RDMC';
        // $program = DB::table('programs')->where('programID', $programID)->first();
        // $programs = DB::table('programs')->where('programID', $programID)->first();
        $projects = DB::table('projects')
            ->where('id', $id)
            ->first();

        $budgetData = DB::table('project_budget')
            ->where('projectID', $id)
            ->get();

        $sub_projects = DB::table('sub_projects')
            ->where('projectID', $id)
            ->get();

        $project_leader = DB::table('researchers')
            ->where('id', '=', $projects->project_leader)
            ->first();
        // $program_leader = DB::table('personnels')->where('role', '=', "Program Leader")->where('programID', $programID)->get();

        $personnels = DB::table('personnels')
            ->orderByDesc('staff_name')
            ->where('role', '=', 'Staff')
            ->where('projectID', $id)
            ->get();
        // $all = DB::table('programs')->get();

        $agency = DB::table('projects')
            ->join('agency', 'projects.project_agency', '=', 'agency.abbrev')
            ->select('agency.*')
            ->where('projects.id', $id)
            ->first();

        // $documents = DB::table('program_files')->where('projectID', $id)->get();
        $upload_files = DB::table('files')
            ->where('projectID', $id)
            ->orderByDesc('created_at')
            ->get();
        $projects = DB::table('projects')
            ->where('id', $id)
            ->first();

        return view('backend.report.rdmc.rdmc_view_project', compact('title', 'projects', 'agency', 'personnels', 'upload_files', 'sub_projects', 'project_leader', 'budgetData'));
    }

    public function InsertProjectsPersonnelIndex($id)
    {
        $title = 'Project Staff | RDMC';
        $personnel = DB::table('personnels')
            ->where('projectID', $id)
            ->get();
        return view('backend.projects.add_project_personnel', compact('title', 'personnel'));
    }

    public function downloadTemplate()
    {
        $file_path = storage_path('import-templates\projects-template.xlsx');
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
            'moreFields.*.staff_name' => 'required',
        ]);

        foreach ($request->moreFields as $key => $value) {
            $staffs = Personnel::create($value);
        }
        if ($staffs) {
            $notification = [
                'message' => 'Staff(s) Successfully Added!',
                'alert-type' => 'success',
            ];

            return redirect()
                ->route('rdmcProjects')
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('rdmcProjects')
                ->with($notification);
        }
    }

    public function DeleteProject($id)
    {
        $delete = DB::table('projects')
            ->where('id', $id)
            ->delete();
        if ($delete) {
            $notification = [
                'message' => 'Project Successfully Deleted!',
                'alert-type' => 'success',
            ];
            return redirect()
                ->back()
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->back()
                ->with($notification);
        }
    }

    public function DeleteStaff($id)
    {
        $delete = DB::table('personnels')
            ->where('id', $id)
            ->delete();
        if ($delete) {
            $notification = [
                'message' => 'Staff Successfully Deleted!',
                'alert-type' => 'success',
            ];
            return redirect()
                ->back()
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->back()
                ->with($notification);
        }
    }

    public function delete_budget($id)
    {
        $delete = DB::table('project_budget')
            ->where('id', $id)
            ->delete();

        if ($delete) {
            $notification = [
                'message' => 'Budget Successfully Deleted!',
                'alert-type' => 'success',
            ];
            return redirect()
                ->back()
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->back()
                ->with($notification);
        }
    }
}
