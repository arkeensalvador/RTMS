<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Google\Service\Docs\Resource\Documents;
use Illuminate\Http\Request;
use App\Models\File;
use DB;
use Illuminate\Support\Facades\Response;
use Storage;

class FileUpload extends Controller
{
    //Programs
    public function createFormProgram($programID)
    {
        $title = 'Program Files | RTMS';
        $program = DB::table('programs')->where('programID', $programID)->first();
        $upload_files = DB::table('files')->where('programID', $programID)->get();
        return view('backend.programs.file-upload', compact('program', 'upload_files', 'title'));
    }

    // Projects
    public function createFormProject($id)
    {
        $title = 'Project Files | RTMS';
        $project = DB::table('projects')->where('id', $id)->first();
        $upload_files = DB::table('files')->where('projectID', $id)->get();
        return view('backend.report.rdmc.file-upload_projects', compact('project', 'upload_files', 'title'));
    }
    public function createFormSubProject($projectID, $id)
    {
        $title = 'Sub Project Files | RTMS';
        $sub_project = DB::table('sub_projects')->where('projectID', $projectID)->where('id', $id)->first();
        $upload_files = DB::table('files')->where('projectID', '=', $projectID)->where('subprojectID', '=', $id)->get();
        return view('backend.report.rdmc.file-upload_sub_projects', compact('sub_project', 'upload_files', 'title'));
    }

    public function storeMultiFile(Request $request)
    {
        $message = [
            'required' => 'Please select file to upload',
            'mimes' => 'The file must be: pdf, doc, or docx'
        ];

        $request->validate([
            'files' => 'required',
            'files.*' => 'mimes:pdf,doc,docx'
        ], $message);


        if ($request->TotalFiles > 0) {

            for ($x = 0; $x < $request->TotalFiles; $x++) {

                if ($request->hasFile('files' . $x)) {
                    $file = $request->file('files' . $x);
                    $name = $file->getClientOriginalName();
                    $programID = $request->programID;
                    $projectID = $request->projectID;
                    $subprojectID = $request->subprojectID;
                    $agency = $request->uploader_agency;

                    //programs
                    if ($programID && !$projectID  && !$subprojectID) {
                        $path = $file->storeAs('uploads' . '/' . $agency . '/' . 'Programs', $name);
                        $file_path = 'uploads' . '/' . $agency . '/' . 'Programs' . '/' . $name;
                    } else if ($programID && $projectID  && !$subprojectID) {
                        $path = $file->storeAs('uploads' . '/' . $agency . '/' . 'Programs' . '/' . 'Projects', $name);
                        $file_path = 'uploads' . '/' . $agency . '/' . 'Programs' . '/' . 'Projects' . '/' . $name;
                    } else if (!$programID && $projectID  && !$subprojectID) {
                        $path = $file->storeAs('uploads' . '/' . $agency . '/' . 'Projects', $name);
                        $file_path = 'uploads' . '/' . $agency . '/' . 'Projects' . '/' . $name;
                    } else  if (!$programID && $projectID  && $subprojectID) {
                        $path = $file->storeAs('uploads' . '/' . $agency . '/' . 'Projects' . '/' . 'SP', $name);
                        $file_path = 'uploads' . '/' . $agency . '/' . 'Projects' . '/' .  'SP' . '/' . $name;
                    } else  if ($programID && $projectID  && $subprojectID) {
                        $path = $file->storeAs('uploads' . '/' . $agency . '/' . 'Projects' . '/' . 'SP', $name);
                        $file_path = 'uploads' . '/' . $agency . '/' . 'Projects' . '/' .  'SP' . '/' . $name;
                    }

                    $insert[$x]['file_name'] = $name;
                    $insert[$x]['file_path'] = $file_path;
                    $insert[$x]['uploader_agency'] = $agency;
                    $insert[$x]['programID'] = $programID;
                    $insert[$x]['projectID'] = $projectID;
                    $insert[$x]['subprojectID'] = $subprojectID;
                }
            }

            File::insert($insert);

            return response()->json(['success' => 'File Successfully Uploaded!']);
        } else {
            return response()->json(['message' => "There is something wrong. Please try again."]);
        }
    }

