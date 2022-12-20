<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminBorrowedController extends Controller
{
    public function index()
    {
        $reservations = Reservation::where(function($q){
            $q->where('status', 1);
            $q->orWhere('status', 3);
        })->get();
        return view('admin.borrowed.index', compact('reservations'));
    }
}
