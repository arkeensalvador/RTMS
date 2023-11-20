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
        $request->validate(
            [
                'trainings_type' => 'required',
                'trainings_sof' => 'required',
                'trainings_agency' => 'required',
                'trainings_title' => 'required',
                'trainings_research_center' => 'required',
                'trainings_expenditures' => 'required|numeric',
                'trainings_start' => 'required',
                'trainings_end' => 'required',
                'trainings_no_participants' => 'required|numeric',
                'trainings_venue' => 'required',
                'trainings_remarks' => 'required',
            ],
            [
                'trainings_type.required' => 'Type is required!',
                'trainings_sof.required' => 'Source of fund is required!',
                'trainings_agency.required' => 'Agency required!',
                'trainings_title.required' => 'Title is required!',
                'trainings_research_center.required' => 'Research center required!',
                'trainings_expenditures.required' => 'Expenditures is required!',
                'trainings_start.required' => 'Date is required!',
                'trainings_end.required' => 'Date is required!',
                'trainings_no_participants.required' => 'No. of participants is required!',
                'trainings_venue.required' => 'Venue is required!',
                'trainings_remarks.required' => 'Remarks is required!',
            ],
        );

        $data = [];
        $data['trainings_type'] = $request->trainings_type;
        $data['trainings_sof'] = $request->trainings_sof;
        $data['trainings_agency'] = $request->trainings_agency;
        $data['trainings_title'] = $request->trainings_title;
        $data['trainings_research_center'] = htmlspecialchars_decode(json_encode($request->trainings_research_center));
        $data['trainings_expenditures'] = str_replace(',', '', $request->trainings_expenditures);
        $data['trainings_start'] = $request->trainings_start;
        $data['trainings_end'] = $request->trainings_end;
        $data['trainings_no_participants'] = $request->trainings_no_participants;
        $data['trainings_venue'] = $request->trainings_venue;

        $data['created_at'] = now();

        $insert = DB::table('cbg_trainings')->insert($data);
        if ($insert) {
            return response()->json(['success' => 'Training Added Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function editTraining($id)
    {
        $title = 'Trainings | CBG';
        $all = DB::table('cbg_trainings')
            ->where('id', $id)
            ->first();
        $agency = DB::table('agency')->get();
        return view('backend.report.cbg.cbg_training_edit', compact('title', 'all', 'agency'));
    }

    public function UpdateTraining(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');
        $request->validate(
            [
                'trainings_type' => 'required',
                'trainings_sof' => 'required',
                'trainings_agency' => 'required',
                'trainings_title' => 'required',
                'trainings_research_center' => 'required',
                'trainings_expenditures' => 'required|numeric',
                'trainings_start' => 'required',
                'trainings_end' => 'required',
                'trainings_no_participants' => 'required|numeric',
                'trainings_venue' => 'required',
                'trainings_remarks' => 'required',
            ],
            [
                'trainings_type.required' => 'Type is required!',
                'trainings_sof.required' => 'Source of fund is required!',
                'trainings_agency.required' => 'Agency required!',
                'trainings_title.required' => 'Title is required!',
                'trainings_research_center.required' => 'Research center required!',
                'trainings_expenditures.required' => 'Expenditures is required!',
                'trainings_start.required' => 'Date is required!',
                'trainings_end.required' => 'Date is required!',
                'trainings_no_participants.required' => 'No. of participants is required!',
                'trainings_venue.required' => 'Venue is required!',
                'trainings_remarks.required' => 'Remarks is required!',
            ],
        );
        $data = [];
        $data['trainings_type'] = $request->trainings_type;
        $data['trainings_sof'] = $request->trainings_sof;
        $data['trainings_agency'] = $request->trainings_agency;
        $data['trainings_title'] = $request->trainings_title;
        $data['trainings_research_center'] = htmlspecialchars_decode(json_encode($request->trainings_research_center));
        $data['trainings_expenditures'] = str_replace(',', '', $request->trainings_expenditures);
        $data['trainings_start'] = $request->trainings_start;
        $data['trainings_end'] = $request->trainings_end;
        $data['trainings_no_participants'] = $request->trainings_no_participants;
        $data['trainings_venue'] = $request->trainings_venue;
        $data['trainings_remarks'] = $request->trainings_remarks;
        $data['updated_at'] = now();

        $update = DB::table('cbg_trainings')
            ->where('id', $id)
            ->update($data);
        if ($update) {
            return response()->json(['success' => 'Training Updated Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function DeleteTraining($id)
    {
        $delete = DB::table('cbg_trainings')
            ->where('id', $id)
            ->delete();
        if ($delete) {
            $notification = [
                'message' => 'Training/Workshop Successfully Deleted!',
                'alert-type' => 'success',
            ];

            return redirect()
                ->route('cbgTraining')
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('cbgTraining')
                ->with($notification);
        }
    }
}
