<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class AwardsController extends Controller
{
    public function AddAward(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $request->validate(
            [
                'awards_type' => 'required',
                'awards_agency' => 'required',
                'awards_title' => 'required',
                'awards_title' => 'required',
                'awards_date' => 'required',
                'awards_sponsor' => 'required',
                'awards_event' => 'required',
                'awards_place' => 'required',
                'awards_recipients' => 'required',
            ],
            [
                'awards_type.required' => 'Awards type field is required!',
                'awards_agency.required' => 'Awards agency field is required!',
                'awards_title.required' => 'Awards title field is required!',
                'awards_date.required' => 'Awards date field is required!',
                'awards_sponsor.required' => 'Awards sponsor field is required!',
                'awards_event.required' => 'Awards event field is required!',
                'awards_place.required' => 'Awards place field is required!',
                'awards_recipients.required' => 'Awards recipients field is required!',
            ],
        );

        $data = [];
        $data['awards_type'] = $request->awards_type;
        $data['awards_agency'] = $request->awards_agency;
        $data['awards_title'] = $request->awards_title;
        $data['awards_date'] = $request->awards_date;
        $data['awards_sponsor'] = $request->awards_sponsor;
        $data['awards_event'] = $request->awards_event;
        $data['awards_place'] = $request->awards_place;
        $data['awards_recipients'] = htmlspecialchars_decode(json_encode($request->awards_recipients));
        $data['created_at'] = now();

        $insert = DB::table('cbg_awards')->insert($data);

        if ($insert) {
            return response()->json(['success' => 'Award Added Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
        // if ($insert) {

        //     $notification = array(
        //         'message' => 'Award Successfully Added!',
        //         'alert-type' => 'success'
        //     );

        //     return redirect()->route('cbgAwards')->with($notification);
        // } else {
        //     $notification = array(
        //         'message' => 'Something is wrong, please try again!',
        //         'alert-type' => 'error'
        //     );
        //     return redirect()->route('cbgAwards')->with($notification);
        // }
    }

    public function editAward($id)
    {
        $title = 'Awards | CBG';
        $all = DB::table('cbg_awards')
            ->where('id', $id)
            ->first();
        // $rec =  DB::table('cbg_awards')->select('awards_recipients')->where('id', $id)->first();

        $agency = DB::table('agency')->get();
        $researchers = DB::table('researchers')->get();
        return view('backend.report.cbg.cbg_awards_edit', compact('title', 'all', 'agency', 'researchers'));
    }

    public function UpdateAward(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');
        $request->validate(
            [
                'awards_type' => 'required',
                'awards_agency' => 'required',
                'awards_title' => 'required',
                'awards_title' => 'required',
                'awards_date' => 'required',
                'awards_sponsor' => 'required',
                'awards_event' => 'required',
                'awards_place' => 'required',
                'awards_recipients' => 'required',
            ],
            [
                'awards_type.required' => 'Awards type field is required!',
                'awards_agency.required' => 'Awards agency field is required!',
                'awards_title.required' => 'Awards title field is required!',
                'awards_date.required' => 'Awards date field is required!',
                'awards_sponsor.required' => 'Awards sponsor field is required!',
                'awards_event.required' => 'Awards event field is required!',
                'awards_place.required' => 'Awards place field is required!',
                'awards_recipients.required' => 'Awards recipients field is required!',
            ],
        );
        $data = [];
        $data['awards_type'] = $request->awards_type;
        $data['awards_agency'] = $request->awards_agency;
        $data['awards_title'] = $request->awards_title;
        $data['awards_date'] = $request->awards_date;
        $data['awards_sponsor'] = $request->awards_sponsor;
        $data['awards_event'] = $request->awards_event;
        $data['awards_place'] = $request->awards_place;
        $data['awards_recipients'] = json_encode($request->awards_recipients);
        $data['updated_at'] = now();

        $update = DB::table('cbg_awards')
            ->where('id', $id)
            ->update($data);
        if ($update) {
            return response()->json(['success' => 'Award Updated Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function DeleteAward($id)
    {
        $delete = DB::table('cbg_awards')
            ->where('id', $id)
            ->delete();
        if ($delete) {
            $notification = [
                'message' => 'Award Successfully Deleted!',
                'alert-type' => 'success',
            ];

            return redirect()
                ->route('cbgAwards')
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('cbgAwards')
                ->with($notification);
        }
    }
}
