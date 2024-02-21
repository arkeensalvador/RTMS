<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Google\Client;
use Google\Service\Drive;
use Illuminate\Http\Request;
use App\Models\backend\Personnel;
// use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class ProgramsController extends Controller
{
    public function AddProgram(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');
        $request->validate(
            [
                'program_title' => 'required',
                'program_status' => 'required',
                'program_category' => 'required',
                'funding_agency' => 'required|array|min:1',
                // 'collaborating_agency' => 'required|array|min:1',
                'implementing_agency' => 'required|array|min:1',
                // 'research_center' => 'required|array|min:1',
                'duration' => 'required',
                'program_leader' => 'required',
                'program_description' => 'required',
                'approved_budget' => 'required|array',
                'approved_budget.*' => 'required',
                'amount_released' => 'required',
                'budget_year' => 'required|array',
                'budget_year.*' => 'required|integer',
                'form_of_development' => 'required',
                'keywords' => 'required',
            ],
            [
                'program_title.required' => 'Title is required!',
                'program_status.required' => 'Status is required!',
                'program_category.required' => 'Category is required!',
                'funding_agency.required' => 'Funding agency is required!',
                // 'collaborating_agency.required' => 'Collaborating agency is required!',
                'implementing_agency.required' => 'Implementing agency is required!',
                // 'research_center.required' => 'Research center is required!',
                'duration.required' => 'Duration is required!',
                'program_leader.required' => 'Program leader is required!',
                'program_description.required' => 'Description is required!',
                'approved_budget.required' => 'Budget is required!',
                'approved_budget.*' => 'Budget is required!',
                'amount_released.required' => 'Released amount is required!',
                'budget_year.required' => 'Budget year is required!',
                'budget_year.*' => 'Budget year is required!',
                'form_of_development.required' => 'Form of development is required!',
                'keywords.required' => 'Keywords is/are required!',
            ],
        );

        $data = [];
        $data['programID'] = $request->programID;
        $data['fund_code'] = $request->fund_code;
        $data['program_title'] = $request->program_title;
        $data['program_status'] = $request->program_status;
        $data['program_category'] = $request->program_category;
        $data['funding_agency'] = json_encode($request->funding_agency);
        $data['collaborating_agency'] = json_encode($request->collaborating_agency);
        $data['implementing_agency'] = json_encode($request->implementing_agency);
        $data['research_center'] = htmlspecialchars_decode(json_encode($request->research_center));
        $data['duration'] = $request->duration;
        $data['program_leader'] = $request->program_leader;
        $data['program_description'] = $request->program_description;
        $data['amount_released'] = str_replace(',', '', $request->amount_released);
        $data['form_of_development'] = $request->form_of_development;
        $data['keywords'] = htmlspecialchars_decode(json_encode($request->keywords));
        $data['encoder_agency'] = auth()->user()->agencyID;
        $data['created_at'] = now();

        $data_budget = [];

        foreach ($request->approved_budget as $key => $budget) {
            $data_budget[] = [
                'programID' => $request->programID,
                'approved_budget' => str_replace(',', '', $budget),
                'budget_year' => $request->budget_year[$key],
                'created_at' => now(),
            ];
        }

        // Insert data into the 'budgets' table
        $insert_budget = DB::table('budgets')->insert($data_budget);

        $insert = DB::table('programs')->insert($data);

        if ($insert && $insert_budget) {
            return response()->json(['success' => 'Program Successfully Uploaded!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function ViewProgramIndex($programID)
    {
        $title = 'Programs | RTMS';
        $program = DB::table('programs')
            ->where('programID', $programID)
            ->first();

        // $programs = DB::table('programs')->where('programID', $programID)->first();
        $projects = DB::table('projects')
            ->where('programID', $programID)
            ->get();

        $budgetData = DB::table('budgets')
            ->where('programID', $programID)
            ->get();

        $program_leader = DB::table('researchers')
            ->where('id', '=', $program->program_leader)
            ->first();

        $personnels = DB::table('personnels')
            ->orderByDesc('staff_name')
            ->where('role', '=', 'Staff')
            ->where('programID', $programID)
            ->get();
        // $all = DB::table('programs')->get();

        $agency = DB::table('programs')
            ->join('agency', 'agency.abbrev', '=', 'programs.funding_agency')
            ->select('agency.agency_name', 'programs.funding_agency')
            ->where('programID', $programID)
            ->first();

        $upload_files = DB::table('files')
            ->where('programID', $programID)
            ->orderByDesc('created_at')
            ->get();

        return view('backend.report.rdmc.rdmc_view_program', compact('program', 'agency', 'personnels', 'program_leader', 'title', 'upload_files', 'projects', 'budgetData'));
    }

    public function EditProgramIndex($programID)
    {
        $title = 'Programs | RTMS';
        $programs = DB::table('programs')
            ->where('programID', $programID)
            ->first();
        // $program_details = DB::table('program_details')->where('programID', $programID)->first();
        $personnels = DB::table('personnels')
            ->where('programID', $programID)
            ->get();
        // $all = DB::table('programs')->get();

        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();

        $budgetData = DB::table('budgets')
            ->where('programID', $programID)
            ->get();

        $researchers_filter = DB::table('researchers')
            ->where('agency', auth()->user()->agencyID)
            ->get();

        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->get();

        return view('backend.report.rdmc.rdmc_program_edit', compact('programs', 'agency', 'personnels', 'title', 'researchers', 'researchers_filter', 'user_agency', 'budgetData'));
    }

    public function UpdateProgram(Request $request, $programID)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $request->validate(
            [
                'program_title' => 'required',
                'program_status' => 'required',
                'program_category' => 'required',
                'funding_agency' => 'required|array|min:1',
                // 'collaborating_agency' => 'required|array|min:1',
                'implementing_agency' => 'required|array|min:1',
                // 'research_center' => 'required|array|min:1',
                'duration' => 'required',
                'program_leader' => 'required',
                'program_description' => 'required',
                'approved_budget' => 'required|array',
                'approved_budget.*' => 'required',
                'amount_released' => 'required',
                'budget_year' => 'required|array',
                'budget_year.*' => 'required|integer',
                'form_of_development' => 'required',
                'keywords' => 'required',
            ],
            [
                'program_title.required' => 'Title is required!',
                'program_status.required' => 'Status is required!',
                'program_category.required' => 'Category is required!',
                'funding_agency.required' => 'Funding agency is required!',
                // 'collaborating_agency.required' => 'Collaborating agency is required!',
                'implementing_agency.required' => 'Implementing agency is required!',
                // 'research_center.required' => 'Research center is required!',
                'duration.required' => 'Duration is required!',
                'program_leader.required' => 'Program leader is required!',
                'program_description.required' => 'Description is required!',
                'approved_budget.required' => 'Budget is required!',
                'approved_budget.*' => 'Budget is required!',
                'amount_released.required' => 'Released amount is required!',
                'budget_year.required' => 'Budget year is required!',
                'budget_year.*' => 'Budget year is required!',
                'form_of_development.required' => 'Form of development is required!',
                'keywords.required' => 'Keywords is/are required!',
            ],
        );
        $data = [];
        $data['programID'] = $request->programID;
        $data['fund_code'] = $request->fund_code;
        $data['program_title'] = $request->program_title;
        $data['program_status'] = $request->program_status;
        $data['program_category'] = $request->program_category;
        $data['funding_agency'] = json_encode($request->funding_agency);
        $data['collaborating_agency'] = json_encode($request->collaborating_agency);
        $data['implementing_agency'] = json_encode($request->implementing_agency);
        $data['research_center'] = htmlspecialchars_decode(json_encode($request->research_center));
        $data['duration'] = $request->duration;
        $data['program_leader'] = $request->program_leader;
        $data['program_description'] = $request->program_description;
        $data['amount_released'] = str_replace(',', '', $request->amount_released);
        // $data['budget_year'] = $request->budget_year;
        $data['form_of_development'] = $request->form_of_development;
        $data['keywords'] = htmlspecialchars_decode(json_encode($request->keywords));
        $data['updated_at'] = now();

        // Retrieve existing data for the specified programID
        $existingData = DB::table('budgets')
            ->where('programID', $programID)
            ->get();

        // Prepare data for update
        $data_update = [];

        foreach ($existingData as $key => $existing) {
            $data_update[] = [
                'id' => $existing->id, // Assuming there is an 'id' column
                'approved_budget' => str_replace(',', '', $request->approved_budget[$key]),
                'budget_year' => $request->budget_year[$key],
            ];
        }

        // Update existing data in the 'budgets' table based on programID
        foreach ($data_update as $item) {
            DB::table('budgets')
                ->where('id', $item['id'])
                ->update([
                    'approved_budget' => str_replace(',', '', $item['approved_budget']),
                    'budget_year' => $item['budget_year'],
                    'updated_at' => now(),
                ]);
        }

        // Insert new data into the 'budgets' table
        if ($request->has('new_approved_budget')) {
            foreach ($request->new_approved_budget as $key => $newBudget) {
                DB::table('budgets')->insert([
                    'programID' => $programID,
                    'approved_budget' => str_replace(',', '', $newBudget),
                    'budget_year' => $request->new_budget_year[$key],
                    'created_at' => now(),
                ]);
            }
        }

        $insert = DB::table('programs')
            ->where('programID', $programID)
            ->update($data);

        if ($insert) {
            return response()->json(['success' => 'Program Successfully Updated!']);
        } else {
            return response()->json(['error' => 'There is something wrongs...']);
        }
    }

    public function delete_budget($id)
    {
        $delete = DB::table('budgets')
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

    public function UploadProgramFilesIndex($id)
    {
        $title = 'Programs | RTMS';
        $program = DB::table('programs')
            ->where('id', $id)
            ->first();
        $upload_files = DB::table('program_files')
            ->where('id', $id)
            ->get();
        return view('backend.programs.upload_program_files', compact('program', 'upload_files', 'title'));
    }

    public function download($id)
    {
        $data = DB::table('program_files')
            ->where('id', $id)
            ->first();
        $file_path = storage_path("app/{$data->path}");
        return Response::download($file_path);
    }

    public function downloadTemplate()
    {
        $file_path = storage_path('import-templates\programs-template.xlsx');
        return Response::download($file_path);
    }

    public function AddProgramPersonnel(Request $request)
    {
        $request->validate([
            'moreFields.*.programID' => 'required',
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
                ->route('rdmcProgramsIndex')
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('rdmcProgramsIndex')
                ->with($notification);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'moreFields.*.email' => 'required',
        ]);

        foreach ($request->moreFields as $key => $value) {
            Personnel::create($value);

            $notification = [
                'message' => 'Program Successfully Inserted!',
                'alert-type' => 'success',
            ];
        }

        return back()->with($notification);
    }

    public function AddProgramPersonnelsIndex()
    {
        $title = 'Programs | RTMS';
        return view('backend.programs.add_program_personnel', compact('title'));
    }

    public function AddProgramRequirementsIndex()
    {
        return view('backend.programs.add_program_requirements');
    }

    public function DeleteProgram($id)
    {
        $delete = DB::table('programs')
            ->where('id', $id)
            ->delete();
        if ($delete) {
            $notification = [
                'message' => 'Program Successfully Deleted!',
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
