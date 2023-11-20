<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Crypt;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;

class DbinfosysController extends Controller
{
    public function AddDbinfosys(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $request->validate(
            [
                'dbinfosys_category' => 'required',
                'dbinfosys_type' => 'required',
                'dbinfosys_title' => 'required',
                'dbinfosys_date_created' => 'required',
                'dbinfosys_purpose' => 'required',
            ],
            [
                'dbinfosys_category.required' => 'Category field is required!',
                'dbinfosys_type.required' => 'Type field is required!',
                'dbinfosys_title.required' => 'Title field is required!',
                'dbinfosys_date_created.required' => 'Date field is required!',
                'dbinfosys_purpose.required' => 'Purpose field is required!',
            ],
        );

        $data = [];
        $data['dbinfosys_category'] = $request->dbinfosys_category;
        $data['dbinfosys_type'] = $request->dbinfosys_type;
        $data['dbinfosys_title'] = $request->dbinfosys_title;
        $data['dbinfosys_date_created'] = $request->dbinfosys_date_created;
        $data['dbinfosys_purpose'] = $request->dbinfosys_purpose;
        $data['created_at'] = now();

        $insert = DB::table('rdmc_dbinfosys')->insert($data);
        if ($insert) {
            return response()->json(['success' => 'DBIS Added Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function EditDbinfosys($id)
    {
        $title = 'DBIS | RDMC';
        $all = DB::table('rdmc_dbinfosys')
            ->where('id', $id)
            ->first();
        // $id = Hash::make($id);
        return view('backend.report.rdmc.rdmc_dbinfosys_edit', compact('title', 'all'));
    }

    public function UpdateDbinfosys(Request $request, $id)
    {
        $request->validate(
            [
                'dbinfosys_category' => 'required',
                'dbinfosys_type' => 'required',
                'dbinfosys_title' => 'required',
                'dbinfosys_date_created' => 'required',
                'dbinfosys_purpose' => 'required',
            ],
            [
                'dbinfosys_category.required' => 'Category field is required!',
                'dbinfosys_type.required' => 'Type field is required!',
                'dbinfosys_title.required' => 'Title field is required!',
                'dbinfosys_date_created.required' => 'Date field is required!',
                'dbinfosys_purpose.required' => 'Purpose field is required!',
            ],
        );

        date_default_timezone_set('Asia/Hong_Kong');

        $data = [];
        $data['dbinfosys_category'] = $request->dbinfosys_category;
        $data['dbinfosys_type'] = $request->dbinfosys_type;
        $data['dbinfosys_title'] = $request->dbinfosys_title;
        $data['dbinfosys_date_created'] = $request->dbinfosys_date_created;
        $data['dbinfosys_purpose'] = $request->dbinfosys_purpose;
        $data['updated_at'] = now();

        $update = DB::table('rdmc_dbinfosys')
            ->where('id', $id)
            ->update($data);
        if ($update) {
            return response()->json(['success' => 'DBIS Added Successfully!']);
        } else {
            return response()->json(['error' => 'There is something wrong...']);
        }
    }

    public function DeleteDbinfosys($id)
    {
        $select = DB::table('rdmc_dbinfosys')
            ->select('dbinfosys_category')
            ->where('id', $id)
            ->first();
        $delete = DB::table('rdmc_dbinfosys')
            ->where('id', $id)
            ->delete();
        if ($delete) {
            $notification = [
                'message' => $select->dbinfosys_category . ' Successfully Deleted!',
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
