<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class AwardsController extends Controller
{
    public function AddAward(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['awards_sof'] = $request->awards_sof;
        $data['awards_agency'] = $request->awards_agency;
        $data['awards_title'] = $request->awards_title;
        $data['awards_expenditures'] = $request->awards_expenditures;
        $data['awards_start'] = $request->awards_start;
        $data['awards_end'] = $request->awards_end;
        $data['awards_no_participants'] = $request->awards_no_participants;

        $insert = DB::table('cbg_awards')->insert($data);
        if ($insert) {

            $notification = array(
                'message' => 'Training/Workshop Successfully Added!',
                'alert-type' => 'success'
            );

            return redirect()->route('cbgAwards')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('cbgAwards')->with($notification);
        }
    }

    public function editAward($id)
    {
        $title = 'Awards | CBG';
        $all = DB::table('cbg_awards')->where('id', $id)->first();
        $agency = DB::table('agency')->get();
        return view('backend.report.cbg.cbg_awards_edit', compact('title', 'all', 'agency'));
    }

    public function UpdateAward(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['awards_sof'] = $request->awards_sof;
        $data['awards_agency'] = $request->awards_agency;
        $data['awards_title'] = $request->awards_title;
        $data['awards_expenditures'] = $request->awards_expenditures;
        $data['awards_start'] = $request->awards_start;
        $data['awards_end'] = $request->awards_end;
        $data['awards_no_participants'] = $request->awards_no_participants;
        $data['updated_at'] = now();

        $update = DB::table('cbg_awards')->where('id', $id)->update($data);
        if ($update) {
            $notification = array(
                'message' => 'Training/Workshop Successfully Updated!',
                'alert-type' => 'success'
            );

            return redirect()->route('cbgAwards')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('cbgAwards')->with($notification);
        }
    }

    public function DeleteAward($id)
    {
        $delete = DB::table('cbg_awards')->where('id', $id)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Training/Workshop Successfully Deleted!',
                'alert-type' => 'success'
            );

            return redirect()->route('cbgAwards')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('cbgAwards')->with($notification);
        }
    }
}
