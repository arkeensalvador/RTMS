<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Templates;
use Illuminate\Support\Facades\Response;
use Storage;

class TemplatesController extends Controller
{
    public function templates_index()
    {
        $title = 'Templates';
        $all = DB::table('templates')->get();
        return view('backend.templates.templates', compact('title', 'all'));
    }

    public function storeMultiFile(Request $request)
    {
        $message = [
            'required' => 'Please select file to upload',
            'mimes' => 'The file must be: xlsx, csv',
        ];

        $request->validate(
            [
                'files' => 'required',
                'files.*' => 'mimes:xlsx,csv',
            ],
            $message,
        );

        if ($request->TotalFiles > 0) {
            for ($x = 0; $x < $request->TotalFiles; $x++) {
                if ($request->hasFile('files' . $x)) {
                    $file = $request->file('files' . $x);
                    $name = $file->getClientOriginalName();

                    $path = $file->storeAs('uploads' . '/' . 'Templates', $name);
                    $file_path = 'uploads' . '/' . 'Templates' . '/' . $name;

                    $insert[$x]['file_name'] = $name;
                    $insert[$x]['file_path'] = $file_path;
                }
            }
            Templates::insert($insert);

            return response()->json(['success' => 'File Successfully Uploaded!']);
        } else {
            return response()->json(['message' => 'There is something wrong. Please try again.']);
        }
    }

    public function download($id)
    {
        $data = DB::table('templates')
            ->where('id', $id)
            ->first();
        $file_path = storage_path("app/{$data->file_path}");
        return Response::download($file_path);
    }

    public function DeleteFile($id)
    {
        $file = DB::table('templates')
            ->select('file_name')
            ->where('id', $id)
            ->first();
        $agency_folder = auth()->user()->agencyID;

        if ($file) {
            $deletefile = Storage::disk('uploads')->delete('Templates' . '/' . $file->file_name);
            if ($deletefile) {
                DB::table('templates')
                    ->where('id', $id)
                    ->delete();
            }
            $notification = [
                'message' => 'File Successfully Deleted!',
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
