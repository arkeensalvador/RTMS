<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class EquipmentController extends Controller
{
    public function AddEquipment(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $request->validate(
            [
                'equipments_type' => 'required',
                'equipments_agency' => 'required',
                'equipments_name' => 'required',
                'equipments_details' => 'required',
                'equipments_total' => 'required|numeric',
                'equipments_sof' => 'required|array|min:1',
            ],
            [
                'equipments_type.required' => 'Type field is required!',
                'equipments_agency.required' => 'Agency field is required!',
                'equipments_name.required' => 'Name field is required!',
                'equipments_details.required' => 'Details field is required!',
                'equipments_total.required' => 'Total field is required! (Input numbers only)',
                'equipments_sof.required' => 'Source of funds field is required!',
            ],
        );

        $data = [];
        $data['equipments_type'] = $request->equipments_type;
        $data['equipments_agency'] = $request->equipments_agency;
        $data['equipments_name'] = $request->equipments_name;
        $data['equipments_details'] = $request->equipments_details;
        $data['equipments_total'] = $request->equipments_total;
        $data['equipments_sof'] = json_encode($request->equipments_sof);
        $data['encoder_agency'] = auth()->user()->agencyID;
        $data['created_at'] = now();

        $insert = DB::table('cbg_equipments')->insert($data);
        if ($insert) {
            return response()->json(['success' => 'Equipment Added Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function editEquipment($id)
    {
        $title = 'Equipments | CBG';
        $all = DB::table('cbg_equipments')
            ->where('id', $id)
            ->first();
        $imgs = DB::table('equipment_imgs')
            ->where('equipment_id', $id)
            ->get();
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();
        return view('backend.report.cbg.cbg_equipment_edit', compact('title', 'all', 'agency', 'researchers', 'imgs'));
    }

    public function UpdateEquipment(Request $request, $id)
    {
        $request->validate(
            [
                'equipments_type' => 'required',
                'equipments_agency' => 'required',
                'equipments_name' => 'required',
                'equipments_details' => 'required',
                'equipments_total' => 'required|numeric',
                'equipments_sof' => 'required|array|min:1',
            ],
            [
                'equipments_type.required' => 'Type field is required!',
                'equipments_agency.required' => 'Agency field is required!',
                'equipments_name.required' => 'Name field is required!',
                'equipments_details.required' => 'Details field is required!',
                'equipments_total.required' => 'Total field is required! (Input numbers only)',
                'equipments_sof.required' => 'Source of funds field is required!',
            ],
        );

        date_default_timezone_set('Asia/Hong_Kong');

        $data = [];
        $data['equipments_type'] = $request->equipments_type;
        $data['equipments_agency'] = $request->equipments_agency;
        $data['equipments_name'] = $request->equipments_name;
        $data['equipments_details'] = $request->equipments_details;
        $data['equipments_total'] = $request->equipments_total;
        $data['equipments_sof'] = json_encode($request->equipments_sof);
        $data['updated_at'] = now();

        $update = DB::table('cbg_equipments')
            ->where('id', $id)
            ->update($data);
        if ($update) {
            return response()->json(['success' => 'Equipment Updated Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function DeleteEquipment($id)
    {
        $delete = DB::table('cbg_equipments')
            ->where('id', $id)
            ->delete();
        if ($delete) {
            $notification = [
                'message' => 'Equipment Successfully Deleted!',
                'alert-type' => 'success',
            ];

            return redirect()
                ->route('cbgEquipment')
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('cbgEquipment')
                ->with($notification);
        }
    }
}
