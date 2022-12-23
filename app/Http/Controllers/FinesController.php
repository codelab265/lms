<?php

namespace App\Http\Controllers;

use App\Models\FinesPayment;
use App\Models\User;
use Illuminate\Http\Request;

class FinesController extends Controller
{
    public function index()
    {
        $users = User::where('role', 2)->get();
        $fines_payments = FinesPayment::all();

        return view('admin.fines.index', compact('users', 'fines_payments'));
    }

    public function store(Request $request)
    {
        FinesPayment::create($request->all());
        return back()->with('success', 'Added successfully');
    }
}