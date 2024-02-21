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
use Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllUser()
    {
        $title = 'Manage Accounts | RTMS';
        $all = DB::table('users')
            ->orderBy('name', 'asc')
            ->get();

        // CMI
        $all_filter = DB::table('users')
            ->select('*')
            ->where('agencyID', auth()->user()->agencyID)
            ->orderBy('name', 'asc')
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
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'role' => 'required',
                'agencyID' => 'required',
                'profile_picture' => 'nullable|mimes:jpeg,jpg,png',
            ],
            [
                'name.required' => 'Name is required!',
                'email.required' => 'Email is required!',
                'role.required' => 'Role is required!',
                'agencyID.required' => 'Agency is required!',
                'profile_picture.nullable' => 'Profile Picture is required!',
            ],
        );

        // Auto-rename the uploaded profile picture
        $profilePicture = $request->file('profile_picture');
        $extension = $profilePicture->getClientOriginalExtension();
        $newFileName = "{$request->name}_profile_picture.{$extension}";
        $profilePicturePath = $profilePicture->storeAs('profile_pictures', $newFileName, 'profile');

        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['role'] = $request->role;
        $data['agencyID'] = $request->agencyID;
        $data['profile_picture'] = $profilePicturePath;
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

            // $notification = [
            //     'message' => 'User Successfully Added!',
            //     'alert-type' => 'success',
            // ];

            // return redirect()
            //     ->route('AllUser')
            //     ->with($notification);

            return response()->json(['success' => 'User Added Successfully!']);
        } else {
            // $notification = [
            //     'message' => 'Something is wrong, please try again!',
            //     'alert-type' => 'error',
            // ];
            // return redirect()
            //     ->route('AllUser')
            //     ->with($notification);

            return response()->json(['error' => 'There is something wrong...']);
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

        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'role' => 'required',
                'agencyID' => 'required',
                'profile_picture' => 'nullable|mimes:jpeg,jpg,png',
            ],
            [
                'name.required' => 'Name is required!',
                'email.required' => 'Email is required!',
                'role.required' => 'Role is required!',
                'agencyID.required' => 'Agency is required!',
                'profile_picture.nullable' => 'Profile picture is required',
            ],
        );

        $user = User::find($id);
        if ($request->hasFile('profile_picture')) {
            // Remove old profile picture
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Save the new profile picture
            $profilePicture = $request->file('profile_picture');
            $extension = $profilePicture->getClientOriginalExtension();
            $newFileName = "{$user->name}_profile_picture.{$extension}";
            $profilePicturePath = $profilePicture->storeAs('profile_pictures', $newFileName, 'profile');
            $user->profile_picture = $profilePicturePath;
        }

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

            $user->save();

            if ($update) {
                return response()->json(['success' => 'User Updated Successfully!']);
            } else {
                return response()->json(['error' => 'There is something wrong...']);
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

            $user->save();
            if ($update) {
                return response()->json(['success' => 'User Added Successfully!']);
            } else {
                return response()->json(['error' => 'There is something wrong...']);
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
        $user = User::find($id);
        Storage::disk('public')->delete($user->profile_picture);

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
