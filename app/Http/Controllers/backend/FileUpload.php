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

    // program file upload
    public function fileUpload(Request $request)
    {
        // $request->validate([
        //     'file' => 'required|mimes:pdf'
        // ]);

        date_default_timezone_set('Asia/Hong_Kong');
        // $dt = Carbon::now();
        // $date_time = $dt->toDayDateTimeString();


        $agency_folder = auth()->user()->agencyID;
        // Storage::disk('local')->makeDirectory($folder_name, 0775, true); //creates directory
        // $fileModel = new File;

        // upload file
        $date_time = Carbon::now();
        $folder_name = 'uploads';
        Storage::disk('local')->makeDirectory($folder_name, 0775, true); //creates directory
        if ($request->hasFile('file_moa') or $request->hasFile('file_lib') or $request->hasFile('file_ntp') or $request->hasFile('file_tr')) {
            $destinationPath = $folder_name . '/' . $agency_folder . '/' . 'Program' . '/';
            // memorandum of agreement
            if ($request->hasFile('file_moa')) {
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

                $request->file('file_moa')->storeAs($folder_name . "/" . $agency_folder . "/" . "Program", $file_name);
                // Storage::disk('local')->put($destinationPath, file_get_contents($request->file_moa->getRealPath()));
                DB::table('files')->insert($upload_tbl);

                $notification = array(
                    'message' => 'File Successfully Uploaded!',
                    'alert-type' => 'success'
                );
                return back()->with($notification);
            }

            // line item budget
            if ($request->hasFile('file_lib')) {
                $file_name = "Line-Item-Budget" . "." . $request->file_lib->getClientOriginalExtension();
                // $file_name = $request-> file_lib->getClientOriginalName(); //Get file original name  
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
                $request->file('file_lib')->storeAs($folder_name . "/" . $agency_folder . "/" . "Program", $file_name);
                // Storage::disk('local')->put($folder_name . '/' . $agency_folder . '/' . 'Program', file_get_contents($request->file_lib->getRealPath()));
                DB::table('files')->insert($upload_tbl);

                $notification = array(
                    'message' => 'File Successfully Uploaded!',
                    'alert-type' => 'success'
                );
                return back()->with($notification);
            }

            // notice to proceed
            if ($request->hasFile('file_ntp')) {
                $file_name = "Notice-to-Proceed" . "." . $request->file_ntp->getClientOriginalExtension();
                // $file_name = $request->file_ntp->getClientOriginalName(); //Get file original name  
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
                $request->file('file_ntp')->storeAs($folder_name . "/" . $agency_folder . "/" . "Program", $file_name);
                // Storage::disk('local')->put($folder_name . '/' . $agency_folder . '/' . 'Program', file_get_contents($request->file_ntp->getRealPath()));
                DB::table('files')->insert($upload_tbl);

                $notification = array(
                    'message' => 'File Successfully Uploaded!',
                    'alert-type' => 'success'
                );
                return back()->with($notification);
            }

            // Terminal report
            if ($request->hasFile('file_tr')) {
                $file_name = "Terminal-Report" . "." . $request->file_tr->getClientOriginalExtension();
                // $file_name = $request->file_tr->getClientOriginalName(); //Get file original name  
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
                $request->file('file_tr')->storeAs($folder_name . "/" . $agency_folder . "/" . "Program", $file_name);
                // Storage::disk('local')->put($folder_name . "/" . $agency_folder . "/" . "Program", file_get_contents($request->file_tr->getRealPath()));
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

    public function ProjectFileUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf'
            // 'file' => 'required|mimes:pdf|max:2048'
        ]);

        date_default_timezone_set('Asia/Hong_Kong');
        $dt = Carbon::now();
        $date_time = $dt->toDayDateTimeString();

        $folder_name = 'uploads';
        $agency_folder = auth()->user()->agencyID;
        Storage::disk('local')->makeDirectory($folder_name, 0775, true); //creates directory
        $fileModel = new File;

        if ($request->file()) {

            $fileName = $request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs($folder_name . "/" . $agency_folder . "/" . "Program", $fileName);

            $fileModel->file_name = $request->file->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;

            $upload = [
                'file_name' => $fileName,
                'file_path' => $filePath,
                'uploader_agency' => $request->uploader_agency,
                'programID' => $request->programID,
                'type' => $request->type,
                'projectID' => $request->projectID,
                'subprojectID' => $request->subprojectID
            ];

            $upload_files = File::create($upload);
            if ($upload_files) {
                $notification = array(
                    'message' => 'File Successfully Uploaded!',
                    'alert-type' => 'success'
                );
                return back()->with($notification);
            } else {
                $notification = array(
                    'message' => 'Something is wrong, please try again!',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            }
        }
    }


    public function download($id)
    {
        $data = DB::table('files')->where('id', $id)->first();
        $file_path = storage_path("app/{$data->file_path}");
        return Response::download($file_path);
    }

    // public function DeleteFile($id)
    // {
    //     $delete = DB::table('files')->where('id', $id)->delete();
    //     if ($delete) {
    //         $notification = array(
    //             'message' => 'File Successfully Deleted!',
    //             'alert-type' => 'success'
    //         );
    //         return redirect()->back()->with($notification);
    //     } else {
    //         $notification = array(
    //             'message' => 'Something is wrong, please try again!',
    //             'alert-type' => 'error'
    //         );
    //         return redirect()->back()->with($notification);
    //     }
    // }

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
