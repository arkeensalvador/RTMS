<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class LinkagesController extends Controller
{
    public function AddLinkages(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['type'] = $request->type;
        $data['year'] = $request->year;
        $data['form_of_development'] = $request->form_of_development;
        $data['address'] = $request->address;
        $data['nature_of_assistance'] = $request->nature_of_assistance;
        $data['created_at'] = now();

        $insert = DB::table('rdmc_linkages')->insert($data);
        if ($insert) {
            return response()->json(['success' => 'Linkages Added Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }
    public function EditLinkages($id)
    {
        $title = 'Linkages | RDMC';
        $all =  DB::table('rdmc_linkages')->where('id', $id)->first();
        return view('backend.report.rdmc.rdmc_linkages_edit', compact('title', 'all'));
    }

    public function UpdateLinkages(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['type'] = $request->type;
        $data['year'] = $request->year;
        $data['form_of_development'] = $request->form_of_development;
        $data['address'] = $request->address;
        $data['nature_of_assistance'] = $request->nature_of_assistance;
        $data['updated_at'] = now();

        $update = DB::table('rdmc_linkages')->where('id', $id)->update($data);
        if ($update) {
            return response()->json(['success' => 'Linkages Updated Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function DeleteLinkages($id)
    {
        $delete = DB::table('rdmc_linkages')->where('id', $id)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Linkages Successfully Deleted!',
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
