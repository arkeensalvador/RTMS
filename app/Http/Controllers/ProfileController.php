<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\Programs;
use App\Models\Projects;
use App\Models\Researchers;
use Storage;
use Hash;

class ProfileController extends Controller
{
    public function profile_view($id)
    {
        $title = 'Profile | RTMS';
        $all = DB::table('users')
            ->where('id', auth()->user()->id)
            ->first();
        // CMI
        $program = Programs::where('encoder_agency', $all->agencyID)->count();
        $project = Projects::where('encoder_agency', $all->agencyID)->count();
        $researcher = Researchers::where('agency', $all->agencyID)->count();

        // Admin
        $total_program = Programs::count();
        $total_project = Projects::count();
        $total_researcher = Researchers::count();
        return view('backend.profile.profile_view', compact('title', 'all', 'program', 'project', 'researcher', 'total_program', 'total_project', 'total_researcher'));
    }

    public function profile_edit($id)
    {
        $title = 'Profile | RTMS';
        $edit = DB::table('users')
            ->where('id', auth()->user()->id)
            ->first();

        return view('backend.profile.profile_edit', compact('title', 'edit'));
    }

    public function profile_update(Request $request, $id)
    {
        date_default_timezone_set('Asia/Hong_Kong');

        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'profile_picture' => 'nullable|mimes:jpeg,jpg,png',
            ],
            [
                'name.required' => 'Name is required!',
                'email.required' => 'Email is required!',
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
            // $data['password'] = Hash::make($request->password);
            $data['updated_at'] = now();

            $update = DB::table('users')->where('id', $id)->update($data);

            $user->save();

            if ($update) {
                return response()->json(['success' => 'Profile Updated Successfully!']);
            } else {
                return response()->json(['error' => 'There is something wrong...']);
            }
        } else {
            $data = [];
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['password'] = Hash::make($request->password);
            $data['updated_at'] = now();

            $update = DB::table('users')->where('id', $id)->update($data);

            $user->save();
            if ($update) {
                return response()->json(['success' => 'Profile Updated Successfully!']);
            } else {
                return response()->json(['error' => 'There is something wrong...']);
            }
        }
    }
}
