<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Initiatives;
use Illuminate\Http\Request;
use DB;

class InitiativesController extends Controller
{
    public function ini_add(Request $request)
    {
        
        $data = array();
        $data["ini_initiates"] = $request->ini_initiates;
        $data["ini_date"] = $request->ini_date;

        $insert = DB::table('cbg_initiatives')->insert($data);

        if ($insert) {

            $notification = array(
                'message' => 'Initiative Successfully Added!',
                'alert-type' => 'success'
            );

            return redirect()->route('cbgInitiatives')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('cbgInitiatives')->with($notification);
        }
    }

    public function ini_update(Request $request, $id)
    {
        $data = array();
        $data["ini_initiates"] = $request->ini_initiates;
        $data["ini_date"] = $request->ini_date;

        $insert = DB::table('cbg_initiatives')->where('id', $id)->update($data);

        if ($insert) {

            $notification = array(
                'message' => 'Initiative Successfully Updated!',
                'alert-type' => 'success'
            );

            return redirect()->route('cbgInitiatives')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('cbgInitiatives')->with($notification);
        }
    }


    public function ini_delete($id)
    {
        $delete = DB::table('cbg_initiatives')->where('id', $id)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Initiative Successfully Deleted!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
