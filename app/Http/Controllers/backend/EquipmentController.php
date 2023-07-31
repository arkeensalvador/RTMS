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

        $data = array();
        $data['equipments_type'] = json_encode($request->equipments_type);
        $data['equipments_agency'] = $request->equipments_agency;
        $data['equipments_name'] = $request->equipments_name;
        $data['equipments_total'] = $request->equipments_total;
        $data['equipments_sof'] = $request->equipments_sof;


        $insert = DB::table('cbg_equipments')->insert($data);
        if ($insert) {

            $notification = array(
                'message' => 'Equipment Successfully Added!',
                'alert-type' => 'success'
            );

            return redirect()->route('cbgEquipment')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('cbgEquipment')->with($notification);
        }
    }

    public function editEquipment($id)
    {
        $title = 'Equipments | CBG';
        $all = DB::table('cbg_equipments')->where('id', $id)->first();
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();
        return view('backend.report.cbg.cbg_equipment_edit', compact('title', 'all', 'agency', 'researchers'));
    }

    public function UpdateEquipment(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['equipments_type'] = json_encode($request->equipments_type);
        $data['equipments_agency'] = $request->equipments_agency;
        $data['equipments_name'] = $request->equipments_name;
        $data['equipments_total'] = $request->equipments_total;
        $data['equipments_sof'] = $request->equipments_sof;
        $data['updated_at'] = now();

        $update = DB::table('cbg_equipments')->where('id', $id)->update($data);
        if ($update) {
            $notification = array(
                'message' => 'Equipment Successfully Updated!',
                'alert-type' => 'success'
            );

            return redirect()->route('cbgEquipment')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('cbgEquipment')->with($notification);
        }
    }

    public function DeleteEquipment($id)
    {
        $delete = DB::table('cbg_equipments')->where('id', $id)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Equipment Successfully Deleted!',
                'alert-type' => 'success'
            );

            return redirect()->route('cbgEquipment')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('cbgEquipment')->with($notification);
        }
    }
}
