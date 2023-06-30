<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Dflydev\DotAccessData\Data;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllUser()
    {
        $title = 'Manage Accounts | RTMS';
        $all = DB::table('users')->get();
        return view('backend.user.all-user', compact('all', 'title'));
    }

    // AddUser & InsertUser
    public function AddUserIndex()
    {
        $title = 'Manage Accounts | RTMS';
        $all = DB::table('agency')->get();
        return view('backend.user.add_user', compact('all', 'title'));
    }

    public function InsertUser(Request $request)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['agencyID'] = $request->agencyID;
        $data['password'] = Hash::make($request->password);
        $data['created_at'] = now();
        $data['updated_at'] = now();

        $insert = DB::table('users')->insert($data);
        if ($insert) {
            $notification = array(
                'message' => 'User Successfully Added!',
                'alert-type' => 'success'
            );
            return redirect()->route('AllUser')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('AllUser')->with($notification);
        }
    }

    public function EditUser($id)
    {
        $title = 'Manage Accounts | RTMS';
        $edit2 = DB::table('agency')
        ->rightJoin('users', 'agency.abbrev', '=', 'users.agencyID')
        ->select('users.*','agency.agency_name', 'agency.id', 'agency.abbrev')
        ->where('users.id', $id)
        ->get();
        
        $edit = DB::table('users')->where('id', $id)->first();
        
        $agency = DB::table('agency')->get();
        return view('backend.user.edit_user', compact('edit','edit2', 'agency', 'title'));
    }

    public function UpdateUser(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['agencyID'] = $request->agencyID;
        $data['updated_at'] = now();

        $update = DB::table('users')->where('id', $id)->update($data);
        if ($update) {
            $notification = array(
                'message' => 'User Successfully Updated!',
                'alert-type' => 'success'
            );
            return redirect()->route('AllUser')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('AllUser')->with($notification);
        }
    }

    public function DeleteUser($id)
    {
        $delete = DB::table('users')->where('id', $id)->delete();
        if ($delete) {
            $notification = array(
                'message' => 'User Successfully Deleted!',
                'alert-type' => 'success'
            );
            return redirect()->route('AllUser')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('AllUser')->with($notification);
        }
    }

}
