<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Researchers;
use DB;
use Response;
use Storage;

class ResearcherController extends Controller
{
    public function researcherIndex()
    {
        $title = 'Researchers | RTMS';
        $all = DB::table('researchers')
            ->orderBy('last_name', 'asc')
            ->get();

        // CMI
        $all_filter = DB::table('researchers')
            ->select('*')
            ->where('agency', auth()->user()->agencyID)
            ->orderBy('last_name', 'asc')
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
                'fname' => 'required',
                // 'mname' => 'required',
                'lname' => 'required',
                'sex' => 'required',
                'emp_status' => 'required',
                'contact' => 'required',
                'email' => 'required|email',
                'agency' => 'required',
            ],
            [
                'fname.required' => 'First name is required!',
                // 'mname.required' => 'Middle name is required!',
                'lname.required' => 'Last name is required!',
                'sex.required' => 'Sex is required!',
                'emp_status.required' => 'Employment status is required!',
                'contact.required' => 'Contact number is required!',
                'email.required' => 'Email is required!',
                'agency.required' => 'Agency is required!',
            ],
        );

        $data = [];
        $data['first_name'] = $request->fname;
        $data['middle_name'] = $request->mname;
        $data['last_name'] = $request->lname;
        $data['sex'] = $request->sex;
        $data['profile_picture'] = 'profile_pictures/default-profile-picture.png';
        $data['emp_status'] = $request->emp_status;
        $data['contact'] = $request->contact;
        $data['email'] = $request->email;
        $data['agency'] = $request->agency;
        $data['created_at'] = now();

        $researcher = DB::table('researchers')->insert($data);
        if ($researcher) {
            return response()->json(['success' => 'Researcher Added Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
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
            ->select('agency.*', 'researchers.*', DB::raw('CONCAT(researchers.first_name, " ", researchers.middle_name, " ", researchers.last_name) AS name'))
            ->where('researchers.id', $id)
            ->first();

        $awards = DB::table('cbg_awards')
            ->where('awards_recipients', 'LIKE', '%' . $researcher->first_name . ' ' . $researcher->middle_name . ' ' . $researcher->last_name . '%')
            ->orWhere('awards_recipients', 'LIKE', '%' . $researcher->first_name . ' ' . $researcher->last_name . '%')
            ->get();

        $prog_involvement = DB::table('programs')
            // ->join('programs', 'programs.program_leader', '=', $researcher->name)
            // ->select('programs.*', 'researchers.*')
            // ->where('researchers.id', $id)
            ->where('programs.program_leader', 'LIKE', '%' . $researcher->id . '%')
            ->get();

        $proj_involvement = DB::table('projects')
            // ->join('projects', 'projects.project_leader', '=', $researcher->name)
            // ->select('projects.*', 'researchers.*')
            // ->where('researchers.id', $id)
            ->where('projects.project_leader', 'LIKE', '%' . $researcher->id . '%')
            ->get();

        $sub_proj_involvement = DB::table('sub_projects')
            // ->join('sub_projects', 'sub_projects.sub_project_leader', '=', $researcher->name)
            // ->select('sub_projects.*', 'researchers.*')
            // ->where('researchers.id', $id)
            // ->get();
            ->where('sub_projects.sub_project_leader', 'LIKE', '%' . $researcher->id . '%')
            ->get();

        return view('backend.researcher.researcher_view', compact('researcher', 'title', 'prog_involvement', 'proj_involvement', 'sub_proj_involvement', 'awards'));
    }

    public function UpdateResearcher(Request $request, $id)
    {
        $request->validate(
            [
                'fname' => 'required',
                // 'mname' => 'required',
                'lname' => 'required',
                'sex' => 'required',
                'emp_status' => 'required',
                'contact' => 'required',
                'email' => 'required|email',
                'agency' => 'required',
            ],
            [
                'fname.required' => 'First name is required!',
                // 'mname.required' => 'Middle name is required!',
                'lname.required' => 'Last name is required!',
                'sex.required' => 'Sex is required!',
                'emp_status.required' => 'Employment status is required!',
                'contact.required' => 'Contact number is required!',
                'email.required' => 'Email is required!',
                'agency.required' => 'Agency is required!',
            ],
        );

        $rs = Researchers::find($id);
        if ($request->hasFile('profile_picture')) {
            // Remove old profile picture
            if ($rs->profile_picture) {
                Storage::disk('public')->delete($rs->profile_picture);
            }

            // Save the new profile picture
            $profilePicture = $request->file('profile_picture');
            $extension = $profilePicture->getClientOriginalExtension();
            $newFileName = "{$rs->last_name}_profile_picture.{$extension}";
            $profilePicturePath = $profilePicture->storeAs('profile_pictures', $newFileName, 'profile');
            $rs->profile_picture = $profilePicturePath;
        }

        $data = [];
        $data['first_name'] = $request->fname;
        $data['middle_name'] = $request->mname;
        $data['last_name'] = $request->lname;
        $data['sex'] = $request->sex;
        $data['emp_status'] = $request->emp_status;
        // $data['profile_picture'] = $profilePicturePath;
        $data['contact'] = $request->contact;
        $data['email'] = $request->email;
        $data['agency'] = $request->agency;

        $researcher = DB::table('researchers')
            ->where('id', $id)
            ->update($data);

        $rs->save();

        if ($researcher) {
            return response()->json(['success' => 'Researcher Updated Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
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
