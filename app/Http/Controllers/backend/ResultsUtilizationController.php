<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Crypt;

class ResultsUtilizationController extends Controller
{
    // TTP
    public function AddTtp(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');
        $request->validate(
            [
                'ttp_type' => 'required',
                'ttp_title' => 'required',
                'ttp_budget' => 'required|numeric',
                'ttp_sof' => 'required',
                'ttp_proponent' => 'required',
                'ttp_researchers' => 'required',
                'ttp_implementing_agency' => 'required',
                'ttp_start_date' => 'required',
                'ttp_end_date' => 'required',
                'ttp_priorities' => 'required',
            ],
            [
                'ttp_type.required' => 'Type is required!',
                'ttp_title.required' => 'Title of fund is required!',
                'ttp_budget.required' => 'Budget is required!',
                'ttp_sof.required' => 'Source of fund is required!',
                'ttp_proponent.required' => 'Proponent is required!',
                'ttp_researchers.required' => 'Researcher(s) is/are required!',
                'ttp_implementing_agency.required' => 'Implementing agency is required!',
                'ttp_start_date.required' => 'Date is required!',
                'ttp_end_date.required' => 'Date is required!',
                'ttp_priorities.required' => 'Regional priorities addressed is required!',
            ],
        );
        $data = [];
        $data['ttp_type'] = $request->ttp_type;
        $data['ttp_title'] = $request->ttp_title;
        $data['ttp_budget'] = str_replace(',', '', $request->ttp_budget);
        $data['ttp_sof'] = $request->ttp_sof;
        $data['ttp_proponent'] = $request->ttp_proponent;
        $data['ttp_researchers'] = json_encode($request->ttp_researchers);
        $data['ttp_implementing_agency'] = json_encode($request->ttp_implementing_agency);
        $data['ttp_start_date'] = $request->ttp_start_date;
        $data['ttp_end_date'] = $request->ttp_end_date;
        $data['ttp_priorities'] = $request->ttp_priorities;
        $data['created_at'] = now();

        $insert = DB::table('results_ttp')->insert($data);
        if ($insert) {
            return response()->json(['success' => 'TTP Added Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function editTtp($id)
    {
        $title = 'TTP | R&D Results Utilizations';
        $all = DB::table('results_ttp')
            ->where('id', $id)
            ->first();
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();
        return view('backend.report.rdru.rdru_ttp_edit', compact('title', 'all', 'agency', 'researchers'));
    }

    public function UpdateTtp(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');
        $request->validate(
            [
                'ttp_type' => 'required',
                'ttp_title' => 'required',
                'ttp_budget' => 'required|numeric',
                'ttp_sof' => 'required',
                'ttp_proponent' => 'required',
                'ttp_researchers' => 'required',
                'ttp_implementing_agency' => 'required',
                'ttp_start_date' => 'required',
                'ttp_end_date' => 'required',
                'ttp_priorities' => 'required',
            ],
            [
                'ttp_type.required' => 'Type is required!',
                'ttp_title.required' => 'Title is required!',
                'ttp_budget.required' => 'Budget is required!',
                'ttp_sof.required' => 'Source of fund is required!',
                'ttp_proponent.required' => 'Proponent is required!',
                'ttp_researchers.required' => 'Researcher(s) is/are required!',
                'ttp_implementing_agency.required' => 'Implementing agency is required!',
                'ttp_start_date.required' => 'Date is required!',
                'ttp_end_date.required' => 'Date is required!',
                'ttp_priorities.required' => 'Regional priorities addressed is required!',
            ],
        );
        $data = [];
        $data['ttp_type'] = $request->ttp_type;
        $data['ttp_title'] = $request->ttp_title;
        $data['ttp_budget'] = str_replace(',', '', $request->ttp_budget);
        $data['ttp_sof'] = $request->ttp_sof;
        $data['ttp_proponent'] = $request->ttp_proponent;
        $data['ttp_researchers'] = json_encode($request->ttp_researchers);
        $data['ttp_implementing_agency'] = json_encode($request->ttp_implementing_agency);
        $data['ttp_start_date'] = $request->ttp_start_date;
        $data['ttp_end_date'] = $request->ttp_end_date;
        $data['ttp_priorities'] = $request->ttp_priorities;
        $data['updated_at'] = now();

        $update = DB::table('results_ttp')
            ->where('id', $id)
            ->update($data);
        if ($update) {
            return response()->json(['success' => 'TTP Updated Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function DeleteTtp($id)
    {
        $delete = DB::table('results_ttp')
            ->where('id', $id)
            ->delete();
        if ($delete) {
            $notification = [
                'message' => 'Transfer Proposal Successfully Deleted!',
                'alert-type' => 'success',
            ];

            return redirect()
                ->route('rdruTtp')
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('rdruTtp')
                ->with($notification);
        }
    }

    // TTM

    public function AddTtm(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');
        $request->validate(
            [
                'ttm_type' => 'required',
                'ttm_title' => 'required',
                'ttm_status' => 'required|numeric',
                'ttm_agency' => 'required',
            ],
            [
                'ttm_type.required' => 'Type is required!',
                'ttm_title.required' => 'Title is required!',
                'ttm_status.required' => 'Status is required!',
                'ttm_agency.required' => 'Agency is required!',
            ],
        );
        $data = [];
        $data['ttm_type'] = $request->ttm_type;
        $data['ttm_title'] = $request->ttm_title;
        $data['ttm_status'] = $request->ttm_status;
        $data['ttm_agency'] = $request->ttm_agency;
        $data['created_at'] = now();

        $insert = DB::table('results_ttm')->insert($data);
        if ($insert) {
            return response()->json(['success' => 'TTM Added Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function editTtm($id)
    {
        $title = 'TTM | R&D Results Utilizations';
        $all = DB::table('results_ttm')
            ->where('id', $id)
            ->first();
        $agency = DB::table('agency')->get();
        return view('backend.report.rdru.rdru_ttm_edit', compact('title', 'all', 'agency'));
    }

    public function UpdateTtm(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');
        $request->validate(
            [
                'ttm_type' => 'required',
                'ttm_title' => 'required',
                'ttm_status' => 'required|numeric',
                'ttm_agency' => 'required',
            ],
            [
                'ttm_type.required' => 'Type is required!',
                'ttm_title.required' => 'Title is required!',
                'ttm_status.required' => 'Status is required!',
                'ttm_agency.required' => 'Agency is required!',
            ],
        );

        $data = [];
        $data['ttm_type'] = $request->ttm_type;
        $data['ttm_title'] = $request->ttm_title;
        $data['ttm_status'] = $request->ttm_status;
        $data['ttm_agency'] = $request->ttm_agency;
        $data['updated_at'] = now();

        $update = DB::table('results_ttm')
            ->where('id', $id)
            ->update($data);
        if ($update) {
            return response()->json(['success' => 'TTM Updated Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function DeleteTtm($id)
    {
        $delete = DB::table('results_ttm')
            ->where('id', $id)
            ->delete();
        if ($delete) {
            $notification = [
                'message' => 'Transfer Modality Successfully Deleted!',
                'alert-type' => 'success',
            ];

            return redirect()
                ->route('rdruTtm')
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('rdruTtm')
                ->with($notification);
        }
    }

    // TPA

    public function AddTpa(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $request->validate(
            [
                'tpa_title' => 'required',
                'tpa_date' => 'required',
                'tpa_details' => 'required',
                'tpa_remarks' => 'required',
                'tpa_researchers' => 'required',
                'tpa_agency' => 'required',
                'tpa_approaches' => 'required|array|min:1',
            ],
            [
                'tpa_title.required' => 'Title is required!',
                'tpa_date.required' => 'Date is required!',
                'tpa_details.required' => 'Details is required!',
                'tpa_remarks.required' => 'Remarks is required!',
                'tpa_researchers.required' => 'Researcher(s) is/are required!',
                'tpa_agency.required' => 'Agency is required!',
                'tpa_approaches.required' => 'Select 1 Information, Education and Communication (IEC) Approaches',
            ],
        );

        $data = [];
        $data['tpa_title'] = $request->tpa_title;
        $data['tpa_date'] = $request->tpa_date;
        $data['tpa_details'] = $request->tpa_details;
        $data['tpa_remarks'] = $request->tpa_remarks;
        $data['tpa_researchers'] = json_encode($request->tpa_researchers);
        $data['tpa_agency'] = $request->tpa_agency;
        $data['tpa_approaches'] = json_encode($request->tpa_approaches);
        $data['is_others'] = $request->is_others;
        $data['created_at'] = now();

        $insert = DB::table('results_tpa')->insert($data);
        if ($insert) {
            return response()->json(['success' => 'TPA Added Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function editTpa($id)
    {
        $title = 'TPA | R&D Results Utilizations';
        $all = DB::table('results_tpa')
            ->where('id', $id)
            ->first();
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();
        return view('backend.report.rdru.rdru_tpa_edit', compact('title', 'all', 'agency', 'researchers'));
    }

    public function UpdateTpa(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');
        $request->validate(
            [
                'tpa_title' => 'required',
                'tpa_date' => 'required',
                'tpa_details' => 'required',
                'tpa_remarks' => 'required',
                'tpa_researchers' => 'required',
                'tpa_agency' => 'required',
                'tpa_approaches' => 'required|array|min:1',
            ],
            [
                'tpa_title.required' => 'Title is required!',
                'tpa_date.required' => 'Date is required!',
                'tpa_details.required' => 'Details is required!',
                'tpa_remarks.required' => 'Remarks is required!',
                'tpa_researchers.required' => 'Researcher(s) is/are required!',
                'tpa_agency.required' => 'Agency is required!',
                'tpa_approaches.required' => 'Select 1 Information, Education and Communication (IEC) Approaches',
            ],
        );

        $data = [];
        $data['tpa_title'] = $request->tpa_title;
        $data['tpa_date'] = $request->tpa_date;
        $data['tpa_details'] = $request->tpa_details;
        $data['tpa_remarks'] = $request->tpa_remarks;
        $data['tpa_researchers'] = json_encode($request->tpa_researchers);
        $data['tpa_agency'] = $request->tpa_agency;
        $data['tpa_approaches'] = json_encode($request->tpa_approaches);
        $data['is_others'] = $request->is_others;
        $data['updated_at'] = now();

        $update = DB::table('results_tpa')
            ->where('id', $id)
            ->update($data);
        if ($update) {
            return response()->json(['success' => 'TPA Updated Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function DeleteTpa($id)
    {
        $delete = DB::table('results_tpa')
            ->where('id', $id)
            ->delete();
        if ($delete) {
            $notification = [
                'message' => 'Transfer Modality Successfully Deleted!',
                'alert-type' => 'success',
            ];

            return redirect()
                ->route('rdruTpa')
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('rdruTpa')
                ->with($notification);
        }
    }

    // AJAX REQUEST
    public function getResearchers(Request $request)
    {
        $agencyId = $request->input('agency_id');
        $researchers = DB::table('researchers')
            ->where('agency', $agencyId)
            ->get();

        return response()->json($researchers);
    }

    // TECHNOLOGIES

    public function rdru_add_tech_deployed(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $request->validate(
            [
                'rdru_tech_title' => 'required',
                'rdru_tech_type' => 'required',
                'rdru_tech_sof' => 'required',
            ],
            [
                'rdru_tech_title.required' => 'Title is required!',
                'rdru_tech_type.required' => 'Type is required!',
                'rdru_tech_sof.required' => 'Source of fund is required!',
            ],
        );

        $data = [];
        $data['rdru_tech_title'] = $request->rdru_tech_title;
        $data['rdru_tech_type'] = $request->rdru_tech_type;
        $data['rdru_tech_sof'] = $request->rdru_tech_sof;
        $data['created_at'] = now();

        $insert = DB::table('rdru_tech_deployed')->insert($data);
        if ($insert) {
            return response()->json(['success' => 'Data Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function rdru_edit_tech_deployed_index($id)
    {
        $title = 'TPA | R&D Results Utilizations';
        $id = Crypt::decryptString($id);
        $all = DB::table('rdru_tech_deployed')
            ->where('id', $id)
            ->first();
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();
        return view('backend.report.rdru.rdru_tech_deployed_edit', compact('title', 'all', 'agency', 'researchers'));
    }

    public function rdru_update_tech_deployed(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $request->validate(
            [
                'rdru_tech_title' => 'required',
                'rdru_tech_type' => 'required',
                'rdru_tech_sof' => 'required',
            ],
            [
                'rdru_tech_title.required' => 'Title is required!',
                'rdru_tech_type.required' => 'Type is required!',
                'rdru_tech_sof.required' => 'Source of fund is required!',
            ],
        );

        $data = [];
        $data['rdru_tech_title'] = $request->rdru_tech_title;
        $data['rdru_tech_type'] = $request->rdru_tech_type;
        $data['rdru_tech_sof'] = $request->rdru_tech_sof;
        $data['updated_at'] = now();

        $insert = DB::table('rdru_tech_deployed')
            ->where('id', $id)
            ->update($data);
        if ($insert) {
            return response()->json(['success' => 'Data Updated Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function rdru_delete_tech_deployed($id)
    {
        $id = Crypt::decryptString($id);

        $delete = DB::table('rdru_tech_deployed')
            ->where('id', $id)
            ->delete();
        if ($delete) {
            $notification = [
                'message' => 'Data Successfully Deleted!',
                'alert-type' => 'success',
            ];

            return redirect()
                ->route('rdru_tech_deployed')
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('rdru_tech_deployed')
                ->with($notification);
        }
    }
}
