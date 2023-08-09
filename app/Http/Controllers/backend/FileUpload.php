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

    public function fileUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048'
        ]);

        date_default_timezone_set('Asia/Hong_Kong');
        $dt = Carbon::now();
        $date_time = $dt->toDayDateTimeString();

        $folder_name = 'uploads';
        $agency_folder = auth()->user()->agencyID;
        Storage::disk('local')->makeDirectory($folder_name, 0775, true); //creates directory
        $fileModel = new File;

        if ($request->file()) {

            $uploader_agency = $request->uploader_agency;
            $fileName = $request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs($folder_name . "/" . $agency_folder . "/" . "Program", $fileName);

            $fileModel->file_name = $request->file->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;

            $upload = [
                'file_name' => $fileName,
                'file_path' => $filePath,
                'uploader_agency' => $uploader_agency,
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

    public function ProjectFileUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048'
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
            $filePath = $request->file('file')->storeAs($folder_name . "/" . $agency_folder . "/" . "Project", $fileName);

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
