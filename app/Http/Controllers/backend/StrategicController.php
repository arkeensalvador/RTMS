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
        $data['strategic_start'] = date('F, Y', strtotime($request->strategic_start));
        $data['strategic_end'] = date('F, Y', strtotime($request->strategic_end));
        $data['strategic_researcher'] = $request->strategic_researcher;
        $data['strategic_implementing_agency'] = $request->strategic_implementing_agency;
        $data['strategic_funding_agency'] = $request->strategic_funding_agency;
        $data['strategic_budget'] = $request->strategic_budget;
        $data['strategic_consortium_role'] = $request->strategic_consortium_role;

        $insert = DB::table('strategic_activities')->insert($data);
        if ($insert) {

            $notification = array(
                'message' => 'Activity Successfully Added!',
                'alert-type' => 'success'
            );

            return redirect()->route('strategicActivities')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('strategicActivities')->with($notification);
        }
    }
}
