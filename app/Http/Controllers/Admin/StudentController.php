<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\StudentDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    //
    public function index()
    {
        $users = User::where('role', 2)->get();
        return view('admin.students.index', compact('users'));
    }

    public function store(Request $request)
    {
        $student = $request->only(
            'fname',
            'mname',
            'lname',
            'gender',
            'course',
            'level'
        );

        $user_id = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 2,
        ])->id;

        $student['user_id'] = $user_id;
        StudentDetail::create($student);

        return back()->with('success', 'Registered Successfully');
    }

    public function update(Request $request)
    {
        $student = $request->only(
            'fname',
            'mname',
            'lname',
            'gender',
            'course',
            'level'
        );
        StudentDetail::where('user_id', $request->user_id)->update($student);
        return back()->with('success', 'Updated Successfully');
    }
}
