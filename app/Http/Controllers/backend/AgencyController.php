<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Response;

class AgencyController extends Controller
{
    //

    public function AddAgencyIndex()
    {
        $title = "Agency | RTMS";
        return view('backend.agency.add_agency', compact('title'));
    }

    public function AllAgency()
    {
        $title = "Agency | RTMS";
        $all = DB::table('agency')->orderBy("agency_name")->get();
        return view('backend.agency.agency', compact('all', 'title'));
    }

    public function AddAgency(Request $request)
    {
        $data = array();
        $data['agency_name'] = $request->agency_name;
        $data['abbrev'] = $request->abbrev;

        $insert = DB::table('agency')->insertOrIgnore($data);
        if ($insert) {
            //inserting idnumber to instid(other table) 
            // DB::table('projects')->insertOrIgnore([
            //     ['instid' => $data['idnumber']]
            // ]);
            $notification = array(
                'message' => 'Agency Successfully Added!',
                'alert-type' => 'success'
            );
            return redirect()->route('AddAgencyIndex')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('AllAgency')->with($notification);
        }
    }


    public function EditAgency($id)
    {
        $title = "Agency | RTMS";
        $edit = DB::table('agency')->where('id', $id)->first();
        return view('backend.agency.edit_agency', compact('edit', 'title'));
    }

    public function EditAgencyProcess(Request $request, $id)
    {
        $data = array();
        $data['agency_name'] = $request->agency_name;
        $data['abbrev'] = $request->abbrev;

        $update = DB::table('agency')->where('id', $id)->update($data);
        if ($update) {
            $notification = array(
                'message' => 'Agency Successfully Edited!',
                'alert-type' => 'success'
            );
            return redirect()->route('AllAgency')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('AllAgency')->with($notification);
        }
    }

    public function downloadTemplate()
    {
        $file_path = storage_path("app\public\import-templates\agency-template.xlsx");
        return Response::download($file_path);
    }
    public function DeleteAgency($id)
    {
        $delete = DB::table('agency')->where('id', $id)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Agency Successfully Deleted!',
                'alert-type' => 'success'
            );
            return redirect()->route('AllAgency')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('AllAgency')->with($notification);
        }
    }

}
