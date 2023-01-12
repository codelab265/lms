<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccessNumber;
use App\Models\Book;
use App\Models\LostBook;
use App\Models\Reservation;
use App\Models\StudentDetail;
use App\Models\User;
use Illuminate\Http\Request;

class LostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('date')) {
            $lost_books = LostBook::whereDate('created_at', $request->date)->get();
        } else {
            $lost_books = LostBook::all();
        }

        $users = User::where('role', 2)->get();
        $books = Book::all();


        return view('admin.lost.index', compact('users', 'lost_books', 'books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $book = Book::find($request->book_title);
        $data['book_title'] = $book->title;
        LostBook::create($data);
        return back()->with('success', 'Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function access_number(Request $request)
    {
        $id = $request->id;
        $access_numbers = AccessNumber::where('book_id', $id)->get();
        $html = view('admin.lost.access_number', compact('access_numbers'))->render();
        return response()->json($html);
    }

    public function course(Request $request)
    {
        $id = $request->id;
        $studentDetail = StudentDetail::where('user_id', $id)->first();
        $course = $studentDetail->course;
        $data['course'] = $course;
        $data['year'] = $studentDetail->level;
        return response()->json($data);
    }
}