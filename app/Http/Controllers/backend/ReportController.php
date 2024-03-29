<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Personnel;
use App\Models\Poster;
use App\Models\Paper;
use App\Models\Evaluators;
use App\Models\Researchers;
use App\Models\RdmcRegional;
use App\Models\PosterEvaluators;
use App\Models\Contributions;
use App\Models\Initiatives;
use Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    // ************************************************************************************************************************************************
    // ************************************************************************************************************************************************
    // **************************************************** CONTROLLER ROUTES *************************************************************************
    // ************************************************************************************************************************************************
    // ************************************************************************************************************************************************

    //R & D Management and Coordination
    public function reportIndex()
    {
        $title = 'Reports | RTMS';
        $agency = DB::table('programs')->rightJoin('agency', 'programs.funding_agency', '=', 'agency.abbrev')->select('agency.agency_name', 'agency.abbrev')->first();
        return view('backend.report.report_index', compact('agency', 'title'));
    }
    public function rdmcIndex()
    {
        $title = 'RDMC';
        return view('backend.report.rdmc.rdmc_index', compact('title'));
    }

    public function monitoringEvaluation()
    {
        $title = 'Monitoring and Evaluation | RDMC';
        return view('backend.report.rdmc.monitoring_index', compact('title'));
    }

    public function rdmcProjects()
    {
        $title = 'Projects | RDMC';
        $projects = DB::table('projects')->orderBy('created_at', 'desc')->get();

        // CMI
        $all_filter = DB::table('projects')
            ->select('*')
            ->where('encoder_agency', '=', auth()->user()->agencyID)
            ->orderBy('created_at', 'desc')
            ->get();

        $researchers_filter = DB::table('researchers')
            ->where('agency', auth()->user()->agencyID)
            ->get();

        $user_agency = DB::table('users')
            ->where('agencyID', auth()->user()->agencyID)
            ->get();

        return view('backend.report.rdmc.rdmc_projects', compact('title', 'projects', 'all_filter', 'researchers_filter', 'user_agency'));
    }

    public function rdmcProgramsIndex()
    {
        $title = 'Programs | RDMC';
        $agency = DB::table('agency')->get();

        $all = DB::table('programs')->orderBy('created_at', 'desc')->get();

        $researchers = DB::table('researchers')->get();

        // CMI (fetch program implementing agency even data in db is in array)
        $all_filter = DB::table('programs')
            ->select('*')
            ->where('encoder_agency', '=', auth()->user()->agencyID)
            ->orderBy('created_at', 'desc')
            ->get();

        $researchers_filter = DB::table('researchers')
            ->where('agency', auth()->user()->programID)
            ->get();

        $user_agency = DB::table('users')
            ->where('agencyID', auth()->user()->agencyID)
            ->first();

        return view('backend.report.rdmc.rdmc_programs', compact('all', 'agency', 'title', 'researchers', 'researchers_filter', 'all_filter', 'user_agency'));
    }

    public function rdmcChooseProgram()
    {
        $title = 'Programs | RDMC';
        $programs = DB::table('programs')->select('*')->orderByDesc('id')->get();

        return view('backend.report.rdmc.rdmc_program_chooser', compact('programs', 'title'));
    }
    public function rdmcCreateProgram()
    {
        $title = 'Programs | RDMC';
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();

        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->first();

        $researchers_filter = DB::table('researchers')
            ->where('agency', auth()->user()->agencyID)
            ->get();

        return view('backend.report.rdmc.rdmc_create_program', compact('title', 'agency', 'researchers', 'user_agency', 'researchers_filter'));
    }
    // ADD PROJECTS WITHOUT PROGRAM
    public function projectsAdd()
    {
        $title = 'Projects | RDMC';
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();

        // CMI

        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->first();

        $researchers_filter = DB::table('researchers')
            ->where('agency', auth()->user()->agencyID)
            ->get();

        return view('backend.report.rdmc.rdmc_projects_add', compact('title', 'agency', 'researchers', 'researchers_filter', 'user_agency'));
    }
    // ADD PROJECTS TO PROGRAM IN CONTINUOUS METHOD
    public function programProjectsAdd()
    {
        $title = 'Program - projects | RDMC';
        $programs = DB::table('programs')->select('*')->orderByDesc('id')->limit(1)->first();

        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();

        // CMI
        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->first();

        $researchers_filter = DB::table('researchers')
            ->where('agency', auth()->user()->agencyID)
            ->get();
        return view('backend.report.rdmc.rdmc_program_projects_add', compact('programs', 'title', 'agency', 'researchers', 'user_agency', 'researchers_filter'));
    }
    // ADD PROJECTS TO PROGRAM IN NOT CONTINUOUS METHOD
    public function projectsUnderProgramAdd($programID)
    {
        $title = 'Program - projects | RDMC';
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();

        $programs = DB::table('programs')->where('programID', $programID)->first();

        // CMI
        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->get();

        $researchers_filter = DB::table('researchers')
            ->where('agency', auth()->user()->agencyID)
            ->get();

        return view('backend.report.rdmc.rdmc_projects_under_program_add', compact('programs', 'title', 'agency', 'researchers', 'user_agency', 'researchers_filter'));
    }

    public function projectsUnderProgramEdit($programID, $id)
    {
        $title = 'Program - projects | RDMC';
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();
        $programs = DB::table('programs')->where('programID', $programID)->first();

        // CMI
        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->first();

        $researchers_filter = DB::table('researchers')
            ->where('agency', auth()->user()->agencyID)
            ->get();

        return view('backend.report.rdmc.rdmc_projects_under_program_edit', compact('programs', 'title', 'agency', 'researchers', 'user_agency', 'researchers_filter'));
    }

    public function projectsUnderProgramIndex($programID)
    {
        $title = 'Program - projects | RDMC';
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();
        $projects = DB::table('projects')->where('programID', $programID)->orderBy('created_at', 'desc')->get();

        $program_title = DB::table('programs')->select('*')->where('programID', $programID)->first();

        $all_filter = DB::table('projects')
            ->select('*')
            ->where('programID', '=', $programID)
            ->where('encoder_agency', '=', auth()->user()->agencyID)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('backend.report.rdmc.rdmc_projects_under_program', compact('projects', 'title', 'agency', 'researchers', 'program_title', 'all_filter'));
    }
    public function subProjectsView($projectID)
    {
        $title = 'Sub-projects | RDMC';
        $sub_projects = DB::table('sub_projects')->select('*')->where('projectID', '=', $projectID)->orderByDesc('id')->get();

        $all_filter = DB::table('sub_projects')
            ->select('*')
            ->where('projectID', $projectID)
            ->where('encoder_agency', '=', auth()->user()->agencyID)
            ->get();

        $project_title = DB::table('projects')->select('*')->where('id', $projectID)->first();
        $agency = DB::table('agency')->get();
        return view('backend.report.rdmc.rdmc_sub_project_view_index', compact('title', 'project_title', 'sub_projects', 'agency', 'all_filter'));
    }
    public function ProjectSubProjectsAdd($id)
    {
        $title = 'Sub-projects | RDMC';
        $projects = DB::table('projects')->select('*')->where('id', $id)->limit(1)->first();

        $researchers = DB::table('researchers')->get();
        $agency = DB::table('agency')->get();

        // CMI
        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->first();

        $researchers_filter = DB::table('researchers')
            ->where('agency', auth()->user()->agencyID)
            ->get();

        return view('backend.report.rdmc.rdmc_sub_project_add', compact('title', 'projects', 'agency', 'researchers', 'user_agency', 'researchers_filter'));
    }

    public function ProjectSubProjectsAdd2()
    {
        $title = 'Sub-projects | RDMC';
        $projects = DB::table('projects')->select('*')->orderByDesc('id')->limit(1)->first();

        $researchers = DB::table('researchers')->get();
        $agency = DB::table('agency')->get();
        return view('backend.report.rdmc.rdmc_sub_project_add', compact('title', 'projects', 'agency', 'researchers'));
    }

    public function rdmcActivities()
    {
        $title = 'Activities | RDMC';
        $all = DB::table('rdmc_activities')->get();
        // CMI FILTER
        $all_filter = DB::table('rdmc_activities')
            ->select('*')
            ->where('encoder_agency', '=', auth()->user()->agencyID)
            ->get();

        return view('backend.report.rdmc.rdmc_activities', compact('title', 'all', 'all_filter'));
    }

    public function rdmcAddActivities()
    {
        $title = 'Activities | RDMC';
        $agency = DB::table('agency')->get();
        return view('backend.report.rdmc.rdmc_activities_add', compact('title', 'agency'));
    }

    public function aihrsIndex()
    {
        $title = 'Agency In-House Reviews (AIHRs) | RDMC';
        // Best Paper
        $best_paper = Paper::orderBy('id', 'desc')->get();
        // $best_paper = DB::table('best_paper')->get();
        // $best_paper_evaluator = DB::table('best_paper_evaluator')->get();
        // Best poster
        $best_poster = Poster::orderBy('id', 'desc')->get();
        // Program
        $new = DB::table('programs')->where('program_status', '=', 'new')->count();
        $ongoing = DB::table('programs')->where('program_status', '=', 'ongoing')->count();
        $terminated = DB::table('programs')->where('program_status', '=', 'terminated')->count();
        $completed = DB::table('programs')->where('program_status', '=', 'completed')->count();

        $prog_research = DB::table('programs')->where('program_category', '=', 'Research')->count();

        $prog_dev = DB::table('programs')->where('program_category', '=', 'Development')->count();

        // Project
        $new_proj = DB::table('projects')->where('project_status', '=', 'new')->count();
        $ongoing_proj = DB::table('projects')->where('project_status', '=', 'ongoing')->count();
        $terminated_proj = DB::table('projects')->where('project_status', '=', 'terminated')->count();
        $completed_proj = DB::table('projects')->where('project_status', '=', 'completed')->count();
        // Sub-Project
        $new_subproj = DB::table('sub_projects')->where('sub_project_status', '=', 'new')->count();
        $ongoing_subproj = DB::table('sub_projects')->where('sub_project_status', '=', 'ongoing')->count();
        $terminated_subproj = DB::table('sub_projects')->where('sub_project_status', '=', 'terminated')->count();
        $completed_subproj = DB::table('sub_projects')->where('sub_project_status', '=', 'completed')->count();

        $proj_research = DB::table('projects')->where('project_category', '=', 'Research')->count();

        $proj_dev = DB::table('projects')->where('project_category', '=', 'Development')->count();

        $sub_proj_research = DB::table('sub_projects')->where('sub_project_category', '=', 'Research')->count();

        $sub_proj_dev = DB::table('sub_projects')->where('sub_project_category', '=', 'Development')->count();

        // CMI
        // Program
        $cmi_new = DB::table('programs')
            ->where('implementing_agency', 'LIKE', '%' . auth()->user()->agencyID . '%')
            ->where('program_status', '=', 'new')
            ->count();

        $cmi_ongoing = DB::table('programs')
            ->where('implementing_agency', 'LIKE', '%' . auth()->user()->agencyID . '%')
            ->where('program_status', '=', 'ongoing')
            ->count();

        $cmi_terminated = DB::table('programs')
            ->where('implementing_agency', 'LIKE', '%' . auth()->user()->agencyID . '%')
            ->where('program_status', '=', 'terminated')
            ->count();

        $cmi_completed = DB::table('programs')
            ->where('implementing_agency', 'LIKE', '%' . auth()->user()->agencyID . '%')
            ->where('program_status', '=', 'completed')
            ->count();

        // Project
        $cmi_new_proj = DB::table('projects')
            ->where('project_implementing_agency', 'LIKE', '%' . auth()->user()->agencyID . '%')
            ->where('project_status', '=', 'new')
            ->count();

        $cmi_ongoing_proj = DB::table('projects')
            ->where('project_implementing_agency', 'LIKE', '%' . auth()->user()->agencyID . '%')
            ->where('project_status', '=', 'ongoing')
            ->count();

        $cmi_terminated_proj = DB::table('projects')
            ->where('project_implementing_agency', 'LIKE', '%' . auth()->user()->agencyID . '%')
            ->where('project_status', '=', 'terminated')
            ->count();

        $cmi_completed_proj = DB::table('projects')
            ->where('project_implementing_agency', 'LIKE', '%' . auth()->user()->agencyID . '%')
            ->where('project_status', '=', 'completed')
            ->count();

        // Sub-Project
        $cmi_new_subproj = DB::table('sub_projects')
            ->where('sub_project_implementing_agency', auth()->user()->agencyID)
            ->where('sub_project_status', '=', 'new')
            ->count();

        $cmi_ongoing_subproj = DB::table('sub_projects')
            ->where('sub_project_implementing_agency', auth()->user()->agencyID)
            ->where('sub_project_status', '=', 'ongoing')
            ->count();

        $cmi_terminated_subproj = DB::table('sub_projects')
            ->where('sub_project_implementing_agency', auth()->user()->agencyID)
            ->where('sub_project_status', '=', 'terminated')
            ->count();

        $cmi_completed_subproj = DB::table('sub_projects')
            ->where('sub_project_implementing_agency', auth()->user()->agencyID)
            ->where('sub_project_status', '=', 'completed')
            ->count();

        return view('backend.report.rdmc.aihrs_index', compact('title', 'best_paper', 'completed', 'new', 'ongoing', 'terminated', 'completed_proj', 'new_proj', 'ongoing_proj', 'terminated_proj', 'completed_subproj', 'new_subproj', 'ongoing_subproj', 'terminated_subproj', 'cmi_completed', 'cmi_new', 'cmi_ongoing', 'cmi_terminated', 'cmi_completed_proj', 'cmi_new_proj', 'cmi_ongoing_proj', 'cmi_terminated_proj', 'cmi_completed_subproj', 'cmi_new_subproj', 'cmi_ongoing_subproj', 'cmi_terminated_subproj', 'best_poster', 'prog_dev', 'prog_research', 'proj_research', 'proj_dev', 'sub_proj_research', 'sub_proj_dev'));
    }

    public function best_paper_add(Request $request)
    {
        $data = [];
        $request->validate(
            [
                'best_paper' => 'required',
                'best_paper_year' => 'required',
                'best_paper_fa' => 'required',
                'moreFields.*.evaluator_name' => 'required',
            ],
            [
                'best_paper.required' => 'Title is required!',
                'best_paper_year.required' => 'Year is required!',
                'best_paper_fa.required' => 'Funding Agency is required!',
                'moreFields.*.evaluator_name.required' => 'Evaluators is required!',
            ],
        );

        $data['best_paper'] = $request->best_paper;
        $data['best_paper_fa'] = $request->best_paper_fa;
        $data['best_paper_year'] = $request->best_paper_year;
        $data['created_at'] = now();

        $insert = DB::table('best_paper')->insertGetId($data);

        foreach ($request->moreFields as $key => $value) {
            if (!empty($value)) {
                // dd($value['evaluator_name']);
                Evaluators::create([
                    'best_paper_id' => $insert,
                    'evaluator_name' => $value['evaluator_name'],
                    // Add other columns as needed
                ]);
            }
        }

        if ($insert) {
            $notification = [
                'message' => 'Paper Successfully Added!',
                'alert-type' => 'success',
            ];

            return redirect()->route('aihrsIndex')->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()->route('aihrsIndex')->with($notification);
        }
    }

    public function best_paper_update(Request $request, $id)
    {
        $data = [
            'best_paper' => $request->best_paper,
            'best_paper_fa' => $request->best_paper_fa,
            'best_paper_year' => $request->best_paper_year,
            'updated_at' => now(),
        ];

        $paper = Paper::findOrFail($id);
        $paper->update($data);

        // Delete existing evaluators
        $paper->evaluators()->delete();

        // Insert new evaluators
        foreach ($request->moreFields as $key => $values) {
            Evaluators::create([
                'best_paper_id' => $id,
                'evaluator_name' => $values['evaluator_name'],
            ]);
        }

        $notification = [
            'message' => 'Paper Successfully Updated!',
            'alert-type' => 'success',
        ];

        return redirect()->route('aihrsIndex')->with($notification);
    }

    public function best_paper_delete($id)
    {
        $id = Crypt::decryptString($id);
        $delete = DB::table('best_paper')->where('id', $id)->delete();
        if ($delete) {
            $notification = [
                'message' => 'Paper Successfully Deleted!',
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

    public function best_poster_add(Request $request)
    {
        // Auto-rename the uploaded profile picture
        $posterPicture = $request->file('poster');
        $extension = $posterPicture->getClientOriginalExtension();
        $newFileName = Str::uuid() . '_' . time() . '_' . "poster.{$extension}";
        $posterPath = $posterPicture->storeAs('posters', $newFileName, 'poster');

        $data = [];
        $data['file_name'] = $newFileName;
        $data['file_path'] = $posterPath;
        $data['date'] = $request->date;
        $data['agency'] = $request->agency;

        $insert = DB::table('best_poster')->insertGetId($data);

        foreach ($request->moreFields as $key => $value) {
            // dd($value['evaluator_name']);
            PosterEvaluators::create([
                'best_poster_id' => $insert,
                'evaluator_name' => $value['evaluator_name'],
                // Add other columns as needed
            ]);
        }

        if ($insert) {
            $notification = [
                'message' => 'Poster Successfully Added!',
                'alert-type' => 'success',
            ];

            return redirect()->route('aihrsIndex')->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()->route('aihrsIndex')->with($notification);
        }
    }

    public function best_poster_update(Request $request, $id)
    {
        $poster = Poster::find($id);

        if ($request->hasFile('poster')) {
            // Remove old profile picture
            if ($poster->file_path) {
                Storage::disk('poster')->delete($poster->file_path);
            }
            // Auto-rename the uploaded profile picture
            $posterPicture = $request->file('poster');
            $extension = $posterPicture->getClientOriginalExtension();
            $newFileName = Str::uuid() . '_' . time() . '_' . "poster.{$extension}";
            $posterPath = $posterPicture->storeAs('posters', $newFileName, 'poster');
            $poster->file_path = $profilePicturePath;
        }

        $data = [
            'date' => $request->date,
            'agency' => $request->agency,
        ];

        $poster->save();

        $poster->update($data);

        $poster = Poster::findOrFail($id);

        $poster->poster_evaluators()->delete();

        // $insert = DB::table('best_poster')->update($data);

        foreach ($request->moreFields as $key => $value) {
            // dd($value['evaluator_name']);
            PosterEvaluators::create([
                'best_poster_id' => $id,
                'evaluator_name' => $value['evaluator_name'],
                // Add other columns as needed
            ]);
        }

        $notification = [
            'message' => 'Poster Successfully Updated!',
            'alert-type' => 'success',
        ];

        return redirect()->route('aihrsIndex')->with($notification);
    }

    public function best_poster_delete($id)
    {
        $id = Crypt::decryptString($id);
        // Find the record in the database
        $poster = Poster::find($id);

        // Delete the file from storage
        Storage::disk('poster')->delete($poster->file_path);

        // Delete the record from the database
        $delete = $poster->delete();

        if ($delete) {
            $notification = [
                'message' => 'Poster Successfully Deleted!',
                'alert-type' => 'success',
            ];

            return redirect()->route('aihrsIndex')->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()->route('aihrsIndex')->with($notification);
        }

        // Redirect or return a response
        return redirect()->route('aihrsIndex')->with($notification);
    }
    public function linkagesIndex()
    {
        $title = 'Linkages | RDMC';
        $all = DB::table('rdmc_linkages')->get();

        // CMI
        $all_filter = DB::table('rdmc_linkages')
            ->select('*')
            ->where('encoder_agency', '=', auth()->user()->agencyID)
            ->get();

        return view('backend.report.rdmc.rdmc_linkages_index', compact('title', 'all', 'all_filter'));
    }
    public function linkagesAddIndex()
    {
        $title = 'Linkages | RDMC';
        return view('backend.report.rdmc.rdmc_linkages_add', compact('title'));
    }
    public function dbInfoSys()
    {
        $title = 'DBIS | RDMC';
        $all = DB::table('rdmc_dbinfosys')->get();

        // CMI filter
        $all_filter = DB::table('rdmc_dbinfosys')
            ->select('*')
            ->where('encoder_agency', '=', auth()->user()->agencyID)
            ->get();

        return view('backend.report.rdmc.rdmc_dbinfosys_index', compact('title', 'all', 'all_filter'));
    }
    public function dbInfoSysAdd()
    {
        $title = 'DBIS | RDMC';
        return view('backend.report.rdmc.rdmc_dbinfosys_add', compact('title'));
    }

    public function regional_index()
    {
        $title = 'Regional Symposium on R&D Highlights';
        $all = DB::table('rdmc_regional')->get();

        $researcherIds = DB::table('rdmc_regional')->select('regional_researchers')->get();

        $researchers = Researchers::whereHas('regional', function ($query) use ($researcherIds) {
            $query->whereJsonContains('regional_researchers', $researcherIds);
        })->get();

        return view('backend.report.rdmc.rdmc_regional', compact('title', 'all', 'researchers'));
    }

    public function regional_add_index()
    {
        $title = 'Regional Symposium on R&D Highlights';
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();
        return view('backend.report.rdmc.rdmc_regional_add', compact('title', 'agency', 'researchers'));
    }

    public function regional_participants_index()
    {
        $title = 'Participants of Regional Symposium on R&D Highlights';
        $all = DB::table('rdmc_regional_participants')->get();
        return view('backend.report.rdmc.rdmc_regional_participants', compact('title', 'all'));
    }

    public function regional_participants_add_index()
    {
        $title = 'Participants of Regional Symposium on R&D Highlights';
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();
        return view('backend.report.rdmc.rdmc_regional_participants_add', compact('title', 'agency', 'researchers'));
    }

    public function strategicIndex()
    {
        $title = 'Strategic R&D Activities';
        // $all = DB::table('strategic_activities')->get();
        return view('backend.report.strategic.strategic_index', compact('title'));
    }

    public function strategic_tech_list()
    {
        $title = 'Strategic R&D Activities';
        $all = DB::table('strategic_tech_list')->get();
        // CMI
        $all_filter = DB::table('strategic_tech_list')
            ->where('encoder_agency', '=', auth()->user()->agencyID)
            ->get();

        return view('backend.report.strategic.tech_list', compact('title', 'all', 'all_filter'));
    }

    public function add_strategic_tech_list_index()
    {
        $title = 'Strategic R&D Activities';
        $all = DB::table('strategic_tech_list')->get();
        $agency = DB::table('agency')->get();
        $programs = DB::table('programs')->get();
        $projects = DB::table('projects')->get();
        $sub_projects = DB::table('sub_projects')->get();
        $researchers = DB::table('researchers')->get();

        return view('backend.report.strategic.tech_list_add', compact('title', 'all', 'agency', 'programs', 'projects', 'sub_projects', 'researchers'));
    }

    public function strategic_program_list()
    {
        $title = 'Strategic R&D Activities';
        $all = DB::table('strategic_program_list')->get();

        // CMI filter
        $all_filter = DB::table('strategic_program_list')
            ->where('encoder_agency', '=', auth()->user()->agencyID)
            ->get();

        return view('backend.report.strategic.strategic_programs', compact('title', 'all', 'all_filter'));
    }

    public function add_strategic_program_list_index()
    {
        $title = 'Strategic R&D Activities';
        $all = DB::table('strategic_tech_list')->get();
        $agency = DB::table('agency')->get();
        $programs = DB::table('programs')->get();
        $projects = DB::table('projects')->get();
        $sub_projects = DB::table('sub_projects')->get();
        return view('backend.report.strategic.strategic_program_add', compact('title', 'all', 'agency', 'programs', 'projects', 'sub_projects'));
    }

    public function strategic_collaborative_list()
    {
        $title = 'Strategic R&D Activities';
        $all = DB::table('strategic_collaborative_list')->get();

        $all_filter = DB::table('strategic_collaborative_list')
            ->where('encoder_agency', '=', auth()->user()->agencyID)
            ->get();

        return view('backend.report.strategic.strategic_collaborative', compact('title', 'all', 'all_filter'));
    }

    public function add_strategic_collaborative_list_index()
    {
        $title = 'Strategic R&D Activities';
        $agency = DB::table('agency')->get();
        $programs = DB::table('programs')->get();
        $projects = DB::table('projects')->get();
        $sub_projects = DB::table('sub_projects')->get();

        return view('backend.report.strategic.strategic_collaborative_add', compact('title', 'agency', 'programs', 'projects', 'sub_projects'));
    }

    public function strategicActivities()
    {
        $title = 'Strategic R&D Activities';
        $all = DB::table('strategic_activities')->get();
        return view('backend.report.strategic.strategic_activities', compact('title', 'all'));
    }

    public function addStrategicActivities()
    {
        $title = 'Strategic R&D Activities';
        $researchers = DB::table('researchers')->get();
        $agency = DB::table('agency')->get();
        $programs = DB::table('programs')->get();
        $projects = DB::table('projects')->get();
        $sub_projects = DB::table('sub_projects')->get();

        return view('backend.report.strategic.add_strategic_activities', compact('title', 'researchers', 'agency', 'programs', 'projects', 'sub_projects'));
    }

    public function rdruIndex()
    {
        $title = 'R&D Results Utilizations';
        return view('backend.report.rdru.rdru_index', compact('title'));
    }

    public function rdruTtp()
    {
        $title = 'TTP | R&D Results Utilizations';
        $all = DB::table('results_ttp')->get();
        $agency = DB::table('agency')->get();

        $all_filter = DB::table('results_ttp')
            ->where('encoder_agency', '=', auth()->user()->agencyID)
            ->get();

        return view('backend.report.rdru.rdru_ttp', compact('title', 'all', 'agency', 'all_filter'));
    }

    public function rdruAdd()
    {
        $title = 'TTP | R&D Results Utilizations';
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();

        return view('backend.report.rdru.rdru_ttp_add', compact('title', 'agency', 'researchers'));
    }
    // RDRU TECH INITIATIVES
    public function rdruTtm()
    {
        $title = 'TTM | R&D Results Utilizations';
        $all = DB::table('results_ttm')->get();
        $agency = DB::table('agency')->get();

        $all_filter = DB::table('results_ttm')
            ->where('encoder_agency', '=', auth()->user()->agencyID)
            ->get();

        return view('backend.report.rdru.rdru_ttm', compact('title', 'all', 'agency', 'all_filter'));
    }

    public function rdruTtmIndex()
    {
        $title = 'TTM | R&D Results Utilizations';
        return view('backend.report.rdru.rdru_ttm_index', compact('title'));
    }
    public function rdruTtmAdd()
    {
        $title = 'TTM | R&D Results Utilizations';
        $agency = DB::table('agency')->get();
        return view('backend.report.rdru.rdru_ttm_add', compact('title', 'agency'));
    }
    public function rdruTpa()
    {
        $title = 'TPA | R&D Results Utilizations';
        $all = DB::table('results_tpa')->get();

        $all_filter = DB::table('results_tpa')
            ->where('encoder_agency', '=', auth()->user()->agencyID)
            ->get();

        return view('backend.report.rdru.rdru_tpa', compact('title', 'all', 'all_filter'));
    }
    public function rdruTpaAdd()
    {
        $title = 'TPA | R&D Results Utilizations';
        // $iec = DB::table('iec_approaches')->get();
        $agency = DB::table('agency')->get();
        return view('backend.report.rdru.rdru_tpa_add', compact('title', 'agency'));
    }

    public function rdru_tech_deployed()
    {
        $title = 'TPA | R&D Results Utilizations';
        // $iec = DB::table('iec_approaches')->get();
        $agency = DB::table('agency')->get();
        $all = DB::table('rdru_tech_deployed')->get();

        // CMI Filter
        $all_filter = DB::table('rdru_tech_deployed')
            ->where('encoder_agency', '=', auth()->user()->agencyID)
            ->get();

        return view('backend.report.rdru.rdru_tech_deployed', compact('title', 'agency', 'all', 'all_filter'));
    }

    public function rdru_add_tech_deployed_index()
    {
        $title = 'TPA | R&D Results Utilizations';
        // $iec = DB::table('iec_approaches')->get();
        $agency = DB::table('agency')->get();
        $all = DB::table('rdru_tech_deployed')->get();
        return view('backend.report.rdru.rdru_tech_deployed_add', compact('title', 'agency', 'all'));
    }

    public function policyIndex()
    {
        $title = 'Policy';
        return view('backend.report.policy.policy_index', compact('title'));
    }

    public function policyPrc()
    {
        $title = 'Policy';
        $all = DB::table('policy_prc')->get();

        $all_filter = DB::table('policy_prc')
            ->where('encoder_agency', '=', auth()->user()->agencyID)
            ->get();

        $agency = DB::table('agency')->get();

        // CMI

        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->get();
        return view('backend.report.policy.policy_prc_index', compact('title', 'all', 'agency', 'user_agency', 'all_filter'));
    }

    public function policyFormulated()
    {
        $title = 'Policy';
        $all = DB::table('policy_formulated')->get();
        $agency = DB::table('agency')->get();

        $all_filter = DB::table('policy_formulated')
            ->where('encoder_agency', '=', auth()->user()->agencyID)
            ->get();

        // CMI

        $user_agency = DB::table('users')
            ->join('agency', 'agency.abbrev', '=', 'users.agencyID')
            ->where('agencyID', auth()->user()->agencyID)
            ->get();

        return view('backend.report.policy.policy_formulated_index', compact('title', 'all', 'agency', 'user_agency', 'all_filter'));
    }

    public function cbgIndex()
    {
        $title = 'CBG';
        return view('backend.report.cbg.cbg_index', compact('title'));
    }

    public function cbgTraining()
    {
        $title = 'Trainings | CBG';
        $all = DB::table('cbg_trainings')->get();

        $all_filter = DB::table('cbg_trainings')
            ->where('encoder_agency', '=', auth()->user()->agencyID)
            ->get();

        return view('backend.report.cbg.cbg_training', compact('title', 'all', 'all_filter'));
    }
    public function cbgContributions()
    {
        $title = 'Contributions | CBG';
        $contributions = Contributions::all();
        // $all = DB::table('cbg_contributions')->get();
        return view('backend.report.cbg.cbg_contributions', compact('title', 'contributions'));
    }

    public function cbgInitiatives()
    {
        $title = 'Initiatives| CBG';
        $initiatives = Initiatives::all();
        $agency = DB::table('agency')->get();
        // $all = DB::table('cbg_contributions')->get();
        $initiatives_filter = DB::table('cbg_initiatives')
            ->where('encoder_agency', '=', auth()->user()->agencyID)
            ->get();

        return view('backend.report.cbg.cbg_initiatives', compact('title', 'initiatives', 'agency', 'initiatives_filter'));
    }

    public function cbgMeetings()
    {
        $title = 'Meetings | CBG';
        $all = DB::table('cbg_meetings')->get();
        return view('backend.report.cbg.cbg_meetings', compact('title', 'all'));
    }

    public function cbgMeetingsAdd()
    {
        $title = 'Meetings | CBG';
        $agency = DB::table('agency')->get();
        return view('backend.report.cbg.cbg_meetings_add', compact('title', 'agency'));
    }

    public function cbgAwards()
    {
        $title = 'Awards | CBG';
        $award = DB::table('cbg_awards')->get();

        $award_filter = DB::table('cbg_awards')
            ->where('encoder_agency', '=', auth()->user()->agencyID)
            ->get();

        return view('backend.report.cbg.cbg_awards', compact('title', 'award', 'award_filter'));
    }

    public function cbgEquipment()
    {
        $title = 'Equipments | CBG';
        $equipment = DB::table('cbg_equipments')->get();
        $all_filter = DB::table('cbg_equipments')
            ->where('encoder_agency', '=', auth()->user()->agencyID)
            ->get();

        return view('backend.report.cbg.cbg_equipment', compact('title', 'equipment', 'all_filter'));
    }

    public function cbgTrainingAdd()
    {
        $title = 'Trainings | CBG';
        $agency = DB::table('agency')->get();
        return view('backend.report.cbg.cbg_training_add', compact('title', 'agency'));
    }

    public function cbgAwardsAdd()
    {
        $title = 'Awards | CBG';
        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();
        $programs = DB::table('programs')->get();
        return view('backend.report.cbg.cbg_awards_add', compact('title', 'agency', 'researchers', 'programs'));
    }

    public function cbgEquipmentAdd()
    {
        $title = 'Equipments | CBG';
        $agency = DB::table('agency')->get();

        $user_agency = DB::table('users')
            ->where('agencyID', auth()->user()->agencyID)
            ->first();
        return view('backend.report.cbg.cbg_equipment_add', compact('title', 'agency', 'user_agency'));
    }

    // ************************************************************************************************************************************************
    // ************************************************************************************************************************************************
    // **************************************************** FUNCTIONALITIES ***************************************************************************
    // ************************************************************************************************************************************************
    // ************************************************************************************************************************************************

    public function AddProgramPersonnel(Request $request)
    {
        $request->validate([
            'moreFields.*.programID' => 'required',
        ]);

        foreach ($request->moreFields as $key => $value) {
            Personnel::create($value);
            $notification = [
                'message' => 'Personnel(s) Successfully Added!',
                'alert-type' => 'success',
            ];
        }
        return back()->with($notification);
    }
}
