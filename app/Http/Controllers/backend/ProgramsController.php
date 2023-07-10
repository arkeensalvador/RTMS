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
use Response;
use Illuminate\Support\Facades\DB;

class ProgramsController extends Controller
{
    public function AddProgram(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['programID'] = $request->programID;
        $data['agencyID'] = $request->agencyID;
        $data['fundingAgencyID'] = $request->fundingAgencyID;
        $data['researcherID'] = $request->researcherID;
        $data['fund_code'] = $request->fund_code;
        $data['program_title'] = $request->program_title;
        $data['program_status'] = $request->program_status;
        $data['program_category'] = $request->program_category;
        $data['funding_agency'] = $request->funding_agency;
        $data['coordination_fund'] = $request->coordination_fund;
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $data['extend_date'] = $request->extend_date;
        $data['program_leader'] = $request->program_leader;
        $data['assistant_leader'] = $request->assistant_leader;
        $data['program_description'] = $request->program_description;
        $data['approved_budget'] = $request->approved_budget;
        $data['amount_released'] = $request->amount_released;
        $data['budget_year'] = $request->budget_year;
        $data['form_of_development'] = $request->form_of_development;
        $data['created_at'] = now();

        $insert = DB::table('programs')->insert($data);
        if ($insert) {

            $notification = array(
                'message' => 'Program Successfully Added!',
                'alert-type' => 'test'
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


    // public function AddProgram(Request $request)
    // {

    //     date_default_timezone_set('Asia/Hong_Kong');

    //     $data = array();
    //     $data['programID'] = $request->programID;
    //     $data['program_title'] = strtoupper($request->program_title);
    //     // $data['trust_fund_code'] = $request->tf_code;
    //     $data['agencyID'] = $request->agencyID;
    //     $data['description'] = $request->description;
    //     $data['created_at'] = now();

    //     $insert = DB::table('programs')->insert($data);
    //     if ($insert) {

    //         $data2 = array();
    //         $data2['budget'] = $request->budget;
    //         $data2['amount_release'] = $request->amount_release;
    //         // $data2['check_no'] = $request->check_no;
    //         // $data2['or_no'] = $request->or_no;
    //         // $data2['or_date'] = $request->or_date;
    //         $data2['start_date'] = $request->start_date;
    //         $data2['end_date'] = $request->end_date;
    //         $data2['extend_date'] = $request->extend_date;
    //         $data2['status'] = $request->status;
    //         $data2['programID'] = $request->programID;

    //         $insert2 = DB::table('program_details')->insert($data2);

    //         if ($insert2) {

    //             // upload file
    //             $dt = Carbon::now();
    //             $date_time = $dt->toDayDateTimeString();
    //             if ($request->hasFile('fileupload1') or $request->hasFile('fileupload2') or $request->hasFile('fileupload3') or $request->hasFile('fileupload4')) {
    //                 $folder_name = $request->agencyID;
    //                 // memorandum of agreement
    //                 if ($request->hasFile('fileupload1')) {
    //                     $file_name = "Memorandum-of-Agreement" . "(" . $request->agencyID . ")" . "." . $request->fileupload1->getClientOriginalExtension();

    //                     $destinationPath = $folder_name . '/';
    //                     // $file_name = $request->fileupload1->getClientOriginalName(); //Get file original name   
    //                     $upload_tbl = [
    //                         'programID' => $request->programID,
    //                         'file_name' => $file_name,
    //                         'path' => $destinationPath . $file_name,
    //                         'datetime' => $date_time,
    //                     ];


    //                     // $folderdrive = Storage::disk('google')->makeDirectory($request->agencyID); //creates directory
    //                     Storage::disk('local')->put($folder_name . '/' . $file_name, file_get_contents($request->fileupload1->getRealPath()));
    //                     // Storage::disk('google')->put($destinationPath . $file_name, file_get_contents($request->fileupload1->getRealPath()));
    //                     DB::table('program_files')->insert($upload_tbl);
    //                 }

    //                 // line item budget
    //                 if ($request->hasFile('fileupload2')) {
    //                     $file_name = "Line-Item-Budget" . "(" . $request->agencyID . ")" . "." . $request->fileupload2->getClientOriginalExtension();
    //                     // $file_name = $request->fileupload2->getClientOriginalName(); //Get file original name  
    //                     $upload_tbl = [
    //                         'programID' => $request->programID,
    //                         'file_name' => $file_name,
    //                         'path' => $destinationPath . $file_name,
    //                         'datetime' => $date_time,
    //                     ];
    //                     Storage::disk('local')->put($folder_name . '/' . $file_name, file_get_contents($request->fileupload2->getRealPath()));
    //                     DB::table('program_files')->insert($upload_tbl);
    //                 }

    //                 // notice to proceed
    //                 if ($request->hasFile('fileupload3')) {
    //                     $file_name = "Notice-to-Proceed" . "(" . $request->agencyID . ")" . "." . $request->fileupload3->getClientOriginalExtension();
    //                     // $file_name = $request->fileupload3->getClientOriginalName(); //Get file original name  
    //                     $upload_tbl = [
    //                         'programID' => $request->programID,
    //                         'file_name' => $file_name,
    //                         'path' => $destinationPath . $file_name,
    //                         'datetime' => $date_time,
    //                     ];
    //                     Storage::disk('local')->put($folder_name . '/' . $file_name, file_get_contents($request->fileupload3->getRealPath()));
    //                     DB::table('program_files')->insert($upload_tbl);
    //                 }

    //                 // Terminal report
    //                 if ($request->hasFile('fileupload4')) {
    //                     $file_name = "Terminal-Report" . "(" . $request->agencyID . ")" . "." . $request->fileupload4->getClientOriginalExtension();
    //                     // $file_name = $request->fileupload4->getClientOriginalName(); //Get file original name  
    //                     $upload_tbl = [
    //                         'programID' => $request->programID,
    //                         'file_name' => $file_name,
    //                         'path' => $destinationPath . $file_name,
    //                         'datetime' => $date_time,
    //                     ];
    //                     Storage::disk('local')->put($folder_name . '/' . $file_name, file_get_contents($request->fileupload4->getRealPath()));
    //                     DB::table('program_files')->insert($upload_tbl);
    //                 }
    //             }
    //             $notification = array(
    //                 'message' => 'Program Successfully Added!',
    //                 'alert-type' => 'success'
    //             );
    //             return redirect()->route('index')->with($notification);
    //         } else {
    //             $notification = array(
    //                 'message' => 'Something is wrong, please try again!',
    //                 'alert-type' => 'error'
    //             );
    //             return redirect()->route('index')->with($notification);
    //         }
    //     }
    // }

    // public function createFolder()
    // {
    //     try {
    //         $client = new Client();
    //         $client->useApplicationDefaultCredentials();
    //         $client->addScope(Drive::DRIVE);
    //         $driveService = new Drive($client);
    //         $fileMetadata = new Drive\DriveFile(array(
    //             'name' => 'Invoices',
    //             'mimeType' => 'application/vnd.google-apps.folder'
    //         ));
    //         $file = $driveService->files->create($fileMetadata, array(
    //             'fields' => 'id'
    //         ));
    //         printf("Folder ID: %s\n", $file->id);
    //         return $file->id;
    //     } catch (\Exception $e) {
    //         echo "Error Message: " . $e;
    //     }
    // }


    public function ViewProgramIndex($programID)
    {
        $title = 'Programs | RTMS';
        $program = DB::table('programs')->where('programID', $programID)->first();
        // $programs = DB::table('programs')->where('programID', $programID)->first();

        $program_leader = DB::table('personnels')->where('role', '=', "Program Leader")->where('programID', $programID)->get();

        $personnels = DB::table('personnels')->orderByDesc("staff_name")->where('role', '=', "Staff")->where('programID', $programID)->get();
        // $all = DB::table('programs')->get();

        $agency = DB::table('programs')
            ->rightJoin('agency', 'programs.agencyID', '=', 'agency.abbrev')
            ->select('agency.agency_name')
            ->first();

        $documents = DB::table('program_files')->where('programID', $programID)->get();

        return view('backend.programs.view_program_index', compact('program', 'agency', 'personnels', 'documents', 'program_leader', 'title'));
    }

    public function EditProgramIndex($programID)
    {
        $title = 'Programs | RTMS';
        $program = DB::table('programs')->where('programID', $programID)->first();
        $program_details = DB::table('program_details')->where('programID', $programID)->first();
        $personnels = DB::table('personnels')->where('programID', $programID)->get();
        // $all = DB::table('programs')->get();
        $documents = DB::table('program_files')->where('programID', $programID)->get();
        $agency = DB::table('agency')->get();

        return view('backend.programs.edit_program_index', compact('program', 'program_details', 'agency', 'personnels', 'documents', 'title'));
    }

    public function UpdateProgram(Request $request, $programID){

        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['programID'] = $request->programID;
        $data['agencyID'] = $request->agencyID;
        $data['fundingAgencyID'] = $request->fundingAgencyID;
        $data['researcherID'] = $request->researcherID;
        $data['fund_code'] = $request->fund_code;
        $data['program_title'] = $request->program_title;
        $data['program_status'] = $request->program_status;
        $data['program_category'] = $request->program_category;
        $data['funding_agency'] = $request->funding_agency;
        $data['coordination_fund'] = $request->coordination_fund;
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $data['extend_date'] = $request->extend_date;
        $data['program_leader'] = $request->program_leader;
        $data['assistant_leader'] = $request->assistant_leader;
        $data['program_description'] = $request->program_description;
        $data['approved_budget'] = $request->approved_budget;
        $data['amount_released'] = $request->amount_released;
        $data['budget_year'] = $request->budget_year;
        $data['form_of_development'] = $request->form_of_development;
        $data['edited_at'] = now();

        $insert = DB::table('programs')->where('programID', $programID)->update($data);
        if ($insert) {

            $notification = array(
                'message' => 'Program Successfully Updated!',
                'alert-type' => 'success'
            );

            return redirect()->route('rdmcProgramsIndex')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('rdmcProgramsIndex')->with($notification);
        }
    }
    public function UploadProgramFilesIndex($programID)
    {
        $title = 'Programs | RTMS';
        $program = DB::table('programs')->where('programID', $programID)->first();
        $upload_files = DB::table('program_files')->where('programID', $programID)->get();
        return view('backend.programs.upload_program_files', compact('program', 'upload_files', 'title'));
    }

    public function saveRecord(Request $request)
    {
        // upload file
        $dt = Carbon::now();
        $folder_name = 'upload';
        $date_time = $dt->toDayDateTimeString();
        Storage::disk('local')->makeDirectory($folder_name, 0775, true); //creates directory
        if ($request->hasFile('fileupload1') or $request->hasFile('fileupload2') or $request->hasFile('fileupload3') or $request->hasFile('fileupload4')) {
            $destinationPath = $folder_name . '/';
            // memorandum of agreement
            if ($request->hasFile('fileupload1')) {
                $file_name = "Memorandum-of-Agreement" . "(" . $request->agencyID . ")" . "." . $request->fileupload1->getClientOriginalExtension();
                // $file_name = $request->fileupload1->getClientOriginalName(); //Get file original name   
                $upload_tbl = [
                    'programID' => $request->programID,
                    'file_name' => $file_name,
                    'path' => $destinationPath . $file_name,
                    'datetime' => $date_time,
                ];
                Storage::disk('local')->put($folder_name . '/' . $file_name, file_get_contents($request->fileupload1->getRealPath()));
                DB::table('program_files')->insert($upload_tbl);
            }

            // line item budget
            if ($request->hasFile('fileupload2')) {
                $file_name = "Line-Item-Budget" . "(" . $request->agencyID . ")" . "." . $request->fileupload2->getClientOriginalExtension();
                // $file_name = $request->fileupload2->getClientOriginalName(); //Get file original name  
                $upload_tbl = [
                    'programID' => $request->programID,
                    'file_name' => $file_name,
                    'path' => $destinationPath . $file_name,
                    'datetime' => $date_time,
                ];
                Storage::disk('local')->put($folder_name . '/' . $file_name, file_get_contents($request->fileupload2->getRealPath()));
                DB::table('program_files')->insert($upload_tbl);
            }

            // notice to proceed
            if ($request->hasFile('fileupload3')) {
                $file_name = "Notice-to-Proceed" . "(" . $request->agencyID . ")" . "." . $request->fileupload3->getClientOriginalExtension();
                // $file_name = $request->fileupload3->getClientOriginalName(); //Get file original name  
                $upload_tbl = [
                    'programID' => $request->programID,
                    'file_name' => $file_name,
                    'path' => $destinationPath . $file_name,
                    'datetime' => $date_time,
                ];
                Storage::disk('local')->put($folder_name . '/' . $file_name, file_get_contents($request->fileupload3->getRealPath()));
                DB::table('program_files')->insert($upload_tbl);
            }

            // Terminal report
            if ($request->hasFile('fileupload4')) {
                $file_name = "Terminal-Report" . "(" . $request->agencyID . ")" . "." . $request->fileupload4->getClientOriginalExtension();
                // $file_name = $request->fileupload4->getClientOriginalName(); //Get file original name  
                $upload_tbl = [
                    'programID' => $request->programID,
                    'file_name' => $file_name,
                    'path' => $destinationPath . $file_name,
                    'datetime' => $date_time,
                ];
                Storage::disk('local')->put($folder_name . '/' . $file_name, file_get_contents($request->fileupload4->getRealPath()));
                DB::table('program_files')->insert($upload_tbl);
            }
            $notification = array(
                'message' => 'Program Files Successfully Uploaded!',
                'alert-type' => 'success'
            );
            return redirect()->route('rdmc-programs')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('rdmc-programs')->with($notification);
        }
    }

    public function download($id)
    {
        $data = DB::table('program_files')->where('id', $id)->first();
        $file_path = storage_path("app/{$data->path}");
        return Response::download($file_path);
    }

    // ->leftjoin('projects', 'institution.instname', '=', 'projects.funding_agency')
    // ->select('projects.*')
    // ->where('id', $id)
    // ->get();

    public function AddProgramPersonnel(Request $request)
    {
        $request->validate([
            'moreFields.*.programID' => 'required'
        ]);

        foreach ($request->moreFields as $key => $value) {

            $staffs = Personnel::create($value);
        }
        if ($staffs) {

            $notification = array(
                'message' => 'Staff(s) Successfully Updated!',
                'alert-type' => 'success'
            );

            return redirect()->route('rdmcProgramsIndex')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('rdmcProgramsIndex')->with($notification);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'moreFields.*.email' => 'required'
        ]);

        foreach ($request->moreFields as $key => $value) {

            Personnel::create($value);

            $notification = array(
                'message' => 'Program Successfully Inserted!',
                'alert-type' => 'success'
            );
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
        $delete = DB::table('programs')->where('id', $id)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Program Successfully Deleted!',
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
