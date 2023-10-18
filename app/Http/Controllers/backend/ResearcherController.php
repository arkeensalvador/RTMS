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
        $title = "Researchers | RTMS";
        $all = DB::table('researchers')->get();
        return view('backend.researcher.researcher_index', compact('all', 'title'));
    }
    public function researcherAdd()
    {
        $title = "Researchers | RTMS";
        $agency = DB::table('agency')->get();
        return view('backend.researcher.researcher_add', compact('agency', 'title'));
    }

    public function AddResearcher(Request $request)
    {
        $file = $request->file('image');
        $name = $request->name . '_IMAGE' . '.' . $file->getClientOriginalExtension();

        $data =  array();
        $data['name'] = $request->name;
        $data['gender'] = $request->gender;
        $data['contact'] = $request->contact;
        $data['email'] = $request->email;
        $data['agency'] = $request->agency;

        if (request()->hasFile('image')) {
            $path =  $file->storeAs('profile-pic', $name);
            $data['image'] = $path;
            $researcher = DB::table('researchers')->insert($data);
            if ($researcher) {

                $notification = array(
                    'message' => 'Researcher Successfully Added!',
                    'alert-type' => 'success'
                );

                return redirect()->route('researcherIndex')->with($notification);
            } else {
                $notification = array(
                    'message' => 'Something is wrong, please try again!',
                    'alert-type' => 'error'
                );
                return redirect()->route('researcherIndex')->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'Image is required!',
                'alert-type' => 'error'
            );
            return redirect()->route('researcherIndex')->with($notification);
        }
    }

    public function EditResearcher($id)
    {
        $title = "Researchers | RTMS";
        $researcher = DB::table('researchers')->where('id', $id)->first();
        $agency = DB::table('agency')->get();
        return view('backend.researcher.researcher_edit', compact('agency', 'researcher', 'title'));
    }

    public function ViewResearcher($id)
    {
        $title = "Researchers | RTMS";
        $researcher = DB::table('researchers')
            ->join('agency', 'agency.abbrev', '=', 'researchers.agency')
            ->select('agency.*', 'researchers.*')
            ->where('researchers.id', $id)->first();
        return view('backend.researcher.researcher_view', compact('researcher', 'title'));
    }

    public function UpdateResearcher(Request $request, $id)
    {
        $data =  array();
        $data['name'] = $request->name;
        $data['gender'] = $request->gender;
        $data['contact'] = $request->contact;
        $data['email'] = $request->email;
        $data['agency'] = $request->agency;

        $researcher = DB::table('researchers')->where('id', $id)->update($data);
        if ($researcher) {

            $notification = array(
                'message' => 'Researcher Successfully Updated!',
                'alert-type' => 'success'
            );

            return redirect()->route('researcherIndex')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('researcherIndex')->with($notification);
        }
    }

    public function downloadTemplate()
    {
        $file_path = storage_path('import-templates\researchers-template.xlsx');
        return Response::download($file_path);
    }

    public function DeleteResearcher($id)
    {
        $delete = DB::table('researchers')->where('id', $id)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'Researcher Successfully Deleted!',
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
