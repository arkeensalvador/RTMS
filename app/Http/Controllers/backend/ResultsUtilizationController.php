<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ResultsUtilizationController extends Controller
{
    // TTP
    public function AddTtp(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['ttp_type'] = $request->ttp_type;
        $data['ttp_title'] = $request->ttp_title;
        $data['ttp_budget'] = str_replace(',', '', $request->ttp_budget);
        $data['ttp_sof'] = $request->ttp_sof;
        $data['ttp_proponent'] = $request->ttp_proponent;
        $data['ttp_researchers'] = json_encode($request->ttp_researchers);
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
        $all = DB::table('results_ttp')->where('id', $id)->first();
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();
        return view('backend.report.rdru.rdru_ttp_edit', compact('title', 'all', 'agency', 'researchers'));
    }

    public function UpdateTtp(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['ttp_type'] = $request->ttp_type;
        $data['ttp_title'] = $request->ttp_title;
        $data['ttp_budget'] = str_replace(',', '', $request->ttp_budget);
        $data['ttp_sof'] = $request->ttp_sof;
        $data['ttp_proponent'] = $request->ttp_proponent;
        $data['ttp_researchers'] = json_encode($request->ttp_researchers);
        $data['ttp_start_date'] = $request->ttp_start_date;
        $data['ttp_end_date'] = $request->ttp_end_date;
        $data['ttp_priorities'] = $request->ttp_priorities;
        $data['updated_at'] = now();

        $update = DB::table('results_ttp')->where('id', $id)->update($data);
        if ($update) {
            return response()->json(['success' => 'TTP Updated Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function DeleteTtp($id)
    {
        $delete = DB::table('results_ttp')->where('id', $id)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Transfer Proposal Successfully Deleted!',
                'alert-type' => 'success'
            );

            return redirect()->route('rdruTtp')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('rdruTtp')->with($notification);
        }
    }

    // TTM

    public function AddTtm(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
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
        $all = DB::table('results_ttm')->where('id', $id)->first();
        $agency = DB::table('agency')->get();
        return view('backend.report.rdru.rdru_ttm_edit', compact('title', 'all', 'agency'));
    }

    public function UpdateTtm(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['ttm_type'] = $request->ttm_type;
        $data['ttm_title'] = $request->ttm_title;
        $data['ttm_status'] = $request->ttm_status;
        $data['ttm_agency'] = $request->ttm_agency;
        $data['updated_at'] = now();

        $update = DB::table('results_ttm')->where('id', $id)->update($data);
        if ($update) {
            return response()->json(['success' => 'TTM Updated Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function DeleteTtm($id)
    {
        $delete = DB::table('results_ttm')->where('id', $id)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Transfer Modality Successfully Deleted!',
                'alert-type' => 'success'
            );

            return redirect()->route('rdruTtm')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('rdruTtm')->with($notification);
        }
    }

    // TPA

    public function AddTpa(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['tpa_title'] = $request->tpa_title;
        $data['tpa_date'] = $request->tpa_date;
        $data['tpa_details'] = $request->tpa_details;
        $data['tpa_remarks'] = $request->tpa_remarks;
        $data['tpa_approaches'] = json_encode($request->tpa_approaches);
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
        $all = DB::table('results_tpa')->where('id', $id)->first();
        $agency = DB::table('agency')->get();
        return view('backend.report.rdru.rdru_tpa_edit', compact('title', 'all', 'agency'));
    }

    public function UpdateTpa(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['tpa_title'] = $request->tpa_title;
        $data['tpa_date'] = $request->tpa_date;
        $data['tpa_details'] = $request->tpa_details;
        $data['tpa_remarks'] = $request->tpa_remarks;
        $data['tpa_approaches'] = json_encode($request->tpa_approaches);
        $data['updated_at'] = now();

        $update = DB::table('results_tpa')->where('id', $id)->update($data);
        if ($update) {
            return response()->json(['success' => 'TPA Added Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function DeleteTpa($id)
    {
        $delete = DB::table('results_tpa')->where('id', $id)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Transfer Modality Successfully Deleted!',
                'alert-type' => 'success'
            );

            return redirect()->route('rdruTpa')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('rdruTpa')->with($notification);
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
}
