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
        $request->validate(
            [
                'strategic_program' => 'required',
                'strategic_title' => 'required',
                'strategic_start' => 'required',
                'strategic_end' => 'required',
                'strategic_researcher' => 'required',
                'strategic_implementing_agency' => 'required',
                'strategic_funding_agency' => 'required',
                'strategic_budget' => 'required|numeric',
                'strategic_commodities' => 'required',
                'strategic_consortium_role' => 'required',
            ],
            [
                'strategic_program.required' => 'Program is required!',
                'strategic_title.required' => 'Title is required!',
                'strategic_start.required' => 'Date is required!',
                'strategic_end.required' => 'Date is required!',
                'strategic_researcher.required' => 'Researcher(s) is/are required!',
                'strategic_implementing_agency.required' => 'Implementing agency is required!',
                'strategic_funding_agency.required' => 'Funding agency is required!',
                'strategic_budget.required' => 'Budget is required!',
                'strategic_commodities.required' => 'Commodities is required!',
                'strategic_consortium_role.required' => 'Consortium role is required!',
            ],
        );

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

        $request->validate(
            [
                'strategic_program' => 'required',
                'strategic_title' => 'required',
                'strategic_start' => 'required',
                'strategic_end' => 'required',
                'strategic_researcher' => 'required',
                'strategic_implementing_agency' => 'required',
                'strategic_funding_agency' => 'required',
                'strategic_budget' => 'required|numeric',
                'strategic_commodities' => 'required',
                'strategic_consortium_role' => 'required',
            ],
            [
                'strategic_program.required' => 'Program is required!',
                'strategic_title.required' => 'Title is required!',
                'strategic_start.required' => 'Date is required!',
                'strategic_end.required' => 'Date is required!',
                'strategic_researcher.required' => 'Researcher(s) is/are required!',
                'strategic_implementing_agency.required' => 'Implementing agency is required!',
                'strategic_funding_agency.required' => 'Funding agency is required!',
                'strategic_budget.required' => 'Budget is required!',
                'strategic_commodities.required' => 'Commodities is required!',
                'strategic_consortium_role.required' => 'Consortium role is required!',
            ],
        );

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
        $request->validate(
            [
                'tech_type' => 'required',
                'tech_title' => 'required',
                'tech_desc' => 'required',
                'tech_source' => 'required',
                'tech_researchers' => 'required',
                'tech_agency' => 'required',
                'tech_impact' => 'required',
            ],
            [
                'tech_type.required' => 'Type is required!',
                'tech_title.required' => 'Title is required!',
                'tech_desc.required' => 'Description is required!',
                'tech_source.required' => 'Program/Project source is required!',
                'tech_researchers.required' => 'Researcher(s) is/are required!',
                'tech_agency.required' => 'Agency source is required!',
                'tech_impact.required' => 'Impact is required!',
            ],
        );

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

        $request->validate(
            [
                'tech_type' => 'required',
                'tech_title' => 'required',
                'tech_desc' => 'required',
                'tech_source' => 'required',
                'tech_researchers' => 'required',
                'tech_agency' => 'required',
                'tech_impact' => 'required',
            ],
            [
                'tech_type.required' => 'Type is required!',
                'tech_title.required' => 'Title is required!',
                'tech_desc.required' => 'Description is required!',
                'tech_source.required' => 'Program/Project source is required!',
                'tech_researchers.required' => 'Researcher(s) is/are required!',
                'tech_agency.required' => 'Agency source is required!',
                'tech_impact.required' => 'Impact is required!',
            ],
        );

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

    // Program/project implemented/packaged

    public function add_strategic_program_list(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');
        $request->validate(
            [
                'str_p_type' => 'required',
                'str_p_title' => 'required',
                'str_p_researchers' => 'required',
                'str_p_imp_agency' => 'required',
                'str_p_collab_agency' => 'required',
                'str_p_date' => 'required',
                'str_p_budget' => 'required|numeric',
                'str_p_sof' => 'required',
                'str_p_regional' => 'required',
            ],
            [
                'str_p_type.required' => 'Type is required!',
                'str_p_title.required' => 'Title is required!',
                'str_p_researchers.required' => 'Researcher(s) is/are required!',
                'str_p_imp_agency.required' => 'Implementing agency is required!',
                'str_p_collab_agency.required' => 'Collaborating agency required!',
                'str_p_date.required' => 'Date is required!',
                'str_p_budget.required' => 'Budget is required!',
                'str_p_sof.required' => 'Source of fund is required!',
                'str_p_regional.required' => 'Commodities addressed is required!',
            ],
        );

        $data = [];
        $data['str_p_type'] = $request->str_p_type;
        $data['str_p_title'] = $request->str_p_title;
        $data['str_p_researchers'] = $request->str_p_researchers;
        $data['str_p_imp_agency'] = json_encode($request->str_p_imp_agency);
        $data['str_p_collab_agency'] = json_encode($request->str_p_collab_agency);
        $data['str_p_date'] = $request->str_p_date;
        $data['str_p_budget'] = $request->str_p_budget;
        $data['str_p_sof'] = $request->str_p_sof;
        $data['str_p_regional'] = $request->str_p_regional;
        $data['created_at'] = now();

        $insert = DB::table('strategic_program_list')->insert($data);
        if ($insert) {
            return response()->json(['success' => 'Data Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function edit_strategic_program_list_index($id)
    {
        $title = 'TPA | R&D Results Utilizations';
        $id = Crypt::decryptString($id);
        $all = DB::table('strategic_program_list')
            ->where('id', $id)
            ->first();
        $programs = DB::table('programs')->get();
        $projects = DB::table('projects')->get();
        $sub_projects = DB::table('sub_projects')->get();
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();
        return view('backend.report.strategic.strategic_program_edit', compact('title', 'all', 'agency', 'researchers', 'programs', 'projects', 'sub_projects'));
    }

    public function update_strategic_program_list(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $request->validate(
            [
                'str_p_type' => 'required',
                'str_p_title' => 'required',
                'str_p_researchers' => 'required',
                'str_p_imp_agency' => 'required',
                'str_p_collab_agency' => 'required',
                'str_p_date' => 'required',
                'str_p_budget' => 'required|numeric',
                'str_p_sof' => 'required',
                'str_p_regional' => 'required',
            ],
            [
                'str_p_type.required' => 'Type is required!',
                'str_p_title.required' => 'Title is required!',
                'str_p_researchers.required' => 'Researcher(s) is/are required!',
                'str_p_imp_agency.required' => 'Implementing agency is required!',
                'str_p_collab_agency.required' => 'Collaborating agency required!',
                'str_p_date.required' => 'Date is required!',
                'str_p_budget.required' => 'Budget is required!',
                'str_p_sof.required' => 'Source of fund is required!',
                'str_p_regional.required' => 'Commodities addressed is required!',
            ],
        );

        $data = [];
        $data['str_p_type'] = $request->str_p_type;
        $data['str_p_title'] = $request->str_p_title;
        $data['str_p_researchers'] = $request->str_p_researchers;
        $data['str_p_imp_agency'] = json_encode($request->str_p_imp_agency);
        $data['str_p_collab_agency'] = json_encode($request->str_p_collab_agency);
        $data['str_p_date'] = $request->str_p_date;
        $data['str_p_budget'] = $request->str_p_budget;
        $data['str_p_sof'] = $request->str_p_sof;
        $data['str_p_regional'] = $request->str_p_regional;
        $data['updated_at'] = now();

        $insert = DB::table('strategic_program_list')
            ->where('id', $id)
            ->update($data);
        if ($insert) {
            return response()->json(['success' => 'Data Updated Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function delete_strategic_program_list($id)
    {
        $id = Crypt::decryptString($id);

        $delete = DB::table('strategic_program_list')
            ->where('id', $id)
            ->delete();
        if ($delete) {
            $notification = [
                'message' => 'Data Successfully Deleted!',
                'alert-type' => 'success',
            ];

            return redirect()
                ->route('strategic_program_list')
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('strategic_program_list')
                ->with($notification);
        }
    }

    // Collaborative R&D Programs/Projects implemented

    public function getProjects(Request $request)
    {
        $programID = $request->input('program_id');

        $result = DB::table('sub_projects')
            ->where('programID', $programID)
            ->exists();

        if ($result) {
            $projects = DB::table('projects')
                ->rightJoin('sub_projects', 'projects.id', '=', 'sub_projects.projectID')
                ->where('projects.programID', $programID)
                ->get();
        } else {
            $projects = DB::table('projects')
                // ->rightJoin('sub_projects', 'projects.id', '=', 'sub_projects.projectID')
                ->where('projects.programID', $programID)
                ->get();
        }

        return response()->json($projects);
    }

    public function add_strategic_collaborative_list(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');
        $request->validate(
            [
                'str_collab_type' => 'required',
                'str_collab_program' => 'required',
                'str_collab_project' => 'required',
                'str_collab_imp_agency' => 'required',
                'str_collab_agency' => 'required',
                'str_collab_date' => 'required',
                'str_collab_budget' => 'required|numeric',
                'str_collab_sof' => 'required',
                'str_collab_roc' => 'required',
            ],
            [
                'str_collab_type.required' => 'Type is required!',
                'str_collab_program.required' => 'Program is required!',
                'str_collab_project.required' => 'Project(s) is/are required!',
                'str_collab_imp_agency.required' => 'Implementing agency is required!',
                'str_collab_agency.required' => 'Collaborating agency required!',
                'str_collab_date.required' => 'Date is required!',
                'str_collab_budget.required' => 'Budget is required!',
                'str_collab_sof.required' => 'Source of fund is required!',
                'str_collab_roc.required' => 'Role of consortium is required!',
            ],
        );

        $data = [];
        $data['str_collab_type'] = $request->str_collab_type;
        $data['str_collab_program'] = $request->str_collab_program;
        $data['str_collab_project'] = json_encode($request->str_collab_project);
        $data['str_collab_imp_agency'] = json_encode($request->str_collab_imp_agency);
        $data['str_collab_agency'] = json_encode($request->str_collab_agency);
        $data['str_collab_date'] = $request->str_collab_date;
        $data['str_collab_budget'] = $request->str_collab_budget;
        $data['str_collab_sof'] = $request->str_collab_sof;
        $data['str_collab_roc'] = $request->str_collab_roc;
        $data['created_at'] = now();

        $insert = DB::table('strategic_collaborative_list')->insert($data);
        if ($insert) {
            return response()->json(['success' => 'Data Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function edit_strategic_collaborative_list_index($id, $programID)
    {
        $title = 'TPA | R&D Results Utilizations';
        $id = Crypt::decryptString($id);
        $all = DB::table('strategic_collaborative_list')
            ->where('id', $id)
            ->first();
        $programs = DB::table('programs')->get();
        $projects = DB::table('projects')->get();

        $sub_projects = DB::table('sub_projects')->get();
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();

        return view('backend.report.strategic.strategic_collaborative_edit', compact('title', 'all', 'agency', 'researchers', 'programs', 'projects', 'sub_projects'));
    }

    public function update_strategic_collaborative_list(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $request->validate(
            [
                'str_collab_type' => 'required',
                'str_collab_program' => 'required',
                'str_collab_project' => 'required',
                'str_collab_imp_agency' => 'required',
                'str_collab_agency' => 'required',
                'str_collab_date' => 'required',
                'str_collab_budget' => 'required|numeric',
                'str_collab_sof' => 'required',
                'str_collab_roc' => 'required',
                'str_collab_program_title' => 'required',
            ],
            [
                'str_collab_type.required' => 'Type is required!',
                'str_collab_program.required' => 'Program is required!',
                'str_collab_project.required' => 'Project(s) is/are required!',
                'str_collab_imp_agency.required' => 'Implementing agency is required!',
                'str_collab_agency.required' => 'Collaborating agency required!',
                'str_collab_date.required' => 'Date is required!',
                'str_collab_budget.required' => 'Budget is required!',
                'str_collab_sof.required' => 'Source of fund is required!',
                'str_collab_roc.required' => 'Commodities addressed is required!',
                'str_collab_program_title.required' => 'Commodities addressed is required!',
            ],
        );

        $data = [];
        $data['str_collab_type'] = $request->str_collab_type;
        $data['str_collab_program'] = $request->str_collab_program;
        $data['str_collab_project'] = json_encode($request->str_collab_project);
        $data['str_collab_imp_agency'] = json_encode($request->str_collab_imp_agency);
        $data['str_collab_agency'] = json_encode($request->str_collab_agency);
        $data['str_collab_date'] = $request->str_collab_date;
        $data['str_collab_budget'] = $request->str_collab_budget;
        $data['str_collab_sof'] = $request->str_collab_sof;
        $data['str_collab_roc'] = $request->str_collab_roc;
        $data['updated_at'] = now();

        $insert = DB::table('strategic_collaborative_list')
            ->where('id', $id)
            ->update($data);
        if ($insert) {
            return response()->json(['success' => 'Data Updated Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function delete_strategic_collaborative_list($id)
    {
        $id = Crypt::decryptString($id);

        $delete = DB::table('strategic_collaborative_list')
            ->where('id', $id)
            ->delete();
        if ($delete) {
            $notification = [
                'message' => 'Data Successfully Deleted!',
                'alert-type' => 'success',
            ];

            return redirect()
                ->route('strategic_collaborative_list')
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('strategic_collaborative_list')
                ->with($notification);
        }
    }
}
