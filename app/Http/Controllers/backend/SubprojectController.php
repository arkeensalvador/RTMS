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
        $request->validate(
            [
                // 'sub_project_fund_code' => 'required',
                'sub_project_funding_grant' => 'required',
                'sub_project_title' => 'required',
                'sub_project_status' => 'required',
                'sub_project_category' => 'required',
                'sub_project_agency' => 'required',
                'sub_project_collaborating_agency' => 'required',
                'sub_project_implementing_agency' => 'required',
                'sub_project_research_center' => 'required',
                'sub_project_duration' => 'required',
                'sub_project_leader' => 'required',
                'sub_project_description' => 'required',
                'sub_project_amount_released' => 'required',
                'sub_project_form_of_development' => 'required',
                'keywords' => 'required',
            ],
            [
                // 'sub_project_fund_code.required' => 'Fund code is required!',
                'sub_project_funding_grant.required' => 'Funding duration is required!',
                'sub_project_title.required' => 'Title is required!',
                'sub_project_status.required' => 'Status is required!',
                'sub_project_category.required' => 'Category is required!',
                'sub_project_agency.required' => 'Funding agency is required!',
                'sub_project_collaborating_agency.required' => 'Collaborating agency is required!',
                'sub_project_implementing_agency.required' => 'Implementing agency is required!',
                'sub_project_research_center.required' => 'Research center is required!',
                'sub_project_duration.required' => 'Date is required!',
                'sub_project_project_leader.required' => 'Program leader is required!',
                'sub_project_description.required' => 'Description is required!',
                'sub_project_amount_released.required' => 'Released amount is required!',
                'sub_project_form_of_development.required' => 'Form of development is required!',
                'keywords.required' => 'Keywords is/are required!',
            ],
        );

        $data = [];
        $data['programID'] = $request->programID;
        $data['projectID'] = $request->projectID;
        $data['sub_project_fund_code'] = $request->sub_project_fund_code;
        $data['sub_project_funding_grant'] = $request->sub_project_funding_grant;
        $data['sub_project_title'] = $request->sub_project_title;
        $data['sub_project_status'] = $request->sub_project_status;
        $data['sub_project_category'] = $request->sub_project_category;
        $data['sub_project_agency'] = json_encode($request->sub_project_agency);
        $data['sub_project_collaborating_agency'] = json_encode($request->sub_project_collaborating_agency);
        $data['sub_project_implementing_agency'] = json_encode($request->sub_project_implementing_agency);
        $data['sub_project_research_center'] = htmlspecialchars_decode(json_encode($request->sub_project_research_center));
        $data['sub_project_duration'] = $request->sub_project_duration;
        $data['sub_project_leader'] = $request->sub_project_leader;
        $data['sub_project_description'] = $request->sub_project_description;
        $data['sub_project_amount_released'] = $request->sub_project_amount_released;
        $data['sub_project_form_of_development'] = $request->sub_project_form_of_development;
        $data['keywords'] = htmlspecialchars_decode(json_encode($request->keywords));
        $data['encoder_agency'] = auth()->user()->agencyID;
        $data['created_at'] = now();

        $insert = DB::table('sub_projects')->insertGetId($data);

        $data_budget = [];

        foreach ($request->approved_budget as $key => $budget) {
            // $grantType = count($request->approved_budget) == 1 ? 'One-time' : 'Multi-year';
            $data_budget[] = [
                'projectID' => $request->projectID,
                'sub_projectID' => $insert,
                'approved_budget' => $budget,
                'budget_year' => $request->budget_year[$key],
                'grant_type' => $request->sub_project_funding_grant,
                'created_at' => now(),
            ];
        }
        // Insert data into the 'budgets' table
        $insert_budget = DB::table('sub_project_budget')->insert($data_budget);

        if ($insert) {
            return response()->json(['success' => 'Sub-project Successfully Added!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function editSubProject($projectID, $id)
    {
        $title = 'Sub-projects | RDMC';
        $sub_project = DB::table('sub_projects')
            ->where('id', $id)
            ->first();

        $budgetData = DB::table('sub_project_budget')
            ->where('sub_projectID', $id)
            ->get();
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();

        $researchers_filter = DB::table('researchers')
            ->where('agency', auth()->user()->agencyID)
            ->get();

        $sub_projects = DB::table('projects')
            ->leftJoin('sub_projects', 'projects.id', '=', 'sub_projects.projectID')
            ->select('projects.*')
            ->where('projects.id', $projectID)
            ->first();

        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->get();
        return view('backend.report.rdmc.rdmc_sub_projects_edit', compact('title', 'sub_projects', 'agency', 'sub_project', 'researchers', 'user_agency', 'budgetData', 'researchers_filter'));
    }

    public function UpdateSubProject(Request $request, $projectID, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');
        $request->validate(
            [
                // 'sub_project_fund_code' => 'required',
                'sub_project_funding_grant' => 'required',
                'sub_project_title' => 'required',
                'sub_project_status' => 'required',
                'sub_project_category' => 'required',
                'sub_project_agency' => 'required',
                'sub_project_collaborating_agency' => 'required',
                'sub_project_implementing_agency' => 'required',
                'sub_project_research_center' => 'required',
                'sub_project_duration' => 'required',
                'sub_project_leader' => 'required',
                'sub_project_description' => 'required',
                'sub_project_amount_released' => 'required',
                'sub_project_form_of_development' => 'required',
                'keywords' => 'required',
            ],
            [
                // 'sub_project_fund_code.required' => 'Fund code is required!',
                'sub_project_funding_grant.required' => 'Funding duration is required!',
                'sub_project_title.required' => 'Title is required!',
                'sub_project_status.required' => 'Status is required!',
                'sub_project_category.required' => 'Category is required!',
                'sub_project_agency.required' => 'Funding agency is required!',
                'sub_project_collaborating_agency.required' => 'Collaborating agency is required!',
                'sub_project_implementing_agency.required' => 'Implementing agency is required!',
                'sub_project_research_center.required' => 'Research center is required!',
                'sub_project_duration.required' => 'Date is required!',
                'sub_project_project_leader.required' => 'Program leader is required!',
                'sub_project_description.required' => 'Description is required!',
                'sub_project_amount_released.required' => 'Released amount is required!',
                'sub_project_form_of_development.required' => 'Form of development is required!',
                'keywords.required' => 'Keywords is/are required!',
            ],
        );

        $data = [];
        $data['programID'] = $request->programID;
        $data['projectID'] = $request->projectID;
        $data['sub_project_fund_code'] = $request->sub_project_fund_code;
        $data['sub_project_funding_grant'] = $request->sub_project_funding_grant;
        $data['sub_project_title'] = $request->sub_project_title;
        $data['sub_project_status'] = $request->sub_project_status;
        $data['sub_project_category'] = $request->sub_project_category;
        $data['sub_project_agency'] = json_encode($request->sub_project_agency);
        $data['sub_project_collaborating_agency'] = json_encode($request->sub_project_collaborating_agency);
        $data['sub_project_implementing_agency'] = json_encode($request->sub_project_implementing_agency);
        $data['sub_project_research_center'] = htmlspecialchars_decode(json_encode($request->sub_project_research_center));
        $data['sub_project_duration'] = $request->sub_project_duration;
        $data['sub_project_leader'] = $request->sub_project_leader;
        $data['sub_project_description'] = $request->sub_project_description;
        $data['sub_project_amount_released'] = $request->sub_project_amount_released;
        $data['sub_project_form_of_development'] = $request->sub_project_form_of_development;
        $data['keywords'] = htmlspecialchars_decode(json_encode($request->keywords));
        $data['updated_at'] = now();

        $this->processBudgetData($request, $projectID, $id);

        $update = DB::table('sub_projects')
            ->where('projectID', $projectID)
            ->where('id', $id)
            ->update($data);

        if ($update) {
            return response()->json(['success' => 'Sub-project Successfully Updated!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    private function processBudgetData(Request $request, $projectID, $id)
    {
        // Retrieve existing data for the specified projectID
        $existingData = DB::table('sub_project_budget')
            ->where('sub_projectID', $id)
            ->get();

        $data_update = [];

        foreach ($existingData as $key => $existing) {
            // $grantType = count($existingData) == 1 ? 'One-time' : 'Multi-year';
            $data_update[] = [
                'id' => $existing->id, // Assuming there is an 'id' column
                'approved_budget' => $request->approved_budget[$key],
                'grant_type' => $request->sub_project_funding_grant,
                'budget_year' => $request->budget_year[$key],
            ];
        }

        // Update existing data in the 'budgets' table based on programID
        foreach ($data_update as $item) {
            DB::table('sub_project_budget')
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
                DB::table('sub_project_budget')->insert([
                    'projectID' => $projectID,
                    'sub_projectID' => $id,
                    'approved_budget' => $newBudget,
                    'budget_year' => $request->new_budget_year[$key],
                    'grant_type' => $request->sub_project_funding_grant,
                    'created_at' => now(),
                ]);
            }
        }
    }

    public function viewSubProject($projectID, $id)
    {
        $title = 'Sub-project | RDMC';

        $sub_projects = DB::table('sub_projects')
            ->where('id', $id)
            ->first();

        $sub_project_leader = DB::table('researchers')
            ->where('id', '=', $sub_projects->sub_project_leader)
            ->first();

        $budgetData = DB::table('sub_project_budget')
            ->where('projectID', $projectID)
            ->where('sub_projectID', $id)
            ->get();

        $personnels = DB::table('personnels')
            ->orderByDesc('staff_name')
            ->where('role', '=', 'Staff')
            ->where('subprojectID', $id)
            ->get();

        $upload_files = DB::table('files')
            ->where('subprojectID', $id)
            ->orderByDesc('created_at')
            ->get();

        $agency = DB::table('sub_projects')
            ->rightJoin('agency', 'sub_projects.sub_project_agency', '=', 'agency.abbrev')
            ->select('agency.*')
            ->where('sub_projects.id', $id)
            ->first();

        return view('backend.report.rdmc.rdmc_view_sub_project', compact('title', 'sub_projects', 'agency', 'sub_project_leader', 'personnels', 'upload_files', 'budgetData'));
    }

    public function InsertSubProjectsPersonnelIndex($id)
    {
        $title = 'Sub-project Staff | RDMC';
        $personnel = DB::table('personnels')
            ->where('subprojectID', $id)
            ->get();
        return view('backend.report.rdmc.rdmc_sub_project_personnel_index', compact('title', 'personnel'));
    }

    public function AddSubProjectPersonnel(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        $request->validate([
            'moreFields.*.subprojectID' => 'required',
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
                ->back()
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

    public function downloadTemplate()
    {
        $file_path = storage_path('import-templates/subprojects-template.xlsx');
        return Response::download($file_path);
    }

    public function DeleteSubProject($id)
    {
        $delete = DB::table('sub_projects')
            ->where('id', $id)
            ->delete();
        if ($delete) {
            $notification = [
                'message' => 'Sub-Project Successfully Deleted!',
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

    public function DeleteSPStaff($id)
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
        $delete = DB::table('sub_project_budget')
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
