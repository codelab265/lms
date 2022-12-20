<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $id = Auth::id();
        $role = Auth::user()->role;

        $user = User::find($id);
        if ($role == 1) {
            $user->name = $request->name;
        }
        if ($role == 2) {
            $user->studentDetail->fname = $request->fname;
            $user->studentDetail->mname = $request->mname;
            $user->studentDetail->lname = $request->lname;
        }
        if ($role == 3) {
            $user->facultyDetail->fname = $request->fname;
            $user->facultyDetail->mname = $request->mname;
            $user->facultyDetail->lname = $request->lname;
        }

        if ($request->password != "") {
            $user->password = Hash::make($request->password);
        }
        $user->email = $request->email;

        if ($request->profile != "") {
            $photo = time() . '.' . $request->profile->getClientOriginalExtension();
            $request->profile->move(public_path('images'), $photo);
            $user->profile = 'images/' . $photo;
        }

        $user->save();

        return back()->with('Success', 'Updated Successfully');
    }
}
