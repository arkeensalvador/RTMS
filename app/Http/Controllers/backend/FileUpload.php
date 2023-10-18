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
                    if ($programID) {
                        $path = $file->storeAs('uploads' . '/' . $agency . '/' . 'Programs', $name);
                        $file_path = 'uploads' . '/' . $agency . '/' . 'Programs' . '/' . $name;
                    } else if ($projectID) {
                        $path = $file->storeAs('uploads' . '/' . $agency . '/' . 'Projects', $name);
                        $file_path = 'uploads' . '/' . $agency . '/' . 'Projects' . '/' . $name;
                    } else  if ($subprojectID) {
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
