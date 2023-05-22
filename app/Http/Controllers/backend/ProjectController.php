<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class ProjectController extends Controller
{
    // show all projects
    public function ShowAllProjects()
    {
        $all = DB::table('projects')->get();
        return view('backend.projects.projects', compact('all'));
    }

    public function AllProjects()
    {
        $all = DB::table('institution')
            ->rightjoin('projects', 'institution.idnumber', '=', 'projects.instid')
            ->select('projects.*', 'institution.*')
            ->get();
        return view('backend.projects.projects', compact('all'));
    }

    public function EditProjects($id)
    {
        $edit = DB::table('projects')
            ->where('id', $id)
            ->first();
        return view('backend.projects.edit_projects', compact('edit'));
    }


    public function UpdateProjects(Request $request, $id)
    {

        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();

        $data['projectname'] = $request->projectname;
        $data['status'] = $request->status;

        $update = DB::table('projects')->where('id', $id)->update($data);
        if ($update) {
            if (!$data['status'] == '') {
                $data['statusboolean'] = 1;
                DB::table('projects')->where('id', $id)->update($data);

                $notification = array(
                    'message' => 'Project Successfully Updated!',
                    'alert-type' => 'success'
                );
                return redirect()->route('EditProjects', $id)->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('EditProjects', $id)->with($notification);
        }
    }


    public function ViewProjects($funding_agency)
    {
        $view = DB::table('projects')->where('funding_agency', $funding_agency)->get();

            // ->leftjoin('projects', 'institution.instname', '=', 'projects.funding_agency')
            // ->select('projects.*')
            // ->where('id', $id)
            // ->get();

        // $views = DB::table('institution')
        //     ->where('id', $id)
        //     ->first();

        // $count = DB::table('projects')->where('instid', $instid)->count('status');
        // $count = DB::whereNull('status')->where('instid', $instid)->count();

        return view('backend.projects.view_projects', compact('view'));
    }


    public function AddProjectsIndex()
    {
        // $all = DB::table('institution')->orderBy('instname', 'asc')->get();
        // return view('backend.projects.add_projects', compact('all'));
    }

    public function InsertProjects(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        // $date = date('m-d-Y');
        $data = array();
        $data['created_at'] = now();

        // $data['instid'](is the database column) = $request->instid(this is the element name);
     
        $data['trust_fund_code'] = $request->trust_fund_code;
        $data['funding_agency'] = $request->funding_agency;
   
        $data['project_title'] = $request->project_title;
        $data['description'] = $request->description;
       
        $data['approved_budget'] = $request->approved_budget;
        $data['amount_of_release'] = $request->amount_of_release;
        $data['check_num'] = $request->check_num;
        $data['or_num'] = $request->or_num;
        $data['or_date'] = $request->or_date;
        $data['project_start_date'] = $request->project_start_date;
        $data['project_end_date'] = $request->project_end_date;
        $data['project_extension_date'] = $request->project_extension_date;
        // $data['memo_agreement_copy'] = $request->memo_agreement_copy;
        // $data['line_item_budget_copy'] = $request->line_item_budget_copy;
        // $data['notice_to_proceed_copy'] = $request->notice_to_proceed_copy;
        // $data['no_of_publications'] = $request->no_of_publications;
        // $data['tech_generated'] = $request->tech_generated;
        // $data['tech_adaptor'] = $request->tech_adaptor;
        // $data['patent'] = $request->patent;
        // $data['terminal_report'] = $request->terminal_report;
        // $data['scholarship_grant'] = $request->scholarship_grant;
        // $data['financial_analyst_incharge'] = $request->financial_analyst_incharge;
        // $data['status'] = $request->status;
        $data['edited_at'] = now();


        $insert = DB::table('projects')->insertOrIgnore($data);
        if ($insert) {
            // DB::table('personnel')->insertOrIgnore([
            //     'name' => $request->project_leader,
            //     'contact'=> $request->contact,
            //     'email' => $request->email,
            //     'project_abbrev' => $request->funding_agency
            // ]);
            $funding_agency = $data['funding_agency'];
            $notification = array(
                'message' => 'Project successfully inserted!',
                'alert-type' => 'success'
            );
            return redirect()->route('InsertProjectsPersonnelIndex', $funding_agency)->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('home')->with($notification);
        }
    }


    public function InsertProjectsPersonnelIndex($project_id) {
        $all = DB::table('personnel')->where('project_id', $id);
        return view('backend.projects.add_project_staff', compact('all'));
    }

    public function InsertProjectsPersonnel(Request $request) {
        $data = array();
        $data['name'] = $request->name;
        $data['gender'] = $request->gender;
        $data['contact'] = $request->contact;
        $data['email'] = $request->email;
        $data['project_staffs'] = $request->project_staffs;
        $data['project_id'] = $request->project_id;


        $insert = DB::table('personnel')->insert($data);
        if($insert) {
            $notification = array(
                'message' => 'Personnel successfully added!',
                'alert-type' => 'success'
            );
            return redirect()->route('home')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('home')->with($notification);
        }
    }
}
