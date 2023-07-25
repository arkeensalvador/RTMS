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
        $data['awards_type'] = $request->awards_type;
        $data['awards_agency'] = $request->awards_agency;
        $data['awards_title'] = $request->awards_title;
        $data['awards_date'] = $request->awards_date;
        $data['awards_sponsor'] = $request->awards_sponsor;
        $data['awards_event'] = $request->awards_event;
        $data['awards_place'] = $request->awards_place;
        $data['awards_recipients'] = htmlspecialchars_decode(json_encode($request->awards_recipients));
        

        $insert = DB::table('cbg_awards')->insert($data);
        if ($insert) {

            $notification = array(
                'message' => 'Award Successfully Added!',
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
        $researchers = DB::table('researchers')->get();
        return view('backend.report.cbg.cbg_awards_edit', compact('title', 'all', 'agency','researchers'));
    }

    public function UpdateAward(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['awards_type'] = $request->awards_type;
        $data['awards_agency'] = $request->awards_agency;
        $data['awards_title'] = $request->awards_title;
        $data['awards_date'] = $request->awards_date;
        $data['awards_sponsor'] = $request->awards_sponsor;
        $data['awards_event'] = $request->awards_event;
        $data['awards_place'] = $request->awards_place;
        $data['awards_recipients'] = htmlspecialchars_decode(json_encode($request->awards_recipients));
        $data['updated_at'] = now();

        $update = DB::table('cbg_awards')->where('id', $id)->update($data);
        if ($update) {
            $notification = array(
                'message' => 'Award Successfully Updated!',
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
                'message' => 'Award Successfully Deleted!',
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
