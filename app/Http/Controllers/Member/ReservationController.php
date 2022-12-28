<?php

namespace App\Http\Controllers\Member;

use App\Models\Book;
use App\Models\Category;
use App\Models\Reservation;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\ReturnedBook;

class ReservationController extends Controller
{
    public function index()
    {
        if (Auth::user()->is_verified == 0 && Auth::user()->role == 2) {
            return redirect()
                ->route('verify')
                ->with(
                    'error',
                    'Your account is not verified. Check your email for the verification Code'
                );
        }
        $reservations = Reservation::where('user_id', Auth::id())
            ->where('status', 1)->get();
        $categories = Category::all();
        return view(
            'members.books.index',
            compact('reservations', 'categories')
        );
    }

    public function store(Request $request)
    {

        $validate = $request->validate(['user_id' => [
            function ($attribute, $value, $fail) {
                $returned_books = ReturnedBook::where('user_id', $value)->pluck('reservation_id')->all();
                if (Reservation::where('user_id', $value)
                    ->whereNotIn('id', $returned_books)
                    ->exists()
                ) {
                    $fail('You Have Unreturned book Yet you cannot make a request as of now, Please return the first Thank You. ');
                }
            }
        ]]);



        $data = $request->only(
            'user_id',
            'category_id',
            'book_id',
            'access_number'
        );
        $data['role'] = Auth::user()->role;

        if (Auth::user()->role <> 3) {
            $data['return_date'] = Carbon::now()->addDays(7);
        }

        $data['status'] = 1; //auto reserved upon request


        $id = Reservation::create($data)->id;

        $time = time();
        QrCode::generate($id, 'images/' . $time . '.svg');
        $img_url = 'images/' . $time . '.svg';


        Reservation::find($id)->update(['qr_code' => $img_url]);

        return back()->with('success', 'Added successfully');
    }
}