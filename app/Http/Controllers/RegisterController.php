<?php

namespace App\Http\Controllers;

use App\Mail\VerificationMail;
use App\Models\FacultyDetail;
use App\Models\StudentDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $role = $request->role;
        $student = $request->only(
            'fname',
            'mname',
            'lname',
            'gender',
            'course',
            'level'
        );

        $faculty = $request->only('fname', 'mname', 'lname', 'gender');
        $code = rand(1000, 10000);

        $user_id = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
            'code' => $code,
        ])->id;

        $student['user_id'] = $user_id;
        $faculty['user_id'] = $user_id;

        if ($role == 2) {
            $name =
                $request->fname . ' ' . $request->mname . ' ' . $request->lname;
            $info['code'] = $code;
            $info['name'] = $name;
            StudentDetail::create($student);
            Mail::to($request->email)->send(new VerificationMail($info));
            Auth::loginUsingId($user_id);

            return redirect()
                ->route('verify')
                ->with(
                    'success',
                    'Verification Code has been sent to the email you have registered with'
                );
        } else {
            FacultyDetail::create($faculty);
            return back()->with(
                'success',
                'Registered Successfully, You can now login'
            );
        }
    }

    public function verify()
    {
        return view('verify');
    }

    public function verifyCode(Request $request)
    {
        $user = User::where('id', Auth::id())
            ->where('code', $request->code)
            ->count();
        if ($user > 0) {
            User::find(Auth::id())->update(['is_verified' => 1]);

            return redirect()
                ->route('members.reservation')
                ->with('success', 'Verified Successfully');
        } else {
            return redirect()
                ->route('members.reservation')
                ->with('error', 'Invalid Verification Code');
        }
    }
}
