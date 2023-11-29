<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Initiatives;
use Illuminate\Http\Request;
use DB;

class InitiativesController extends Controller
{
    public function ini_add(Request $request)
    {
        $request->validate(
            [
                'ini_initiates' => 'required',
                // 'ini_agency' => 'required',
                'ini_date' => 'required',
            ],
            [
                'ini_initiates.required' => 'Initiatives field is required!',
                // 'ini_agency.required' => 'Agency field is required!',
                'ini_date.required' => 'Date field is required!',
            ],
        );
        $data = [];
        $data['ini_initiates'] = $request->ini_initiates;
        $data['ini_agency'] = $request->ini_agency;
        $data['ini_date'] = $request->ini_date;

        $insert = DB::table('cbg_initiatives')->insert($data);

        if ($insert) {
            $notification = [
                'message' => 'Initiative Successfully Added!',
                'alert-type' => 'success',
            ];

            return redirect()
                ->route('cbgInitiatives')
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('cbgInitiatives')
                ->with($notification);
        }
    }

    public function ini_update(Request $request, $id)
    {
        $request->validate(
            [
                'ini_initiates' => 'required',
                // 'ini_agency' => 'required',
                'ini_date' => 'required',
            ],
            [
                'ini_initiates.required' => 'Initiatives field is required!',
                // 'ini_agency.required' => 'Agency field is required!',
                'ini_date.required' => 'Date field is required!',
            ],
        );

        $data = [];
        $data['ini_initiates'] = $request->ini_initiates;
        $data['ini_agency'] = $request->ini_agency;
        $data['ini_date'] = $request->ini_date;

        $insert = DB::table('cbg_initiatives')
            ->where('id', $id)
            ->update($data);

        if ($insert) {
            $notification = [
                'message' => 'Initiative Successfully Updated!',
                'alert-type' => 'success',
            ];

            return redirect()
                ->route('cbgInitiatives')
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('cbgInitiatives')
                ->with($notification);
        }
    }

    public function ini_delete($id)
    {
        $delete = DB::table('cbg_initiatives')
            ->where('id', $id)
            ->delete();
        if ($delete) {
            $notification = [
                'message' => 'Initiative Successfully Deleted!',
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
