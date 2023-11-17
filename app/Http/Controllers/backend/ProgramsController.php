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

        $data = [];
        $data['programID'] = $request->programID;
        $data['fund_code'] = $request->fund_code;
        $data['program_title'] = $request->program_title;
        $data['program_status'] = $request->program_status;
        $data['program_category'] = $request->program_category;
        $data['funding_agency'] = $request->funding_agency;
        $data['implementing_agency'] = json_encode($request->implementing_agency);
        $data['research_center'] = htmlspecialchars_decode(json_encode($request->research_center));
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $data['extend_date'] = $request->extend_date;
        $data['program_leader'] = $request->program_leader;
        $data['assistant_leader'] = $request->assistant_leader;
        $data['program_description'] = $request->program_description;
        $data['approved_budget'] = str_replace(',', '', $request->approved_budget);
        $data['amount_released'] = str_replace(',', '', $request->amount_released);
        $data['budget_year'] = $request->budget_year;
        $data['form_of_development'] = $request->form_of_development;
        $data['keywords'] = htmlspecialchars_decode(json_encode($request->keywords));
        $data['created_at'] = now();

        $insert = DB::table('programs')->insert($data);
        if ($insert) {
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

        $program_leader = DB::table('personnels')
            ->where('role', '=', 'Program Leader')
            ->where('programID', $programID)
            ->get();

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

        return view('backend.report.rdmc.rdmc_view_program', compact('program', 'agency', 'personnels', 'program_leader', 'title', 'upload_files', 'projects'));
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

        $researchers_filter = DB::table('researchers')
            ->where('agency', auth()->user()->agencyID)
            ->get();

        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->get();

        return view('backend.report.rdmc.rdmc_program_edit', compact('programs', 'agency', 'personnels', 'title', 'researchers', 'researchers_filter', 'user_agency'));
    }

    public function UpdateProgram(Request $request, $programID)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = [];
        $data['programID'] = $request->programID;
        $data['fund_code'] = $request->fund_code;
        $data['program_title'] = $request->program_title;
        $data['program_status'] = $request->program_status;
        $data['program_category'] = $request->program_category;
        $data['funding_agency'] = $request->funding_agency;
        $data['implementing_agency'] = json_encode($request->implementing_agency);
        $data['research_center'] = htmlspecialchars_decode(json_encode($request->research_center));
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $data['extend_date'] = $request->extend_date;
        $data['program_leader'] = $request->program_leader;
        $data['assistant_leader'] = $request->assistant_leader;
        $data['program_description'] = $request->program_description;
        $data['approved_budget'] = str_replace(',', '', $request->approved_budget);
        $data['amount_released'] = str_replace(',', '', $request->amount_released);
        $data['budget_year'] = $request->budget_year;
        $data['form_of_development'] = $request->form_of_development;
        $data['keywords'] = htmlspecialchars_decode(json_encode($request->keywords));
        $data['updated_at'] = now();

        $insert = DB::table('programs')
            ->where('programID', $programID)
            ->update($data);
        if ($insert) {
            if ($insert) {
                return response()->json(['success' => 'Program Successfully Updated!']);
            } else {
                return response()->json(['error' => 'There is something wrong...']);
            }
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
