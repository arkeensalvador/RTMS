<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class ResearcherController extends Controller
{
    public function researcherIndex()
    {
        $all = DB::table('researchers')->get();
        return view('backend.researcher.researcher_index', compact('all'));
    }
    public function researcherAdd()
    {
        $agency = DB::table('agency')->get();
        return view('backend.researcher.researcher_add',compact('agency'));
    }

    public function AddResearcher(Request $request)
    {
        $data =  array();
        $data['name'] = $request->name;
        $data['gender'] = $request->gender;
        $data['contact'] = $request->contact;
        $data['email'] = $request->email;
        $data['agency'] = $request->agency;

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
