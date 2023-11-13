<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Crypt;
use Illuminate\Http\Request;
use DB;

class StrategicController extends Controller
{
    public function AddStrategic(Request $request)
    {
        $data = [];
        $data['strategic_program'] = $request->strategic_program;
        $data['strategic_title'] = $request->strategic_title;
        $data['strategic_start'] = $request->strategic_start;
        $data['strategic_end'] = $request->strategic_end;
        $data['strategic_researcher'] = json_encode($request->strategic_researcher);
        $data['strategic_implementing_agency'] = $request->strategic_implementing_agency;
        $data['strategic_funding_agency'] = $request->strategic_funding_agency;
        $data['strategic_budget'] = str_replace(',', '', $request->strategic_budget);
        $data['strategic_commodities'] = $request->strategic_commodities;
        $data['strategic_consortium_role'] = $request->strategic_consortium_role;
        $data['created_at'] = now();

        $insert = DB::table('strategic_activities')->insert($data);
        if ($insert) {
            return response()->json(['success' => 'R & D Activity Added Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function EditStrategic($id)
    {
        $id = Crypt::decryptString($id);
        $title = 'Strategic R&D Activities';
        $all = DB::table('strategic_activities')
            ->where('id', $id)
            ->first();
        $researchers = DB::table('researchers')->get();
        $agency = DB::table('agency')->get();
        return view('backend.report.strategic.edit_strategic_activities', compact('title', 'all', 'agency', 'researchers'));
    }

    public function UpdateStrategic(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = [];
        $data['strategic_program'] = $request->strategic_program;
        $data['strategic_title'] = $request->strategic_title;
        $data['strategic_start'] = $request->strategic_start;
        $data['strategic_end'] = $request->strategic_end;
        $data['strategic_researcher'] = json_encode($request->strategic_researcher);
        $data['strategic_implementing_agency'] = $request->strategic_implementing_agency;
        $data['strategic_funding_agency'] = $request->strategic_funding_agency;
        $data['strategic_budget'] = str_replace(',', '', $request->strategic_budget);
        $data['strategic_commodities'] = $request->strategic_commodities;
        $data['strategic_consortium_role'] = $request->strategic_consortium_role;
        $data['updated_at'] = now();

        $insert = DB::table('strategic_activities')
            ->where('id', $id)
            ->update($data);
        if ($insert) {
            return response()->json(['success' => 'R & D Activity Updated Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function DeleteStrategic($id)
    {
        $id = Crypt::decryptString($id);
        $delete = DB::table('strategic_activities')
            ->where('id', $id)
            ->delete();
        if ($delete) {
            $notification = [
                'message' => 'Activity Successfully Deleted!',
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

    // Tech list
    public function add_strategic_tech_list(Request $request)
    {
        $data = [];
        $data['tech_type'] = $request->tech_type;
        $data['tech_title'] = $request->tech_title;
        $data['tech_desc'] = $request->tech_desc;
        $data['tech_source'] = $request->tech_source;
        $data['tech_researchers'] = json_encode($request->tech_researchers);
        $data['tech_agency'] = $request->tech_agency;
        $data['tech_impact'] = $request->tech_impact;
        $data['created_at'] = now();

        $insert = DB::table('strategic_tech_list')->insert($data);
        if ($insert) {
            return response()->json(['success' => 'Data Added Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function getSource(Request $request)
    {
        $agency = $request->input('agency_id');

        $data = DB::table('agency')
            ->join('programs', 'agency.abbrev', '=', 'programs.implementing_agency')
            ->join('projects', 'programs.implementing_agency', '=', 'projects.project_implementing_agency')
            ->join('sub_projects', 'projects.project_implementing_agency', '=', 'sub_projects.sub_project_implementing_agency')
            ->where('agency.abbrev', $agencyId)
            ->select('programs.program_title as program_title', 'projects.project_title as project_title', 'sub_projects.sub_project_title as sub_project_title')
            ->get();

        return view('fetch-source', compact('data'));
    }

    public function edit_strategic_tech_list_index($id)
    {
        $id = Crypt::decryptString($id);
        $title = 'Strategic R&D Activities';
        $all = DB::table('strategic_tech_list')
            ->where('id', $id)
            ->first();
        $researchers = DB::table('researchers')->get();
        $agency = DB::table('agency')->get();
        $programs = DB::table('programs')->get();
        $projects = DB::table('projects')->get();
        $sub_projects = DB::table('sub_projects')->get();

        return view('backend.report.strategic.tech_list_edit', compact('title', 'all', 'agency', 'researchers', 'programs', 'projects', 'sub_projects'));
    }

    public function update_strategic_tech_list(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = [];
        $data['tech_type'] = $request->tech_type;
        $data['tech_title'] = $request->tech_title;
        $data['tech_desc'] = $request->tech_desc;
        $data['tech_source'] = $request->tech_source;
        $data['tech_researchers'] = json_encode($request->tech_researchers);
        $data['tech_agency'] = $request->tech_agency;
        $data['tech_impact'] = $request->tech_impact;
        $data['updated_at'] = now();

        $insert = DB::table('strategic_tech_list')
            ->where('id', $id)
            ->update($data);
        if ($insert) {
            return response()->json(['success' => 'Data Updated Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function delete_strategic_tech_list($id)
    {
        $id = Crypt::decryptString($id);
        $delete = DB::table('strategic_tech_list')
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
