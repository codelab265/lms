<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\FinesPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentHistoryController extends Controller
{
    public function index()
    {
        $fines_payments = FinesPayment::where('user_id', Auth::id())->get();
        return view('members.history.index', compact('fines_payments'));
    }
}