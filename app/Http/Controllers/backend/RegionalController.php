<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegionalController extends Controller
{
    public function regional_add(Request $request)
    {
        $data = [];
        $data['regional_category'] = $request->regional_category;
        $data['regional_title'] = $request->regional_title;
        $data['regional_implementing_agency'] = json_encode($request->regional_implementing_agency);
        $data['regional_researchers'] = json_encode($request->regional_researchers);
        $data['regional_recommendations'] = $request->regional_recommendations;
        $data['regional_winners'] = $request->regional_winners;
        $data['created_at'] = now();

        $insert = DB::table('rdmc_regional')->insert($data);
        if ($insert) {
            return response()->json(['success' => 'Data Successfully Added!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function regional_edit($id)
    {
        $id = Crypt::decryptString($id);
        $title = 'Participants of Regional Symposium on R&D Highlights';
        $all = DB::table('rdmc_regional')
            ->where('id', $id)
            ->first();
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();

        // CMI
        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->get();

        $researchers_filter = DB::table('researchers')
            ->where('agency', auth()->user()->agencyID)
            ->get();
        return view('backend.report.rdmc.rdmc_regional_participants_edit', compact('title', 'all', 'agency', 'researchers', 'user_agency', 'researchers_filter'));
    }

    public function regional_update(Request $request, $id)
    {
        // $id = Crypt::decryptString($id);
        $data = [];
        $data['regional_category'] = $request->regional_category;
        $data['regional_title'] = $request->regional_title;
        $data['regional_implementing_agency'] = json_encode($request->regional_implementing_agency);
        $data['regional_researchers'] = json_encode($request->regional_researchers);
        $data['regional_recommendations'] = $request->regional_recommendations;
        $data['regional_winners'] = $request->regional_winners;
        $data['updated_at'] = now();

        $insert = DB::table('rdmc_regional')
            ->where('id', $id)
            ->update($data);
        if ($insert) {
            return response()->json(['success' => 'Data Successfully Updated!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function regional_delete($id)
    {
        $id = Crypt::decryptString($id);
        $delete = DB::table('rdmc_regional')
            ->where('id', $id)
            ->delete();
        if ($delete) {
            $notification = [
                'message' => 'Data Successfully Deleted!',
                'alert-type' => 'success',
            ];
            return redirect()
                ->back()
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->back()
                ->with($notification);
        }
    }

    // Regional Participants
    public function regional_participants_add(Request $request)
    {
        $data = [];
        $data['rp_type'] = $request->rp_type;
        $data['rp_agency'] = $request->rp_agency;
        $data['rp_no'] = $request->rp_no;
        $data['rp_remarks'] = $request->rp_remarks;

        $data['created_at'] = now();

        $insert = DB::table('rdmc_regional_participants')->insert($data);
        if ($insert) {
            return response()->json(['success' => 'Data Successfully Added!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function regional_participants_edit($id)
    {
        $id = Crypt::decryptString($id);
        $title = 'Participants of Regional Symposium on R&D Highlights';
        $all = DB::table('rdmc_regional_participants')
            ->where('id', $id)
            ->first();
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();

        // CMI
        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->get();

        $researchers_filter = DB::table('researchers')
            ->where('agency', auth()->user()->agencyID)
            ->get();
        return view('backend.report.rdmc.rdmc_regional_participants_edit', compact('title', 'all', 'agency', 'researchers', 'user_agency', 'researchers_filter'));
    }

    public function regional_participants_update(Request $request, $id)
    {
        // $id = Crypt::decryptString($id);
        $data = [];
        $data['rp_type'] = $request->rp_type;
        $data['rp_agency'] = $request->rp_agency;
        $data['rp_no'] = $request->rp_no;
        $data['rp_remarks'] = $request->rp_remarks;
        $data['updated_at'] = now();

        $insert = DB::table('rdmc_regional_participants')
            ->where('id', $id)
            ->update($data);
        if ($insert) {
            return response()->json(['success' => 'Data Successfully Updated!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function regional_participants_delete($id)
    {
        $id = Crypt::decryptString($id);
        $delete = DB::table('rdmc_regional_participants')
            ->where('id', $id)
            ->delete();
        if ($delete) {
            $notification = [
                'message' => 'Data Successfully Deleted!',
                'alert-type' => 'success',
            ];
            return redirect()
                ->back()
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->back()
                ->with($notification);
        }
    }
}
