<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Imports\AgencyImport;
use App\Imports\ProgramsImport;
use App\Imports\ResearchersImport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use DB;
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
            $notification = array(
                'message' => 'File is missing!',
                'alert-type' => 'error'
            );
        } else  if ($request->file('import_excel_users')) {
            $import = Excel::import(new UsersImport, $request->file('import_excel_users'));
            if ($import) {
                $notification = array(
                    'message' => 'Data Successfully Imported!',
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
        } else if ($request->file('import_excel_programs')) {
            $import = Excel::import(new ProgramsImport, $request->file('import_excel_programs'));
            if ($import) {
                $notification = array(
                    'message' => 'Data Successfully Imported!',
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
        } else if ($request->file('import_excel_researchers')) {
            $import = Excel::import(new ResearchersImport, $request->file('import_excel_researchers'));
            if ($import) {
                $notification = array(
                    'message' => 'Data Successfully Imported!',
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
        } else if ($request->file('import_excel_agency')) {
            $import = Excel::import(new AgencyImport, $request->file('import_excel_agency'));
            if ($import) {
                $notification = array(
                    'message' => 'Data Successfully Imported!',
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
}
