<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccessNumber;
use App\Models\Reservation;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BookController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $books = Book::all();
        $borrowed = Reservation::where('status', 1)->count();
        $returned = Reservation::where('status', 3)->count();
        $notReturned = $borrowed - $returned;
        $reservations = Reservation::groupBy('user_id')->get();

        return view(
            'admin.books.index',
            compact(
                'categories',
                'books',
                'borrowed',
                'returned',
                'notReturned',
                'reservations'
            )
        );
    }

    public function store(Request $request)
    {
        $data = $request->only(
            'category_id',
            'title',
            'author',
            'publisher',
            'copyright',
            'call_number',
            'isbn_no',
            'price',
            'edition'
        );
        $data['quantity'] = count($request->access_number);

        $id = Book::create($data)->id;
        $time = time();

        QrCode::generate($id, 'images/' . $time . '.svg');
        $img_url = 'images/' . $time . '.svg';

        Book::find($id)->update(['qr_code' => $img_url]);

        for ($i = 0; $i < count($request->access_number); $i++) {
            $accessNumber = new AccessNumber();
            $accessNumber->book_id = $id;
            $accessNumber->access_number = $request->access_number[$i];
            $accessNumber->save();
        }

        return back()->with('success', 'Added successfully');
    }

    public function update(Request $request)
    {
        $data = $request->only(
            'category_id',
            'title',
            'author',
            'publisher',
            'copyright',
            'call_number',
            'isbn_no',
            'price',
            'edition',
            'quantity'
        );

        Book::find($request->id)->update($data);
        return back()->with('success', 'Updated successfully');
    }

    public function get_book(Request $request)
    {
        $id = $request->id;

        $books = Book::where('category_id', $id)->get();
        return response()->json($books);
    }


    public function get_books(Request $request)
    {
        $data = [];
        $search = '';
        $category_id = '';
        $author = '';
        if ($request->has('q')) {
            if (isset($request->q['term'])) {
                $search = $request->q['term'];
            }
        }
        if ($request->has('category_id')) {
            $category_id = $request->category_id;
        }
        if ($request->has('author')) {
            $author = $request->author;
        }
        $data = Book::select('id', 'title')
            ->where('title', 'LIKE', "%{$search}%")
            ->where('author', 'LIKE', "%{$author}%")
            ->where('category_id', $category_id)
            ->get();
        return response()->json($data, 200);
    }
    public function get_author(Request $request)
    {
        $data = [];
        $search = '';
        $category_id = '';
        $book_id = '';
        if ($request->has('q')) {
            if (isset($request->q['term'])) {
                $search = $request->q['term'];
            }
        }
        if ($request->has('category_id')) {
            $category_id = $request->category_id;
        }
        if ($request->has('book_id')) {
            $book_id = $request->book_id;
        }
        $data = Book::select('author', 'author')
            ->where('author', 'LIKE', "%{$search}%")
            ->where('id', 'LIKE', "%{$book_id}%")
            ->where('category_id', $category_id)
            ->get();
        return response()->json($data, 200);
    }

    public function get_access_number(Request $request)
    {
        $id = $request->id;

        $books = AccessNumber::where('book_id', $id)->where('status', 0)->get();
        return response()->json($books);
    }
}