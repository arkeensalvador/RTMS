<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class TrainingsController extends Controller
{
    public function AddTraining(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['trainings_sof'] = $request->trainings_sof;
        $data['trainings_agency'] = $request->trainings_agency;
        $data['trainings_title'] = $request->trainings_title;
        $data['trainings_expenditures'] = $request->trainings_expenditures;
        $data['trainings_start'] = $request->trainings_start;
        $data['trainings_end'] = $request->trainings_end;
        $data['trainings_no_participants'] = $request->trainings_no_participants;

        $insert = DB::table('cbg_trainings')->insert($data);
        if ($insert) {

            $notification = array(
                'message' => 'Training/Workshop Successfully Added!',
                'alert-type' => 'success'
            );

            return redirect()->route('cbgTraining')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('cbgTraining')->with($notification);
        }
    }

    public function editTraining($id)
    {
        $title = 'Trainings | CBG';
        $all = DB::table('cbg_trainings')->where('id', $id)->first();
        $agency = DB::table('agency')->get();
        return view('backend.report.cbg.cbg_training_edit', compact('title', 'all', 'agency'));
    }

    public function UpdateTraining(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['trainings_sof'] = $request->trainings_sof;
        $data['trainings_agency'] = $request->trainings_agency;
        $data['trainings_title'] = $request->trainings_title;
        $data['trainings_expenditures'] = $request->trainings_expenditures;
        $data['trainings_start'] = $request->trainings_start;
        $data['trainings_end'] = $request->trainings_end;
        $data['trainings_no_participants'] = $request->trainings_no_participants;
        $data['updated_at'] = now();

        $update = DB::table('cbg_trainings')->where('id', $id)->update($data);
        if ($update) {
            $notification = array(
                'message' => 'Training/Workshop Successfully Updated!',
                'alert-type' => 'success'
            );

            return redirect()->route('cbgTraining')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('cbgTraining')->with($notification);
        }
    }

    public function DeleteTraining($id)
    {
        $delete = DB::table('cbg_trainings')->where('id', $id)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Training/Workshop Successfully Deleted!',
                'alert-type' => 'success'
            );

            return redirect()->route('cbgTraining')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('cbgTraining')->with($notification);
        }
    }
}
