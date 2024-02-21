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
                // 'trainings_type' => 'required|array|min:1',
                'trainings_sof' => 'required|array|min:1',
                'trainings_agency' => 'required|array|min:1',
                'trainings_title' => 'required',
                // 'trainings_research_center' => 'required',
                'trainings_expenditures' => 'required',
                'trainings_start' => 'required',
                // 'trainings_no_participants' => 'required|numeric',
                'trainings_venue' => 'required',
            ],
            [
                // 'trainings_type.required' => 'Type of participants is required!',
                'trainings_sof.required' => 'Source of fund is required!',
                'trainings_agency.required' => 'Agency required!',
                'trainings_title.required' => 'Title is required!',
                // 'trainings_research_center.required' => 'Research center required!',
                'trainings_expenditures.required' => 'Expenditures is required!',
                'trainings_start.required' => 'Date is required!',
                // 'trainings_no_participants.required' => 'No. of participants is required!',
                'trainings_venue.required' => 'Venue is required!',
            ],
        );

        $data = [];
        // $data['trainings_type'] = json_encode($request->trainings_type);
        $data['trainings_sof'] = json_encode($request->trainings_sof);
        $data['trainings_agency'] = json_encode($request->trainings_agency);
        $data['trainings_title'] = $request->trainings_title;
        $data['trainings_research_center'] = htmlspecialchars_decode(json_encode($request->trainings_research_center));
        $data['trainings_expenditures'] = str_replace(',', '', $request->trainings_expenditures);
        $data['trainings_start'] = $request->trainings_start;
        // $data['trainings_no_participants'] = $request->trainings_no_participants;
        $data['trainings_venue'] = $request->trainings_venue;
        $data['encoder_agency'] = auth()->user()->agencyID;
        $data['created_at'] = now();

        $insert = DB::table('cbg_trainings')->insertGetId($data);

        $data_participants = [];

        foreach ($request->type_of_participants as $key => $type) {
            $data_participants[] = [
                'training_id' => $insert,
                'type_of_participants' => $type,
                'no_of_participants' => $request->no_of_participants[$key],
                'created_at' => now(),
            ];
        }
        // Insert data into the 'budgets' table
        $insert_participants = DB::table('training_participants')->insert($data_participants);

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

        $participantsData = DB::table('training_participants')
            ->where('training_id', $id)
            ->get();

        $imgs = DB::table('trainings_imgs')
            ->where('training_id', $id)
            ->get();
        $agency = DB::table('agency')->get();
        return view('backend.report.cbg.cbg_training_edit', compact('title', 'all', 'agency', 'imgs', 'participantsData'));
    }

    public function UpdateTraining(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');
        $request->validate(
            [
                // 'trainings_type' => 'required|array|min:1',
                'trainings_sof' => 'required|array|min:1',
                'trainings_agency' => 'required',
                'trainings_title' => 'required',
                // 'trainings_research_center' => 'required',
                'trainings_expenditures' => 'required',
                'trainings_start' => 'required',
                // 'trainings_no_participants' => 'required|numeric',
                'trainings_venue' => 'required',
                'trainings_remarks' => 'required',
            ],
            [
                // 'trainings_type.required' => 'Type is required!',
                'trainings_sof.required' => 'Source of fund is required!',
                'trainings_agency.required' => 'Agency required!',
                'trainings_title.required' => 'Title is required!',
                // 'trainings_research_center.required' => 'Research center required!',
                'trainings_expenditures.required' => 'Expenditures is required!',
                'trainings_start.required' => 'Date is required!',
                // 'trainings_no_participants.required' => 'No. of participants is required!',
                'trainings_venue.required' => 'Venue is required!',
                'trainings_remarks.required' => 'Remarks is required!',
            ],
        );
        $data = [];
        // $data['trainings_type'] = json_encode($request->trainings_type);
        $data['trainings_sof'] = json_encode($request->trainings_sof);
        $data['trainings_agency'] = json_encode($request->trainings_agency);
        $data['trainings_title'] = $request->trainings_title;
        $data['trainings_research_center'] = htmlspecialchars_decode(json_encode($request->trainings_research_center));
        $data['trainings_expenditures'] = str_replace(',', '', $request->trainings_expenditures);
        $data['trainings_start'] = $request->trainings_start;
        // $data['trainings_no_participants'] = $request->trainings_no_participants;
        $data['trainings_venue'] = $request->trainings_venue;
        $data['trainings_remarks'] = $request->trainings_remarks;
        $data['updated_at'] = now();

        $this->processParticipantsData($request, $id);

        $update = DB::table('cbg_trainings')
            ->where('id', $id)
            ->update($data);
        if ($update) {
            return response()->json(['success' => 'Training Updated Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    private function processParticipantsData(Request $request, $id)
    {
        // Retrieve existing data for the specified training_id
        $existingData = DB::table('training_participants')
            ->where('training_id', $id)
            ->get();

        $data_update = [];

        foreach ($existingData as $key => $existing) {
            $data_update[] = [
                'id' => $existing->id, // Assuming there is an 'id' column
                'type_of_participants' => $request->type_of_participants[$key],
                'no_of_participants' => $request->no_of_participants[$key],
            ];
        }

        // Update existing data in the 'training_participants' table based on training_id
        foreach ($data_update as $item) {
            DB::table('training_participants')
                ->where('id', $item['id'])
                ->update([
                    'type_of_participants' => $item['type_of_participants'],
                    'no_of_participants' => $item['no_of_participants'],
                    'updated_at' => now(),
                ]);
        }

        // Insert new data into the 'training_participants' table
        if ($request->has('new_type_of_participants')) {
            foreach ($request->new_type_of_participants as $key => $newParticipants) {
                DB::table('training_participants')->insert([
                    'training_id' => $id,
                    'type_of_participants' => $newParticipants,
                    'no_of_participants' => $request->new_no_of_participants[$key],
                    'created_at' => now(),
                ]);
            }
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

    public function delete_participant($id)
    {
        $delete = DB::table('training_participants')
            ->where('id', $id)
            ->delete();

        if ($delete) {
            $notification = [
                'message' => 'Participant Successfully Removed!',
                'alert-type' => 'success',
            ];
            return redirect()
                ->back()
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->back()
                ->with($notification);
        }
    }
}
