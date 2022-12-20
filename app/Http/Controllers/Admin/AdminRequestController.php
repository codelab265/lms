<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ReservationMail;
use App\Models\AccessNumber;
use App\Models\GraphData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminRequestController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        return view('admin.requests.index', compact('reservations'));
    }

    public function status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $status = 1;
        $reservation = Reservation::find($id);
        $book = Book::find($reservation->book_id);
        $info['status'] = $status == 1 ? 'Accepted' : 'Rejected';
        $user = User::find($reservation->user_id);
        if ($user->role == 2) {
            $course = $user->studentDetail->course;
        }
        if ($user->role == 2) {
            $info['name'] =
                $user->studentDetail->fname . ' ' . $user->studentDetail->lname;
        } else {
            $info['name'] =
                $user->facultyDetail->fname . ' ' . $user->facultyDetail->lname;
        };

        if ($status == 1) {
            $reservation->update(['status' => 3]); //3 means the request is already picked up
            $book->decrement('quantity', 1);
            if ($user->role == 2) {
                GraphData::where('course', $course)->increment('total', 1);
            }
            AccessNumber::where(
                'access_number',
                $reservation->access_number
            )->update([
                'status' => 1,
            ]);
        } else {
            $reservation->update(['status' => 2]);
        }
        Mail::to($user->email)->send(new ReservationMail($info));
        $data['success'] = [
            'message' => 'Status Updated successfully'
        ];
        return response()->json($data, 200);


        //return back()->with('success', 'Status Updated successfully');
    }
}
