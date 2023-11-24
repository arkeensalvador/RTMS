<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProfileController extends Controller
{
    public function profile_view($id)
    {
        $title = 'Profile | RTMS';
        $all = DB::table('users')
            ->where('id', auth()->user()->id)
            ->first();

        return view('backend.profile.profile_view', compact('title', 'all'));
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
            ],
            [
                'name.required' => 'Name is required!',
                'email.required' => 'Email is required!',
            ],
        );

        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['updated_at'] = now();

        $update = DB::table('users')
            ->where('id', $id)
            ->update($data);
        if ($update) {
            $notification = [
                'message' => 'Profile Successfully Updated!',
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
