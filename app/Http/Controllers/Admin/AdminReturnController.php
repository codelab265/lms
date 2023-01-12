<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\FineMail;
use App\Models\Reservation;
use App\Models\AccessNumber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use App\Models\ReturnedBook;

class AdminReturnController extends Controller
{
    public function index()
    {
        $returned_books = ReturnedBook::pluck('reservation_id')->all();
        $reservations = Reservation::where('status', 3)
            ->whereIn('id', $returned_books)
            ->get();
        return view('admin.returned.index', compact('reservations'));
    }

    public function store(Request $request)
    {
        $id = $request->id;
        // $reservation = Reservation::where('access_number', $id)->first(); // orig
        $reservation = Reservation::where('access_number', $id)->orderBy('id', 'DESC')->first(); // fixed query

        $date = date('Y-m-d H:s:i');
        $to = Carbon::createFromFormat('Y-m-d H:s:i', $date);
        $from = Carbon::createFromFormat(
            'Y-m-d H:s:i',
            $reservation->return_date . ' 00:00:00'
        );
        $user = User::find($reservation->user_id);

        $diff_in_days = $to->diffInDays($from); // mao ni 
        $is_fined = $diff_in_days > 0 ? 1 : 0;
        $fine = $diff_in_days > 0 ? $diff_in_days * 5 : null;

        if ($is_fined == 1) {
            Mail::to($user->email)->send(new FineMail($fine));
        }

        $reservation->update([
            'status' => 3,
            'returned_date' => date('Y-m-d'),
            'is_fined' => $reservation->user->role == 3 ? 0 : $is_fined,
            'fine' => $reservation->user->role == 3 ? 0 : $fine,
        ]);


        ReturnedBook::create([
            'reservation_id' =>  $reservation->id,
            'user_id' => $reservation->user_id,
            'book_id' => $reservation->book_id,
        ]);

        $reservation->book->increment('quantity', 1);
        AccessNumber::where('access_number', $id)->update(['status' => 0]);
        return back()->with('success', 'Successfully Added');
    }
}