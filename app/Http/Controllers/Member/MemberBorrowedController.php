<?php

namespace App\Http\Controllers\Member;

use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class MemberBorrowedController extends Controller
{
    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->where('status', 3)->get();
        return view('members.borrowed.index', compact('reservations'));
    }

    public function search(Request $request)
    {
        $query = $request->search;
        $books = Book::where('title', 'LIKE', "%$query%")->orWhere('author', 'LIKE', "%$query%")->get();
        $html = view('members.books.search', compact('books'))->render();

        return response()->json($html);
    }

    public function getDetails(Request $request)
    {
        $book = Book::find($request->id);
        $category = Category::where('id', $book->category_id)->first();
    }
}