<?php

namespace App\Http\Controllers;

use App\Models\FinesPayment;
use App\Models\Reservation;
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

    public function reservation(Request $request)
    {
        $id = $request->id;
        $reservations = Reservation::where('user_id', $id)->where('is_fined', 1)->get();
        $html = view('admin.fines.reservation', compact('reservations'))->render();

        return response()->json(['html' => $html]);
    }

    public function filter(Request $request)
    {
        $users = User::where('role', 2)->get();
        $fines_payments = FinesPayment::whereDate('created_at', $request->date)->get();
        return view('admin.fines.index', compact('fines_payments', 'users'));
    }

    public function details(Request $request)
    {
        $id = $request->id;

        $reservation = Reservation::find($id);

        $data['book-id'] = $reservation->book_id;
        $data['book'] = $reservation->book->title;
        $data['course'] = $reservation->user->studentDetail->course;
        $data['year'] = $reservation->user->studentDetail->level;
        $data['access_number'] = $reservation->access_number;
        $data['amount_to_pay'] = $reservation->fine;


        return response()->json($data);
    }
}