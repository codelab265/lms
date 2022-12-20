<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\FacultyDetail;
use App\Models\StudentDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class FacultyController extends Controller
{
    public function index()
    {
        $users = User::where('role', 3)->get();
        return view('admin.faculty.index', compact('users'));
    }

    public function store(Request $request)
    {
        $faculty = $request->only('fname', 'mname', 'lname', 'gender');

        $user_id = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 3,
        ])->id;

        $faculty['user_id'] = $user_id;
        FacultyDetail::create($faculty);

        return back()->with('success', 'Added Successfully');
    }

    public function update(Request $request)
    {
        $faculty = $request->only('fname', 'mname', 'lname', 'gender');
        FacultyDetail::where('user_id', $request->user_id)->update($faculty);
        return back()->with('success', 'Updated Successfully');
    }
}
