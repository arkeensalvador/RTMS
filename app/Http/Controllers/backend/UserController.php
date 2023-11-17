<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Mail\NewUserWelcomeMail;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use DB;
use Dflydev\DotAccessData\Data;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Response;

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

        // CMI
        $all_filter = DB::table('users')
            ->select('*')
            ->where('agencyID', auth()->user()->agencyID)
            ->get();

        return view('backend.user.all-user', compact('all', 'title', 'all_filter'));
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

        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['role'] = $request->role;
        $data['agencyID'] = $request->agencyID;
        $data['password'] = Hash::make($request->password);
        $data['created_at'] = now();

        $insert = DB::table('users')->insertGetId($data);
        $id = $insert;
        if ($insert) {
            $users = new User();
            $users->name = $request->name;
            $users->email = $request->email;
            $users->role = $request->role;
            $users->agencyID = $request->agencyID;
            $users->password = $request->password;

            $welcomeEmail = new NewUserWelcomeMail($users);

            Mail::to($users->email)->send($welcomeEmail);

            $notification = [
                'message' => 'User Successfully Added!',
                'alert-type' => 'success',
            ];

            return redirect()
                ->route('AllUser')
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('AllUser')
                ->with($notification);
        }
    }

    public function EditUser($id)
    {
        $title = 'Manage Accounts | RTMS';
        $edit2 = DB::table('agency')
            ->rightJoin('users', 'agency.abbrev', '=', 'users.agencyID')
            ->select('users.*', 'agency.agency_name', 'agency.id', 'agency.abbrev')
            ->where('users.id', $id)
            ->get();

        $edit = DB::table('users')
            ->where('id', $id)
            ->first();

        $agency = DB::table('agency')->get();
        return view('backend.user.edit_user', compact('edit', 'edit2', 'agency', 'title'));
    }

    public function UpdateUser(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        if (empty($request->password)) {
            $data = [];
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['role'] = $request->role;
            $data['agencyID'] = $request->agencyID;
            // $data['password'] = Hash::make($request->password);
            $data['updated_at'] = now();

            $update = DB::table('users')
                ->where('id', $id)
                ->update($data);
            if ($update) {
                $notification = [
                    'message' => 'User Successfully Updated!',
                    'alert-type' => 'success',
                ];
                return redirect()
                    ->route('AllUser')
                    ->with($notification);
            } else {
                $notification = [
                    'message' => 'Something is wrong, please try again!',
                    'alert-type' => 'error',
                ];
                return redirect()
                    ->route('AllUser')
                    ->with($notification);
            }
        } else {
            $data = [];
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['role'] = $request->role;
            $data['agencyID'] = $request->agencyID;
            $data['password'] = Hash::make($request->password);
            $data['updated_at'] = now();

            $update = DB::table('users')
                ->where('id', $id)
                ->update($data);
            if ($update) {
                $notification = [
                    'message' => 'User Successfully Updated!',
                    'alert-type' => 'success',
                ];
                return redirect()
                    ->route('AllUser')
                    ->with($notification);
            } else {
                $notification = [
                    'message' => 'Something is wrong, please try again!',
                    'alert-type' => 'error',
                ];
                return redirect()
                    ->route('AllUser')
                    ->with($notification);
            }
        }
    }

    public function downloadTemplate()
    {
        $file_path = storage_path('import-templates\users-template.xlsx');
        return Response::download($file_path);
    }

    public function DeleteUser($id)
    {
        $delete = DB::table('users')
            ->where('id', $id)
            ->delete();
        if ($delete) {
            $notification = [
                'message' => 'User Successfully Deleted!',
                'alert-type' => 'success',
            ];
            return redirect()
                ->route('AllUser')
                ->with($notification);
        } else {
            $notification = [
                'message' => 'Something is wrong, please try again!',
                'alert-type' => 'error',
            ];
            return redirect()
                ->route('AllUser')
                ->with($notification);
        }
    }
}
