<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $data = $request->only('email', 'password');

        if (Auth::attempt($data)) {
            if (Auth::user()->role == 1) {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role == 2) {
                if (Auth::user()->is_verified == 0) {
                    return redirect()
                        ->route('verify')
                        ->with(
                            'error',
                            'Your account is not verified. Check your email for the verification Code'
                        );
                } else {
                    return redirect()->route('members.reservation');

                }
            } else {
                return redirect()->route('members.reservation');
            }
        } else {
            return back()->with(
                'error',
                'Login Failed. Please check email or password'
            );
        }
    }

    

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
