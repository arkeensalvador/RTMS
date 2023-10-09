<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class StrategicController extends Controller
{
    public function AddStrategic(Request $request)
    {
        $data =  array();
        $data['strategic_program'] = $request->strategic_program;
        $data['strategic_title'] = $request->strategic_title;
        $data['strategic_start'] = $request->strategic_start;
        $data['strategic_end'] = $request->strategic_end;
        $data['strategic_researcher'] = $request->strategic_researcher;
        $data['strategic_implementing_agency'] = $request->strategic_implementing_agency;
        $data['strategic_funding_agency'] = $request->strategic_funding_agency;
        $data['strategic_budget'] = str_replace(',', '', $request->strategic_budget);
        $data['strategic_commodities'] = $request->strategic_commodities;
        $data['strategic_consortium_role'] = $request->strategic_consortium_role;
        $data['created_at'] = now();

        $insert = DB::table('strategic_activities')->insert($data);
        if ($insert) {
            return response()->json(['success' => 'R & D Activity Added Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function EditStrategic($id)
    {
        $title = 'Strategic R&D Activities';
        $all = DB::table('strategic_activities')->where('id', $id)->first();
        $researchers = DB::table('researchers')->get();
        $agency = DB::table('agency')->get();
        return view('backend.report.strategic.edit_strategic_activities', compact('title', 'all', 'agency', 'researchers'));
    }

    public function UpdateStrategic(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data =  array();
        $data['strategic_program'] = $request->strategic_program;
        $data['strategic_title'] = $request->strategic_title;
        $data['strategic_start'] = $request->strategic_start;
        $data['strategic_end'] = $request->strategic_end;
        $data['strategic_researcher'] = $request->strategic_researcher;
        $data['strategic_implementing_agency'] = $request->strategic_implementing_agency;
        $data['strategic_funding_agency'] = $request->strategic_funding_agency;
        $data['strategic_budget'] =  str_replace(',', '', $request->strategic_budget);
        $data['strategic_commodities'] = $request->strategic_commodities;
        $data['strategic_consortium_role'] = $request->strategic_consortium_role;
        $data['updated_at'] = now();

        $insert = DB::table('strategic_activities')->where('id', $id)->update($data);
        if ($insert) {
            return response()->json(['success' => 'R & D Activity Updated Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function DeleteStrategic($id)
    {
        $delete = DB::table('strategic_activities')->where('id', $id)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Activity Successfully Deleted!',
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
