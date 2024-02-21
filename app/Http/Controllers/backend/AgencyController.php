<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Response;
use App\Models\Agency;

class AgencyController extends Controller
{
    //

    public function AddAgencyIndex()
    {
        $title = 'Agency | RTMS';
        return view('backend.agency.add_agency', compact('title'));
    }

    public function AllAgency()
    {
        $title = 'Agency | RTMS';
        $all = DB::table('agency')
            ->orderByDesc('id')
            ->get();
        return view('backend.agency.agency', compact('all', 'title'));
    }

    public function AddAgency(Request $request)
    {
        $request->validate(
            [
                'agency_name' => 'required',
                'abbrev' => 'required',
            ],
            [
                'agency_name.required' => 'Agency name is required!',
                'abbrev.required' => 'Agency abbreviation is required!',
            ],
        );

        $existingData = Agency::where('agency_name', $request->agency_name)
            ->orWhere('abbrev', $request->abbrev)
            ->first();

        if ($existingData) {
            // Data already exists, handle accordingly (e.g., show an error message)
            $notification = [
                'message' => 'Agency Already Exists',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('AllAgency')
                ->with($notification);
        }

        $data = [];
        $data['agency_name'] = $request->agency_name;
        $data['abbrev'] = $request->abbrev;

        $insert = DB::table('agency')->insertOrIgnore($data);
        if ($insert) {
            //inserting idnumber to instid(other table)
            // DB::table('projects')->insertOrIgnore([
            //     ['instid' => $data['idnumber']]
            // ]);
            $notification = [
                'message' => 'Agency Successfully Added!',
                'alert-type' => 'success',
            ];
            return redirect()
                ->route('AllAgency')
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('AllAgency')
                ->with($notification);
        }
    }

    public function EditAgency($id)
    {
        $title = 'Agency | RTMS';
        $edit = DB::table('agency')
            ->where('id', $id)
            ->first();
        return view('backend.agency.edit_agency', compact('edit', 'title'));
    }

    public function EditAgencyProcess(Request $request, $id)
    {
        $request->validate(
            [
                'agency_name' => 'required',
                'abbrev' => 'required',
            ],
            [
                'agency_name.required' => 'Agency name is required!',
                'abbrev.required' => 'Agency abbreviation is required!',
            ],
        );

        $data = [];
        $data['agency_name'] = $request->agency_name;
        $data['abbrev'] = $request->abbrev;

        $update = DB::table('agency')
            ->where('id', $id)
            ->update($data);
        if ($update) {
            $notification = [
                'message' => 'Agency Successfully Edited!',
                'alert-type' => 'success',
            ];
            return redirect()
                ->route('AllAgency')
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('AllAgency')
                ->with($notification);
        }
    }

    public function downloadTemplate()
    {
        $file_path = storage_path('import-templates\agency-template.xlsx');
        return Response::download($file_path);
    }
    public function DeleteAgency($id)
    {
        $delete = DB::table('agency')
            ->where('id', $id)
            ->delete();
        if ($delete) {
            $notification = [
                'message' => 'Agency Successfully Deleted!',
                'alert-type' => 'success',
            ];
            return redirect()
                ->route('AllAgency')
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('AllAgency')
                ->with($notification);
        }
    }
}
