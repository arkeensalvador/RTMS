<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RegionalSymposiumParticipants;

class RegionalController extends Controller
{
    public function regional_add(Request $request)
    {
        $request->validate(
            [
                'regional_category' => 'required',
                'regional_title' => 'required',
                'regional_implementing_agency' => 'required',
                'regional_researchers' => 'required',
                'regional_recommendations' => 'required',
                'regional_winners' => 'required',
            ],
            [
                'regional_category.required' => 'Category is required!',
                'regional_title.required' => 'Title is required!',
                'regional_implementing_agency.required' => 'Implementing agency is required!',
                'regional_researchers.required' => 'Researchers is/are required!',
                'regional_recommendations.required' => 'Recommendations field is required!',
                'regional_winners.required' => 'Winners is/are required!',
            ],
        );
        $data = [];
        $data['regional_category'] = $request->regional_category;
        $data['regional_title'] = $request->regional_title;
        $data['regional_implementing_agency'] = json_encode($request->regional_implementing_agency);
        $data['regional_researchers'] = json_encode($request->regional_researchers);
        $data['regional_recommendations'] = $request->regional_recommendations;
        $data['regional_winners'] = $request->regional_winners;
        $data['created_at'] = now();

        $insert = DB::table('rdmc_regional')->insert($data);
        if ($insert) {
            return response()->json(['success' => 'Data Successfully Added!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function regional_edit($id)
    {
        $id = Crypt::decryptString($id);
        $title = 'Participants of Regional Symposium on R&D Highlights';
        $all = DB::table('rdmc_regional')->where('id', $id)->first();
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();

        // CMI
        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->get();

        $researchers_filter = DB::table('researchers')
            ->where('agency', auth()->user()->agencyID)
            ->get();
        return view('backend.report.rdmc.rdmc_regional_edit', compact('title', 'all', 'agency', 'researchers', 'user_agency', 'researchers_filter'));
    }

    public function regional_update(Request $request, $id)
    {
        // $id = Crypt::decryptString($id);
        $request->validate(
            [
                'regional_category' => 'required',
                'regional_title' => 'required',
                'regional_implementing_agency' => 'required',
                'regional_researchers' => 'required',
                'regional_recommendations' => 'required',
                'regional_winners' => 'required',
            ],
            [
                'regional_category.required' => 'Category is required!',
                'regional_title.required' => 'Title is required!',
                'regional_implementing_agency.required' => 'Implementing agency is required!',
                'regional_researchers.required' => 'Researchers is/are required!',
                'regional_recommendations.required' => 'Recommendations field is required!',
                'regional_winners.required' => 'Winners is/are required!',
            ],
        );
        $data = [];
        $data['regional_category'] = $request->regional_category;
        $data['regional_title'] = $request->regional_title;
        $data['regional_implementing_agency'] = json_encode($request->regional_implementing_agency);
        $data['regional_researchers'] = json_encode($request->regional_researchers);
        $data['regional_recommendations'] = $request->regional_recommendations;
        $data['regional_winners'] = $request->regional_winners;
        $data['updated_at'] = now();

        $insert = DB::table('rdmc_regional')->where('id', $id)->update($data);
        if ($insert) {
            return response()->json(['success' => 'Data Successfully Updated!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function regional_delete($id)
    {
        $id = Crypt::decryptString($id);
        $delete = DB::table('rdmc_regional')->where('id', $id)->delete();
        if ($delete) {
            $notification = [
                'message' => 'Data Successfully Deleted!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

    // Regional Symposium Participants Highlights
    public function regional_participants_add(Request $request)
    {
        $request->validate(
            [
                // 'rp_type' => 'required',
                'rp_agency' => 'required',
                // 'rp_no' => 'required|numeric',
                'rp_remarks' => 'required',
            ],
            [
                // 'rp_type.required' => 'Type is required!',
                'rp_agency.required' => 'Agency is required!',
                // 'rp_no.required' => 'No. of participants is required!',
                'rp_remarks.required' => 'Remarks is required!',
            ],
        );

        $data = [];
        // $data['rp_type'] = $request->rp_type;
        $data['rp_agency'] = $request->rp_agency;
        // $data['rp_no'] = $request->rp_no;
        $data['rp_remarks'] = $request->rp_remarks;
        $data['created_at'] = now();

        $insert = DB::table('rdmc_regional_participants')->insertGetId($data);

        $data_participants = [];

        foreach ($request->type_of_participants as $key => $type) {
            $data_participants[] = [
                'regional_id' => $insert,
                'type_of_participants' => $type,
                'no_of_participants' => $request->no_of_participants[$key],
                'created_at' => now(),
            ];
        }

        $insert_participants = DB::table('regional_symposium_participants')->insert($data_participants);

        if ($insert && $insert_participants) {
            return response()->json(['success' => 'Data Successfully Added!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function regional_participants_edit($id)
    {
        $id = Crypt::decryptString($id);
        $title = 'Participants of Regional Symposium on R&D Highlights';
        $all = DB::table('rdmc_regional_participants')->where('id', $id)->first();
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();
        $participantsData = DB::table('regional_symposium_participants')->where('regional_id', $id)->get();

        // CMI
        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->get();

        $researchers_filter = DB::table('researchers')
            ->where('agency', auth()->user()->agencyID)
            ->get();
        return view('backend.report.rdmc.rdmc_regional_participants_edit', compact('title', 'all', 'agency', 'researchers', 'user_agency', 'researchers_filter', 'participantsData'));
    }

    public function regional_participants_update(Request $request, $id)
    {
        // $id = Crypt::decryptString($id);
        // $id = Crypt::decryptString($id);
        $request->validate(
            [
                // 'rp_type' => 'required',
                'rp_agency' => 'required',
                // 'rp_no' => 'required|numeric',
                'rp_remarks' => 'required',
            ],
            [
                // 'rp_type.required' => 'Type is required!',
                'rp_agency.required' => 'Agency is required!',
                // 'rp_no.required' => 'No. of participants is required!',
                'rp_remarks.required' => 'Remarks is required!',
            ],
        );
        $data = [];
        // $data['rp_type'] = $request->rp_type;
        $data['rp_agency'] = $request->rp_agency;
        // $data['rp_no'] = $request->rp_no;
        $data['rp_remarks'] = $request->rp_remarks;
        $data['updated_at'] = now();

        $this->processParticipantsData($request, $id);

        $update = DB::table('rdmc_regional_participants')->where('id', $id)->update($data);
        if ($update) {
            return response()->json(['success' => 'Data Successfully Updated!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    private function processParticipantsData(Request $request, $id)
    {
        // $id = Crypt::decryptString($id);
        // Retrieve existing data for the specified training_id
        $existingData = DB::table('regional_symposium_participants')->where('regional_id', $id)->get();

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
            DB::table('regional_symposium_participants')
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
                DB::table('regional_symposium_participants')->insert([
                    'regional_id' => $id,
                    'type_of_participants' => $newParticipants,
                    'no_of_participants' => $request->new_no_of_participants[$key],
                    'created_at' => now(),
                ]);
            }
        }
    }

    public function regional_participants_delete($id)
    {
        $id = Crypt::decryptString($id);
        $delete = DB::table('rdmc_regional_participants')->where('id', $id)->delete();
        if ($delete) {
            $notification = [
                'message' => 'Data Successfully Deleted!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
}
