<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Imports\AgencyImport;
use App\Imports\ProgramsImport;
use App\Imports\ProjectsImport;
use App\Imports\ResearchersImport;
use App\Imports\SubProjectsImport;
use App\Imports\UsersImport;
use App\Mail\NewUserWelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function importExcel(Request $request)
    {
        // $route = request()->route()->getName();

        // $request->validate([
        //     'import_excel_users' => 'required|mimes:xls,xlsx',
        //     'import_excel_programs' => 'required|mimes:xls,xlsx',
        // ]);

        // CHECK IF EMPTY
        if (empty($request->file())) {
            $notification = [
                'message' => 'File is missing!',
                'alert-type' => 'error',
            ];
        }
        if ($request->file('import_excel_users')) {
            $import = Excel::import(new UsersImport(), $request->file('import_excel_users'));
            if ($import) {
                $users = User::all(); // Retrieve all imported users
                foreach ($users as $user) {
                    Mail::to($user->email)->send(new NewUserWelcomeMail($user));
                }

                $notification = [
                    'message' => 'Data Successfully Imported!',
                    'alert-type' => 'success',
                ];

                return redirect()->route('AllUser')->with($notification);
            } else {
                $notification = [
                    'message' => 'Something is wrong, please try again!',
                    'alert-type' => 'error',
                ];
                return redirect()->route('AllUser')->with($notification);
            }
        }
        if ($request->file('import_excel_programs')) {
            $import = Excel::import(new ProgramsImport(), $request->file('import_excel_programs'));
            if ($import) {
                // $notification = array(
                //     'message' => 'Data Successfully Imported!',
                //     'alert-type' => 'success'
                // );
                // return back()->with($notification);
                return back();
            } else {
                // $notification = array(
                //     'message' => 'Something is wrong, please try again!',
                //     'alert-type' => 'error'
                // );
                // return back()->with($notification);
                return back();
            }
        }
        if ($request->file('import_excel_researchers')) {
            $import = Excel::import(new ResearchersImport(), $request->file('import_excel_researchers'));
            if ($import) {
                $notification = [
                    'message' => 'Data Successfully Imported!',
                    'alert-type' => 'success',
                ];
                return back()->with($notification);
            } else {
                $notification = [
                    'message' => 'Something is wrong, please try again!',
                    'alert-type' => 'error',
                ];
                return back()->with($notification);
            }
        }
        if ($request->file('import_excel_agency')) {
            $import = Excel::import(new AgencyImport(), $request->file('import_excel_agency'));
            if ($import) {
                $notification = [
                    'message' => 'Data Successfully Imported!',
                    'alert-type' => 'success',
                ];
                return back()->with($notification);
            } else {
                $notification = [
                    'message' => 'Something is wrong, please try again!',
                    'alert-type' => 'error',
                ];
                return back()->with($notification);
            }
        }
        if ($request->file('import_excel_projects')) {
            $import = Excel::import(new ProjectsImport(), $request->file('import_excel_projects'));
            if ($import) {
                // $notification = [
                //     'message' => 'Data Successfully Imported!',
                //     'alert-type' => 'project',
                // ];
                // return back()->with($notification);
                return back();
            } else {
                // $notification = [
                //     'message' => 'Something is wrong, please try again!',
                //     'alert-type' => 'error',
                // ];
                // return back()->with($notification);
                return back();
            }
        }
        if ($request->file('import_excel_sub_projects')) {
            $import = Excel::import(new SubProjectsImport(), $request->file('import_excel_sub_projects'));
            if ($import) {
                // $notification = [
                //     'message' => 'Data Successfully Imported!',
                //     'alert-type' => 'success',
                // ];
                // return back()->with($notification);
                return back();
            } else {
                // $notification = [
                //     'message' => 'Something is wrong, please try again!',
                //     'alert-type' => 'error',
                // ];
                // return back()->with($notification);
                return back();
            }
        }
    }
}
