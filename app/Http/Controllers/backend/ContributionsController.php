<?php

namespace App\Http\Controllers\backend;

use App\Models\Contributions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ContributionsController extends Controller
{
    public function con_add(Request $request)
    {
        $request->validate(
            [
                'con_name' => 'required',
                'con_amount' => 'required',
            ],
            [
                'con_amount.required' => 'Input numbers only',
            ],
        );

        $data = [];
        $data['con_name'] = $request->con_name;
        $data['con_amount'] = str_replace(',', '', $request->con_amount);

        $insert = DB::table('cbg_contributions')->insert($data);

        if ($insert) {
            $notification = [
                'message' => 'Contribution Successfully Added!',
                'alert-type' => 'success',
            ];

            return redirect()
                ->route('cbgContributions')
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('cbgContributions')
                ->with($notification);
        }
    }

    public function con_update(Request $request, $id)
    {
        $request->validate(
            [
                'con_name' => 'required',
                'con_amount' => 'required',
            ],
            [
                'con_amount.required' => 'Input numbers only',
            ],
        );
        $data = [];
        $data['con_name'] = $request->con_name;
        $data['con_amount'] = str_replace(',', '', $request->con_amount);

        $insert = DB::table('cbg_contributions')
            ->where('id', $id)
            ->update($data);

        if ($insert) {
            $notification = [
                'message' => 'Contribution Successfully Updated!',
                'alert-type' => 'success',
            ];

            return redirect()
                ->route('cbgContributions')
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('cbgContributions')
                ->with($notification);
        }
    }

    public function con_delete($id)
    {
        $delete = DB::table('cbg_contributions')
            ->where('id', $id)
            ->delete();
        if ($delete) {
            $notification = [
                'message' => 'Contribution Successfully Deleted!',
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
