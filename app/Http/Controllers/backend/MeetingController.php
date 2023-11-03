<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MeetingController extends Controller
{
    public function meeting_add(Request $request)
    {
        $data = array();
        $data["meeting_type"] = $request->meeting_type;
        $data["meeting_venue"] = $request->meeting_venue;
        $data["meeting_date"] = $request->meeting_date;
        $data["meeting_host"] = $request->meeting_host;

        $insert = DB::table("cbg_meetings")->insert($data);
        if ($insert) {
            return response()->json(['success' => 'Meeting Successfully Added!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function meeting_edit(Request $request, $id)
    {
        $title = 'Meetings | CBG';
        $id = Crypt::decryptString($id);
        $all = DB::table('cbg_meetings')->where('id', $id)->first();
        $agency = DB::table('agency')->get();
        return view('backend.report.cbg.cbg_meetings_edit', compact('title', 'agency', 'all'));
    }

    public function meeting_update(Request $request, $id)
    {
        $data = array();
        $data["meeting_type"] = $request->meeting_type;
        $data["meeting_venue"] = $request->meeting_venue;
        $data["meeting_date"] = $request->meeting_date;
        $data["meeting_host"] = $request->meeting_host;

        $update = DB::table("cbg_meetings")->where('id', $id)->update($data);
        if ($update) {
            return response()->json(['success' => 'Meeting Successfully Updated!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }


    public function meeting_delete($id)
    {
        $id = Crypt::decryptString($id);
        $delete = DB::table('cbg_meetings')->where('id', $id)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Meeting Successfully Deleted!',
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
