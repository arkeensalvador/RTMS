<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Response;

class ResearcherController extends Controller
{
    public function researcherIndex()
    {
        $title = 'Researchers | RTMS';
        $all = DB::table('researchers')->get();

        // CMI
        $all_filter = DB::table('researchers')
            ->select('*')
            ->where('agency', auth()->user()->agencyID)
            ->get();

        $user_agency = DB::table('users')
            ->where('agencyID', auth()->user()->agencyID)
            ->first();

        return view('backend.researcher.researcher_index', compact('all', 'title', 'all_filter', 'user_agency'));
    }
    public function researcherAdd()
    {
        $title = 'Researchers | RTMS';
        $agency = DB::table('agency')->get();

        // CMI
        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->first();

        return view('backend.researcher.researcher_add', compact('agency', 'title', 'user_agency'));
    }

    public function AddResearcher(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'gender' => 'required',
                'contact' => 'required',
                'email' => 'required|email',
                'agency' => 'required',
            ],
            [
                'name.required' => 'Name is required!',
                'gender.required' => 'Sex is required!',
                'contact.required' => 'Contact number is required!',
                'email.required' => 'Email is required!',
                'agency.required' => 'Agency is required!',
            ],
        );
        $data = [];
        $data['name'] = $request->name;
        $data['gender'] = $request->gender;
        $data['contact'] = $request->contact;
        $data['email'] = $request->email;
        $data['agency'] = $request->agency;

        $researcher = DB::table('researchers')->insert($data);
        if ($researcher) {
            $notification = [
                'message' => 'Researcher Successfully Added!',
                'alert-type' => 'success',
            ];

            return redirect()
                ->route('researcherIndex')
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('researcherIndex')
                ->with($notification);
        }
    }

    public function EditResearcher($id)
    {
        $title = 'Researchers | RTMS';
        $researcher = DB::table('researchers')
            ->where('id', $id)
            ->first();
        $agency = DB::table('agency')->get();

        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->first();

        return view('backend.researcher.researcher_edit', compact('agency', 'researcher', 'title', 'user_agency'));
    }

    public function ViewResearcher($id)
    {
        $title = 'Researchers | RTMS';
        $researcher = DB::table('researchers')
            ->join('agency', 'agency.abbrev', '=', 'researchers.agency')
            ->select('agency.*', 'researchers.*')
            ->where('researchers.id', $id)
            ->first();

        $prog_involvement = DB::table('researchers')
            ->join('programs', 'programs.program_leader', '=', 'researchers.name')
            ->select('programs.*', 'researchers.name')
            ->where('researchers.id', $id)
            ->get();

        $proj_involvement = DB::table('researchers')
            ->join('projects', 'projects.project_leader', '=', 'researchers.name')
            ->select('projects.*', 'researchers.name')
            ->where('researchers.id', $id)
            ->get();

        $sub_proj_involvement = DB::table('researchers')
            ->join('sub_projects', 'sub_projects.sub_project_leader', '=', 'researchers.name')
            ->select('sub_projects.*', 'researchers.name')
            ->where('researchers.id', $id)
            ->get();
        return view('backend.researcher.researcher_view', compact('researcher', 'title', 'prog_involvement', 'proj_involvement', 'sub_proj_involvement'));
    }

    public function UpdateResearcher(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required',
                'gender' => 'required',
                'contact' => 'required',
                'email' => 'required|email',
                'agency' => 'required',
            ],
            [
                'name.required' => 'Name is required!',
                'gender.required' => 'Sex is required!',
                'contact.required' => 'Contact number is required!',
                'email.required' => 'Email is required!',
                'agency.required' => 'Agency is required!',
            ],
        );
        $data = [];
        $data['name'] = $request->name;
        $data['gender'] = $request->gender;
        $data['contact'] = $request->contact;
        $data['email'] = $request->email;
        $data['agency'] = $request->agency;

        $researcher = DB::table('researchers')
            ->where('id', $id)
            ->update($data);
        if ($researcher) {
            $notification = [
                'message' => 'Researcher Successfully Updated!',
                'alert-type' => 'success',
            ];

            return redirect()
                ->route('researcherIndex')
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('researcherIndex')
                ->with($notification);
        }
    }

    public function downloadTemplate()
    {
        $file_path = storage_path('import-templates\researchers-template.xlsx');
        return Response::download($file_path);
    }

    public function DeleteResearcher($id)
    {
        $delete = DB::table('researchers')
            ->where('id', $id)
            ->delete();
        if ($delete) {
            $notification = [
                'message' => 'Researcher Successfully Deleted!',
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
