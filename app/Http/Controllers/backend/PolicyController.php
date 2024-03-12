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
        $request->validate(
            [
                'prc_title' => 'required',
                'prc_agency' => 'required',
                'prc_author' => 'required',
                'prc_issues' => 'required',
                'prc_date' => 'required',
            ],
            [
                'prc_title.required' => 'Title is required!',
                'prc_agency.required' => 'Agency is required!',
                'prc_author.required' => 'Author is required!',
                'prc_issues.required' => 'Issues field is required!',
                'prc_date.required' => 'Date is required!',
            ],
        );

        $data = [];
        $data['prc_title'] = $request->prc_title;
        $data['prc_agency'] = $request->prc_agency;
        $data['prc_author'] = $request->prc_author;
        $data['prc_issues'] = $request->prc_issues;
        $data['prc_date'] = $request->prc_date;
        $data['encoder_agency'] = auth()->user()->agencyID;
        $data['created_at'] = now();

        $insert = DB::table('policy_prc')->insert($data);

        if ($insert) {
            return response()->json(['success' => 'Data Successfully Added!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function prc_edit(Request $request, $id)
    {
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
        $request->validate(
            [
                'prc_title' => 'required',
                'prc_agency' => 'required',
                'prc_author' => 'required',
                'prc_issues' => 'required',
                'prc_date' => 'required',
            ],
            [
                'prc_title.required' => 'Title is required!',
                'prc_agency.required' => 'Agency is required!',
                'prc_author.required' => 'Author is required!',
                'prc_issues.required' => 'Issues field is required!',
                'prc_date.required' => 'Date is required!',
            ],
        );

        $data = [];
        $data['prc_title'] = $request->prc_title;
        $data['prc_agency'] = $request->prc_agency;
        $data['prc_author'] = $request->prc_author;
        $data['prc_issues'] = $request->prc_issues;
        $data['prc_date'] = $request->prc_date;
        $data['updated_at'] = now();

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
            $notification = [
                'message' => 'Policy Successfully Deleted!',
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

    // FORMULATED POLICY FUNCTIONS
    public function formulated_add(Request $request)
    {
        $request->validate(
            [
                'policy_type' => 'required',
                'policy_title' => 'required',
                'policy_agency' => 'required',
                'policy_date' => 'required',
                'policy_beneficiary' => 'required',
                'policy_implementer' => 'required',
                'policy_author' => 'required',
                'policy_co_author' => 'required',
                'policy_issues' => 'required',
            ],
            [
                'policy_type.required' => 'Type is required!',
                'policy_title.required' => 'Title is required!',
                'policy_agency.required' => 'Agency is required!',
                'policy_date.required' => 'Date is required!',
                'policy_issues.required' => 'Issues addressed is required!',
                'policy_beneficiary.required' => 'Beneficiary is required!',
                'policy_implementer.required' => 'Implementer is required!',
                'policy_author.required' => 'Author is required!',
                'policy_co_author.required' => 'Co-author is required!',
            ],
        );
        $data = [];
        $data['policy_type'] = $request->policy_type;
        $data['policy_title'] = $request->policy_title;
        $data['policy_agency'] = $request->policy_agency;
        $data['policy_date'] = $request->policy_date;
        $data['policy_issues'] = $request->policy_issues;
        $data['policy_implementer'] = $request->policy_implementer;
        $data['policy_beneficiary'] = $request->policy_beneficiary;
        $data['policy_author'] = $request->policy_author;
        $data['policy_co_author'] = $request->policy_co_author;

        $data['encoder_agency'] = auth()->user()->agencyID;

        $insert = DB::table('policy_formulated')->insert($data);

        if ($insert) {
            return response()->json(['success' => 'Data Successfully Added!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function formulated_edit(Request $request, $id)
    {
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
        $request->validate(
            [
                'policy_type' => 'required',
                'policy_title' => 'required',
                'policy_agency' => 'required',
                'policy_date' => 'required',
                'policy_beneficiary' => 'required',
                'policy_implementer' => 'required',
                'policy_author' => 'required',
                'policy_co_author' => 'required',
                'policy_issues' => 'required',
            ],
            [
                'policy_type.required' => 'Type is required!',
                'policy_title.required' => 'Title is required!',
                'policy_agency.required' => 'Agency is required!',
                'policy_date.required' => 'Date is required!',
                'policy_issues.required' => 'Issues addressed is required!',
                'policy_beneficiary.required' => 'Beneficiary is required!',
                'policy_implementer.required' => 'Implementer is required!',
                'policy_author.required' => 'Author is required!',
                'policy_co_author.required' => 'Co-author is required!',
            ],
        );
        $data = [];
        $data['policy_type'] = $request->policy_type;
        $data['policy_title'] = $request->policy_title;
        $data['policy_agency'] = $request->policy_agency;
        $data['policy_date'] = $request->policy_date;
        $data['policy_issues'] = $request->policy_issues;
        $data['policy_implementer'] = $request->policy_implementer;
        $data['policy_beneficiary'] = $request->policy_beneficiary;
        $data['policy_author'] = $request->policy_author;
        $data['policy_co_author'] = $request->policy_co_author;

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
            $notification = [
                'message' => 'Policy Successfully Deleted!',
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
