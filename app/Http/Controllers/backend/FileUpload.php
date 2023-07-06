<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use DB;
use Storage;

class FileUpload extends Controller
{
    public function createForm($programID){

        $title = 'Programs | RTMS';
        $program = DB::table('programs')->where('programID', $programID)->first();
        $upload_files = DB::table('files')->where('programID', $programID)->get();
        return view('backend.programs.file-upload', compact('program', 'upload_files', 'title'));

      }
      public function fileUpload(Request $req){
            $req->validate([
            'file' => 'required|mimes:pdf|max:2048'
            ]);

            $folder_name = 'uploads';
            Storage::disk('local')->makeDirectory($folder_name, 0775, true); //creates directory
            $fileModel = new File;
            
            if($req->file()) {
                // $programID = $req->programID;
                $fileName = $req->file->getClientOriginalName();
                $filePath = $req->file('file')->storeAs($folder_name, $fileName);
                $fileModel->file_name = $req->file->getClientOriginalName();
                $fileModel->file_path = '/storage/' . $filePath;
                
                $upload = [
                    'file_name' => $fileName,
                    'file_path' => $filePath,
                    'programID' => $req->programID
                ];

                $upload_files = File::create($upload);
                
                if($upload_files) {
                    $notification = array(
                        'message' => 'File Successfully Uploaded!',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('uploadFile')->with($notification);
                } else {
                    $notification = array(
                        'message' => 'Something is wrong, please try again!',
                        'alert-type' => 'error'
                    );
                    return redirect()->route('uploadFile')->with($notification);
                }
            }
       }
}
