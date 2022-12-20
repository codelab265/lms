<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\GraphData;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $number_of_books = Book::sum('quantity');
        $most_borrowed_book = Reservation::where('status', 3)
            ->groupBy('book_id')
            ->orderByRaw('COUNT(*) DESC')
            ->first();
        $number_of_students = User::where('role', 2)->count();
        $number_of_faculty = User::where('role', 3)->count();
        $graphDatas = GraphData::all();
        $course = [];
        $total = [];
        foreach ($graphDatas as $graphData) {
            $course[] = $graphData->course;
            $total[] = $graphData->total;
        }
        return view(
            'admin.dashboard.index',
            compact(
                'number_of_books',
                'most_borrowed_book',
                'number_of_students',
                'number_of_faculty',
                'course',
                'total'
            )
        );
    }
}
