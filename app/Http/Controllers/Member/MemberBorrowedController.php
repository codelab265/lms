<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberBorrowedController extends Controller
{
    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())
                                    ->where('status', 3)->get();
        return view('members.borrowed.index', compact('reservations'));
    }
}