    // program file upload
    public function fileUpload(Request $request)
    {

        date_default_timezone_set('Asia/Hong_Kong');

        $agency_folder = auth()->user()->agencyID;

        // upload file
        $date_time = Carbon::now();
        $folder_name = 'uploads';
        Storage::disk('local')->makeDirectory($folder_name, 0775, true);
        if ($request->hasFile('file_moa') or $request->hasFile('file_lib') or $request->hasFile('file_ntp') or $request->hasFile('file_tr') or $request->hasFile('files')) {
            $destinationPath = $folder_name . '/' . $agency_folder . '/' . 'Program' . '/';
            // memorandum of agreement
            if ($request->hasFile('file_moa')) {
                $request->validate([
                    'file_moa' => 'required|mimes:doc,pdf'
                ]);
                $file_name1 = "Memorandum-of-Agreement" . "." . $request->file_moa->getClientOriginalExtension();
                $upload_tbl1 = [
                    'file_name' => $file_name1,
                    'file_path' => $destinationPath . $file_name1,
                    'uploader_agency' => $request->uploader_agency,
                    'programID' => $request->programID,
                    'type' => $request->type,
                    'projectID' => $request->projectID,
                    'subprojectID' => $request->subprojectID,
                    'created_at' =>  $date_time
                ];

                $request->file('file_moa')->storeAs($folder_name . "/" . $agency_folder . "/" . "Program", $file_name1);
                DB::table('files')->insert($upload_tbl1);

                $notification = array(
                    'message' => 'File Successfully Uploaded!',
                    'alert-type' => 'success'
                );
                return back()->with($notification);
            }

            // line item budget
            if ($request->hasFile('file_lib')) {

                $request->validate([
                    'file_lib' => 'required|mimes:doc,pdf'
                ]);

                $file_name2 = "Line-Item-Budget" . "." . $request->file_lib->getClientOriginalExtension();
                $upload_tbl2 = [
                    'file_name' => $file_name2,
                    'file_path' => $destinationPath . $file_name2,
                    'uploader_agency' => $request->uploader_agency,
                    'programID' => $request->programID,
                    'type' => $request->type,
                    'projectID' => $request->projectID,
                    'subprojectID' => $request->subprojectID,
                    'created_at' =>  $date_time
                ];
                $request->file('file_lib')->storeAs($folder_name . "/" . $agency_folder . "/" . "Program", $file_name2);
                DB::table('files')->insert($upload_tbl2);

                $notification = array(
                    'message' => 'File Successfully Uploaded!',
                    'alert-type' => 'success'
                );
                return back()->with($notification);
            }

            // notice to proceed
            if ($request->hasFile('file_ntp')) {

                $request->validate([
                    'file_ntp' => 'required|mimes:doc,pdf',
                ]);

                $file_name3 = "Notice-to-Proceed" . "." . $request->file_ntp->getClientOriginalExtension();
                // $file_name = $request->file_ntp->getClientOriginalName(); //Get file original name  
                $upload_tbl3 = [
                    'file_name' => $file_name3,
                    'file_path' => $destinationPath . $file_name3,
                    'uploader_agency' => $request->uploader_agency,
                    'programID' => $request->programID,
                    'type' => $request->type,
                    'projectID' => $request->projectID,
                    'subprojectID' => $request->subprojectID,
                    'created_at' =>  $date_time
                ];
                $request->file('file_ntp')->storeAs($folder_name . "/" . $agency_folder . "/" . "Program", $file_name3);
                DB::table('files')->insert($upload_tbl3);

                $notification = array(
                    'message' => 'File Successfully Uploaded!',
                    'alert-type' => 'success'
                );
                return back()->with($notification);
            }

            // Terminal report
            if ($request->hasFile('file_tr')) {

                $request->validate([
                    'file_tr' => 'required|mimes:doc,pdf'
                ]);

                $file_name4 = "Terminal-Report" . "." . $request->file_tr->getClientOriginalExtension();
                // $file_name = $request->file_tr->getClientOriginalName(); //Get file original name  
                $upload_tbl4 = [
                    'file_name' => $file_name4,
                    'file_path' => $destinationPath . $file_name4,
                    'uploader_agency' => $request->uploader_agency,
                    'programID' => $request->programID,
                    'type' => $request->type,
                    'projectID' => $request->projectID,
                    'subprojectID' => $request->subprojectID,
                    'created_at' =>  $date_time
                ];
                $request->file('file_tr')->storeAs($folder_name . "/" . $agency_folder . "/" . "Program", $file_name4);
                DB::table('files')->insert($upload_tbl4);

                $notification = array(
                    'message' => 'File Successfully Uploaded!',
                    'alert-type' => 'success'
                );
                return back()->with($notification);
            }

            // if ($request->hasFile('file_moa') and $request->hasFile('file_lib') and $request->hasFile('file_ntp') and $request->hasFile('file_tr')) {
            //     $request->validate([
            //         'file_moa' => 'required|mimes:doc,pdf',
            //         'file_lib' => 'required|mimes:doc,pdf',
            //         'file_ntp' => 'required|mimes:doc,pdf',
            //         'file_tr' => 'required|mimes:doc,pdf'
            //     ]);
            //     $file_name1 = "Memorandum-of-Agreement" . "." . $request->file_moa->getClientOriginalExtension();
            //     $file_name2 = "Line-Item-Budget" . "." . $request->file_lib->getClientOriginalExtension();
            //     $upload_tbl1 = [
            //         'file_name' => $file_name1,
            //         'file_path' => $destinationPath . $file_name1,
            //         'uploader_agency' => $request->uploader_agency,
            //         'programID' => $request->programID,
            //         'type' => $request->type,
            //         'projectID' => $request->projectID,
            //         'subprojectID' => $request->subprojectID,
            //         'created_at' =>  $date_time
            //         'subprojectID' => $request->subprojectID,
            //         'created_at' =>  $date_time
            //     ];

            //     $request->file('file_moa')->storeAs($folder_name . "/" . $agency_folder . "/" . "Program", $file_name1);
            //     DB::table('files')->insert($upload_tbl1);

            //     $request->file('file_lib')->storeAs($folder_name . "/" . $agency_folder . "/" . "Program", $file_name2);
            //     DB::table('files')->insert($upload_tbl2);


            //     $notification = array(
            //         'message' => 'File Successfully Uploaded!',
            //         'alert-type' => 'success'
            //     );
            //     return back()->with($notification);
            // }  ];
            //     $upload_tbl2 = [
            //         'file_name' => $file_name2,
            //         'file_path' => $destinationPath . $file_name2,
            //         'uploader_agency' => $request->uploader_agency,
            //         'programID' => $request->programID,
            //         'type' => $request->type,
            //         'projectID' => $request->projectID,
            //   
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }



    // PROJECT FILE UPLOAD
    public function ProjectFileUpload(Request $request)
    {

        date_default_timezone_set('Asia/Hong_Kong');

        $agency_folder = auth()->user()->agencyID;

        // upload file
        $date_time = Carbon::now();
        $folder_name = 'uploads';
        Storage::disk('local')->makeDirectory($folder_name, 0775, true); //creates directory
        if ($request->hasFile('file_moa') or $request->hasFile('file_lib') or $request->hasFile('file_ntp') or $request->hasFile('file_tr') or $request->hasFile('file_fr')) {
            $destinationPath = $folder_name . '/' . $agency_folder . '/' . 'Project' . '/';
            // memorandum of agreement
            if ($request->hasFile('file_moa')) {

                $request->validate([
                    'file_moa' => 'required|mimes:doc,pdf'
                ]);

                $file_name = "Memorandum-of-Agreement" . "." . $request->file_moa->getClientOriginalExtension();
                $upload_tbl = [
                    'file_name' => $file_name,
                    'file_path' => $destinationPath . $file_name,
                    'uploader_agency' => $request->uploader_agency,
                    'programID' => $request->programID,
                    'type' => $request->type,
                    'projectID' => $request->projectID,
                    'subprojectID' => $request->subprojectID,
                    'created_at' =>  $date_time
                ];

                $request->file('file_moa')->storeAs($folder_name . "/" . $agency_folder . "/" . "Project", $file_name);
                DB::table('files')->insert($upload_tbl);

                $notification = array(
                    'message' => 'File Successfully Uploaded!',
                    'alert-type' => 'success'
                );
                return back()->with($notification);
            }

            // line item budget
            if ($request->hasFile('file_lib')) {

                $request->validate([
                    'file_lib' => 'required|mimes:doc,pdf'
                ]);

                $file_name = "Line-Item-Budget" . "." . $request->file_lib->getClientOriginalExtension();
                $upload_tbl = [
                    'file_name' => $file_name,
                    'file_path' => $destinationPath . $file_name,
                    'uploader_agency' => $request->uploader_agency,
                    'programID' => $request->programID,
                    'type' => $request->type,
                    'projectID' => $request->projectID,
                    'subprojectID' => $request->subprojectID,
                    'created_at' =>  $date_time
                ];
                $request->file('file_lib')->storeAs($folder_name . "/" . $agency_folder . "/" . "Project", $file_name);
                DB::table('files')->insert($upload_tbl);

                $notification = array(
                    'message' => 'File Successfully Uploaded!',
                    'alert-type' => 'success'
                );
                return back()->with($notification);
            }

            // notice to proceed
            if ($request->hasFile('file_ntp')) {

                $request->validate([
                    'file_ntp' => 'required|mimes:doc,pdf'
                ]);

                $file_name = "Notice-to-Proceed" . "." . $request->file_ntp->getClientOriginalExtension();
                $upload_tbl = [
                    'file_name' => $file_name,
                    'file_path' => $destinationPath . $file_name,
                    'uploader_agency' => $request->uploader_agency,
                    'programID' => $request->programID,
                    'type' => $request->type,
                    'projectID' => $request->projectID,
                    'subprojectID' => $request->subprojectID,
                    'created_at' =>  $date_time
                ];
                $request->file('file_ntp')->storeAs($folder_name . "/" . $agency_folder . "/" . "Project", $file_name);
                DB::table('files')->insert($upload_tbl);

                $notification = array(
                    'message' => 'File Successfully Uploaded!',
                    'alert-type' => 'success'
                );
                return back()->with($notification);
            }

            // Terminal report
            if ($request->hasFile('file_tr')) {

                $request->validate([
                    'file_tr' => 'required|mimes:doc,pdf'
                ]);

                $file_name = "Terminal-Report" . "." . $request->file_tr->getClientOriginalExtension();
                $upload_tbl = [
                    'file_name' => $file_name,
                    'file_path' => $destinationPath . $file_name,
                    'uploader_agency' => $request->uploader_agency,
                    'programID' => $request->programID,
                    'type' => $request->type,
                    'projectID' => $request->projectID,
                    'subprojectID' => $request->subprojectID,
                    'created_at' =>  $date_time
                ];
                $request->file('file_tr')->storeAs($folder_name . "/" . $agency_folder . "/" . "Project", $file_name);
                DB::table('files')->insert($upload_tbl);

                $notification = array(
                    'message' => 'File Successfully Uploaded!',
                    'alert-type' => 'success'
                );
                return back()->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }

    // SUB PROJECT FILE UPLOAD
    public function SubProjectFileUpload(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        $agency_folder = auth()->user()->agencyID;

        // upload file
        $date_time = Carbon::now();
        $folder_name = 'uploads';
        Storage::disk('local')->makeDirectory($folder_name, 0775, true); //creates directory
        if ($request->hasFile('file_moa') or $request->hasFile('file_lib') or $request->hasFile('file_ntp') or $request->hasFile('file_tr') or $request->hasFile('file_fr')) {
            $destinationPath = $folder_name . '/' . $agency_folder . '/' . 'Project' . '/' . 'Sub-Projects' . '/';
            // memorandum of agreement
            if ($request->hasFile('file_moa')) {

                $request->validate([
                    'file_moa' => 'required|mimes:doc,pdf'
                ]);

                $file_name = "Memorandum-of-Agreement" . "." . $request->file_moa->getClientOriginalExtension();
                $upload_tbl = [
                    'file_name' => $file_name,
                    'file_path' => $destinationPath . $file_name,
                    'uploader_agency' => $request->uploader_agency,
                    'programID' => $request->programID,
                    'type' => $request->type,
                    'projectID' => $request->projectID,
                    'subprojectID' => $request->subprojectID,
                    'created_at' =>  $date_time
                ];

                $request->file('file_moa')->storeAs($destinationPath, $file_name);
                DB::table('files')->insert($upload_tbl);

                $notification = array(
                    'message' => 'File Successfully Uploaded!',
                    'alert-type' => 'success'
                );
                return back()->with($notification);
            }

            // line item budget
            if ($request->hasFile('file_lib')) {

                $request->validate([
                    'file_lib' => 'required|mimes:doc,pdf'
                ]);

                $file_name = "Line-Item-Budget" . "." . $request->file_lib->getClientOriginalExtension();
                $upload_tbl = [
                    'file_name' => $file_name,
                    'file_path' => $destinationPath . $file_name,
                    'uploader_agency' => $request->uploader_agency,
                    'programID' => $request->programID,
                    'type' => $request->type,
                    'projectID' => $request->projectID,
                    'subprojectID' => $request->subprojectID,
                    'created_at' =>  $date_time
                ];
                $request->file('file_lib')->storeAs($destinationPath, $file_name);
                DB::table('files')->insert($upload_tbl);

                $notification = array(
                    'message' => 'File Successfully Uploaded!',
                    'alert-type' => 'success'
                );
                return back()->with($notification);
            }

            // notice to proceed
            if ($request->hasFile('file_ntp')) {

                $request->validate([
                    'file_ntp' => 'required|mimes:doc,pdf'
                ]);

                $file_name = "Notice-to-Proceed" . "." . $request->file_ntp->getClientOriginalExtension();
                $upload_tbl = [
                    'file_name' => $file_name,
                    'file_path' => $destinationPath . $file_name,
                    'uploader_agency' => $request->uploader_agency,
                    'programID' => $request->programID,
                    'type' => $request->type,
                    'projectID' => $request->projectID,
                    'subprojectID' => $request->subprojectID,
                    'created_at' =>  $date_time
                ];
                $request->file('file_ntp')->storeAs($destinationPath, $file_name);
                DB::table('files')->insert($upload_tbl);

                $notification = array(
                    'message' => 'File Successfully Uploaded!',
                    'alert-type' => 'success'
                );
                return back()->with($notification);
            }

            // Terminal report
            if ($request->hasFile('file_tr')) {

                $request->validate([
                    'file_tr' => 'required|mimes:doc,pdf'
                ]);

                $file_name = "Terminal-Report" . "." . $request->file_tr->getClientOriginalExtension();
                $upload_tbl = [
                    'file_name' => $file_name,
                    'file_path' => $destinationPath . $file_name,
                    'uploader_agency' => $request->uploader_agency,
                    'programID' => $request->programID,
                    'type' => $request->type,
                    'projectID' => $request->projectID,
                    'subprojectID' => $request->subprojectID,
                    'created_at' =>  $date_time
                ];
                $request->file('file_tr')->storeAs($destinationPath, $file_name);
                DB::table('files')->insert($upload_tbl);

                $notification = array(
                    'message' => 'File Successfully Uploaded!',
                    'alert-type' => 'success'
                );
                return back()->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }


    public function download($id)
    {
        $data = DB::table('files')->where('id', $id)->first();
        $file_path = storage_path("app/{$data->file_path}");
        return Response::download($file_path);
    }


    public function DeleteFile($id)
    {
        $file = DB::table('files')->select('file_name')->where('id', $id)->first();
        $agency_folder = auth()->user()->agencyID;

        if ($file) {
            $deletefile = Storage::disk('uploads')->delete($agency_folder . "/" . $file->file_name);
            if ($deletefile) {
                DB::table('files')->where('id', $id)->delete();
            }
            $notification = array(
                'message' => 'File Successfully Deleted!',
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
