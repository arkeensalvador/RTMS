<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Crypt;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;

class DbinfosysController extends Controller
{
    public function AddDbinfosys(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['dbinfosys_category'] = $request->dbinfosys_category;
        $data['dbinfosys_type'] = $request->dbinfosys_type;
        $data['dbinfosys_title'] = $request->dbinfosys_title;
        $data['dbinfosys_date_created'] = $request->dbinfosys_date_created;
        $data['dbinfosys_purpose'] = $request->dbinfosys_purpose;
        $data['created_at'] = now();

        $insert = DB::table('rdmc_dbinfosys')->insert($data);
        if ($insert) {

            $notification = array(
                'message' => $data['dbinfosys_category'] . ' Successfully Added!',
                'alert-type' => 'success'
            );

            return redirect()->route('dbInfoSys')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('dbInfoSys')->with($notification);
        }
    }

    public function EditDbinfosys($id)
    {
        $title = 'DBIS | RDMC';
        $all = DB::table('rdmc_dbinfosys')->where('id', $id)->first();
        // $id = Hash::make($id);
        return view('backend.report.rdmc.rdmc_dbinfosys_edit', compact('title', 'all'));
    }

    public function UpdateDbinfosys(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['dbinfosys_category'] = $request->dbinfosys_category;
        $data['dbinfosys_type'] = $request->dbinfosys_type;
        $data['dbinfosys_title'] = $request->dbinfosys_title;
        $data['dbinfosys_date_created'] = $request->dbinfosys_date_created;
        $data['dbinfosys_purpose'] = $request->dbinfosys_purpose;
        $data['edited_at'] = now();

        $update = DB::table('rdmc_dbinfosys')->where('id', $id)->update($data);
        if ($update) {

            $notification = array(
                'message' => $data['dbinfosys_category'] . ' Successfully Updated!',
                'alert-type' => 'success'
            );

            return redirect()->route('dbInfoSys')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('dbInfoSys')->with($notification);
        }
    }

    public function DeleteDbinfosys($id)
    {
        $select = DB::table('rdmc_dbinfosys')->select('dbinfosys_category')->where('id', $id)->first();
        $delete = DB::table('rdmc_dbinfosys')->where('id', $id)->delete();
        if ($delete) {
            $notification = array(
                'message' => $select->dbinfosys_category . ' Successfully Deleted!',
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