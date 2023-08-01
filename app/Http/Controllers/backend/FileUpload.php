<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\File;
use DB;
use Illuminate\Support\Facades\Response;
use Storage;

class FileUpload extends Controller
{
    public function createForm($programID)
    {
        $title = 'Programs | RTMS';
        $program = DB::table('programs')->where('programID', $programID)->first();
        $upload_files = DB::table('files')->where('programID', $programID)->get();
        return view('backend.programs.file-upload', compact('program', 'upload_files', 'title'));
    }
    public function fileUpload(Request $req)
    {
        $req->validate([
            'file' => 'required|mimes:pdf|max:2048'
        ]);

        date_default_timezone_set('Asia/Hong_Kong');
        $dt = Carbon::now();
        $date_time = $dt->toDayDateTimeString();

        $folder_name = 'uploads';
        $agency_folder = auth()->user()->agencyID;
        Storage::disk('local')->makeDirectory($folder_name, 0775, true); //creates directory
        $fileModel = new File;

        if ($req->file()) {
            
            $fileName = $req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs($folder_name . "/" . $agency_folder, $fileName);

            $fileModel->file_name = $req->file->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;

            $upload = [
                'file_name' => $fileName,
                'file_path' => $filePath,
                'programID' => $req->programID,
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
    
    public function DeleteFile($id)
    {
        $delete = DB::table('files')->where('id', $id)->delete();
        if ($delete) {
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
