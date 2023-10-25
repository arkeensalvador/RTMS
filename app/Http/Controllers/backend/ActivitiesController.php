<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ActivitiesController extends Controller
{
    //
    public function AddActivities(Request $request)
    {
        $data = array();
        $data['donor'] = $request->donor;
        $data['activity_type'] = $request->activity_type;
        $data['activity_title'] = $request->activity_title;
        $data['shared_amount'] = str_replace(',', '', $request->shared_amount);
        $data['remarks'] = $request->remarks;
        $data['created_at'] = now();

        $insert = DB::table('rdmc_activities')->insert($data);
        if ($insert) {
            return response()->json(['success' => 'Activity Successfully Added!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }

        // if ($insert) {

        //     $notification = array(
        //         'message' => 'Activity Successfully Added!',
        //         'alert-type' => 'success'
        //     );

        //     return redirect()->route('rdmcActivities')->with($notification);
        // } else {
        //     $notification = array(
        //         'message' => 'Something is wrong, please try again!',
        //         'alert-type' => 'error'
        //     );
        //     return redirect()->route('rdmcActivities')->with($notification);
        // }
    }

    public function EditActivity($id)
    {
        $title = 'Activities | RDMC';
        $all = DB::table('rdmc_activities')->where('id', $id)->first();
        $agency = DB::table('agency')->get();
        return view('backend.report.rdmc.rdmc_edit_activities', compact('title', 'all', 'agency'));
    }

    public function UpdateActivity(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['donor'] = $request->donor;
        $data['activity_type'] = $request->activity_type;
        $data['activity_title'] = $request->activity_title;
        $data['shared_amount'] = str_replace(',', '', $request->shared_amount);
        $data['remarks'] = $request->remarks;
        $data['updated_at'] = now();

        $update = DB::table('rdmc_activities')->where('id', $id)->update($data);

        if ($update) {
            return response()->json(['success' => 'Activity Successfully Updated!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }

        // if ($update) {
        //     $notification = array(
        //         'message' => 'Activity Successfully Updated!',
        //         'alert-type' => 'success'
        //     );
        //     return redirect()->route('rdmcActivities')->with($notification);
        // } else {
        //     $notification = array(
        //         'message' => 'Something is wrong, please try again!',
        //         'alert-type' => 'error'
        //     );
        //     return redirect()->route('rdmcActivities')->with($notification);
        // }
    }

    public function DeleteActivity($id)
    {
        $delete = DB::table('rdmc_activities')->where('id', $id)->delete();
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
