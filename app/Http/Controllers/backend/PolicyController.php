<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use Crypt;
use Illuminate\Http\Request;
use DB;

class PolicyController extends Controller
{
    public function prc_add_index()
    {
        $title = 'Policy';
        $all = DB::table('policy_prc')->get();
        $agency = DB::table('agency')->get();

        // CMI

        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->get();
        return view('backend.report.policy.policy_prc_add', compact('title', 'all', 'agency', 'user_agency'));
    }

    public function formulated_add_index()
    {
        $title = 'Policy';
        $all = DB::table('policy_prc')->get();
        $agency = DB::table('agency')->get();

        // CMI

        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->get();
        return view('backend.report.policy.policy_formulated_add', compact('title', 'all', 'agency', 'user_agency'));
    }

    public function prc_add(Request $request)
    {

        $data = array();
        $data["prc_title"] = $request->prc_title;
        $data["prc_agency"] = $request->prc_agency;
        $data["prc_author"] = $request->prc_author;
        $data["prc_issues"] = $request->prc_issues;

        $insert = DB::table('policy_prc')->insert($data);

        if ($insert) {
            return response()->json(['success' => 'Data Successfully Added!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function prc_edit(Request $request, $id) {
        $title = 'Policy';
        $id = Crypt::decryptString($id);
        $all = DB::table('policy_prc')->where('id', $id)->first();
        $agency = DB::table('agency')->get();

        // CMI

        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->get();

        return view('backend.report.policy.policy_prc_edit', compact('title', 'all', 'agency', 'user_agency'));
    }
    public function prc_update(Request $request, $id)
    {
        $data = array();
        $data["prc_title"] = $request->prc_title;
        $data["prc_agency"] = $request->prc_agency;
        $data["prc_author"] = $request->prc_author;
        $data["prc_issues"] = $request->prc_issues;


        $insert = DB::table('policy_prc')->where('id', $id)->update($data);

        if ($insert) {
            return response()->json(['success' => 'Data Successfully Updated!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }


    public function prc_delete($id)
    {
        $id = Crypt::decryptString($id);
        $delete = DB::table('policy_prc')->where('id', $id)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Policy Successfully Deleted!',
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


    // FORMULATED POLICY FUNCTIONS
    public function formulated_add(Request $request)
    {

        $data = array();
        $data["policy_type"] = $request->policy_type;
        $data["policy_agency"] = $request->policy_agency;
        $data["policy_issues"] = $request->policy_issues;

        $insert = DB::table('policy_formulated')->insert($data);

        if ($insert) {
            return response()->json(['success' => 'Data Successfully Added!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function formulated_edit(Request $request, $id) {
        $title = 'Policy';
        $id = Crypt::decryptString($id);
        $all = DB::table('policy_formulated')->where('id', $id)->first();
        $agency = DB::table('agency')->get();

        // CMI

        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->get();

        return view('backend.report.policy.policy_formulated_edit', compact('title', 'all', 'agency', 'user_agency'));
    }
    public function formulated_update(Request $request, $id)
    {
        $data = array();
        $data["policy_type"] = $request->policy_type;
        $data["policy_agency"] = $request->policy_agency;
        $data["policy_issues"] = $request->policy_issues;


        $insert = DB::table('policy_formulated')->where('id', $id)->update($data);

        if ($insert) {
            return response()->json(['success' => 'Data Successfully Updated!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }


    public function formulated_delete($id)
    {
        $id = Crypt::decryptString($id);
        $delete = DB::table('policy_formulated')->where('id', $id)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Policy Successfully Deleted!',
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
