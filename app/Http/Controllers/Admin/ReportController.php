<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReturnedBook;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    public function books_history(Request $request, $period)
    {
        $now = Carbon::now();
        $query = DB::table('reservations as re')
            ->join('books as b', 're.book_id', 'b.id')
            ->leftJoin('student_details as dtls', 'dtls.user_id', 're.user_id')
            ->leftJoin('faculty_details as fdtls', 'fdtls.user_id', 're.user_id')
            ->join('users as user', 'user.id', 're.user_id')
            ->select(
                [
                    're.access_number', 'b.call_number', 'b.title as book_title',
                    'b.author',
                    DB::raw('CASE WHEN dtls.course IS NULL THEN NULL ELSE  dtls.course END as course'),
                    DB::raw('CASE WHEN dtls.course IS NULL THEN fdtls.fname ELSE  dtls.fname END as fname'),
                    DB::raw('CASE WHEN dtls.course IS NULL THEN fdtls.lname ELSE  dtls.lname END as lname'),
                    DB::raw('CASE WHEN dtls.course IS NULL THEN fdtls.mname ELSE  dtls.mname END as mname'),
                    're.status',
                    're.return_date', 're.created_at', 're.returned_date', 'user.role', 're.updated_at'
                ]
            );

        if ($period == 'weekly') {
            $books = $query->whereBetween('re.updated_at', [
                $now->startOfWeek(Carbon::SUNDAY)->format('Y-m-d'),
                $now->endOfWeek(Carbon::SATURDAY)->format('Y-m-d'),
            ])->whereYear('re.created_at', date('Y'))->get();
            $period = 'Weekly';
        } elseif ($period == 'monthly') {
            $books = $query->whereMonth('re.created_at', date('m'))->whereYear('re.created_at', date('Y'))->get();
            $period = 'Monthly';
        } elseif ($period == 'semester') {
            $books = $query->whereYear('re.created_at', date('Y'))
                ->get();
            $period = 'Semeter';
        } else {
            $books = $query->whereDate('re.created_at', $request->date)
                ->get();
            $period = $request->date;
        }
        return view(
            'admin.reports.books_history',
            compact('books', 'period')
        );
    }

    public function added_books(Request $request, $period)
    {
        $now = Carbon::now();

        if ($period == 'weekly') {
            $books = Book::whereBetween('created_at', [
                $now->startOfWeek(Carbon::SUNDAY)->format('Y-m-d'),
                $now->endOfWeek(Carbon::SATURDAY)->format('Y-m-d'),
            ])->whereYear('created_at', date('Y'))->get();
            $period = 'Weekly';
        } elseif ($period == 'monthly') {
            $books = Book::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();
            $period = 'Monthly';
        } elseif ($period == 'semester') {
            $books = Book::whereYear('created_at', date('Y'))->get();
            $period = 'Semester';
        } else {
            $books = Book::whereDate('created_at', $request->date)
                ->get();
            $period = $request->date;
        }

        return view('admin.reports.added_books', compact('books', 'period'));
    }

    public function updated_books(Request $request, $period)
    {
        $now = Carbon::now();

        if ($period == 'weekly') {
            $books = Book::whereBetween('updated_at', [
                $now->startOfWeek(Carbon::SUNDAY)->format('Y-m-d'),
                $now->endOfWeek(Carbon::SATURDAY)->format('Y-m-d'),
            ])->whereYear('created_at', date('Y'))->get();
            $period = 'Weekly';
        } elseif ($period == 'monthly') {
            $books = Book::whereMonth('updated_at', date('m'))->whereYear('created_at', date('Y'))->get();
            $period = 'Monthly';
        } elseif ($period == 'semester') {
            $books = Book::whereYear('updated_at', date('Y'))->get();
            $period = 'Semester';
        } else {
            $books = Book::whereDate('updated_at', $request->date)
                ->get();
            $period = $request->date;
        }

        return view('admin.reports.updated_books', compact('books', 'period'));
    }

    public function inventory(Request $request, $period)
    {
        $now = Carbon::now();

        if ($period == 'weekly') {
            $reservations = Reservation::where('status', 1)
                ->orWhere('status', 3)
                ->whereBetween('created_at', [
                    $now->startOfWeek(Carbon::SUNDAY)->format('Y-m-d'),
                    $now->endOfWeek(Carbon::SATURDAY)->format('Y-m-d'),
                ])->whereYear('created_at', date('Y'))
                ->get();
            $period = 'Weekly';
        } elseif ($period == 'monthly') {
            $reservations = Reservation::where('status', 1)
                ->orWhere('status', 3)
                ->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))
                ->get();
            $period = 'Monthly';
        } elseif ($period == 'semester') {
            $reservations = Reservation::where('status', 1)
                ->orWhere('status', 3)
                ->whereYear('created_at', date('Y'))
                ->get();
            $period = 'Semeter';
        } else {
            $reservations = Reservation::where('status', 1)
                ->orWhere('status', 3)
                ->whereDate('created_at', $request->date)
                ->get();
            $period = $request->date;
        }

        return view(
            'admin.reports.book_inventory',
            compact('reservations', 'period')
        );
    }

    public function issued_books(Request $request, $period)
    {
        $now = Carbon::now();

        if ($period == 'weekly') {
            $reservations = Reservation::where(function ($q) {
                $q->where('status', 1);
                $q->orWhere('status', 3);
            })->whereBetween('updated_at', [
                $now->startOfWeek(Carbon::SUNDAY)->format('Y-m-d'),
                $now->endOfWeek(Carbon::SATURDAY)->format('Y-m-d'),
            ])->whereYear('created_at', date('Y'))
                ->get();
            $period = 'Weekly';
        } elseif ($period == 'monthly') {
            $reservations = Reservation::where(function ($q) {
                $q->where('status', 1);
                $q->orWhere('status', 3);
            })->whereMonth('updated_at', date('m'))->whereYear('created_at', date('Y'))
                ->get();
            $period = 'Monthly';
        } elseif ($period == 'semester') {
            $reservations = Reservation::where(function ($q) {
                $q->where('status', 1);
                $q->orWhere('status', 3);
            })->whereYear('updated_at', date('Y'))
                ->get();
            $period = 'Semeter';
        } else {
            $reservations = Reservation::where(function ($q) {
                $q->where('status', 1);
                $q->orWhere('status', 3);
            })->whereDate('created_at', $request->date)
                ->get();

            $period = $request->date;
        }


        return view(
            'admin.reports.issued_books',
            compact('reservations', 'period')
        );
    }

    public function returned_books(Request $request, $period)
    {
        $now = Carbon::now();
        $returned_books = ReturnedBook::pluck('reservation_id')->all();
        if ($period == 'weekly') {
            $reservations = Reservation::where('status', 3)
                ->whereIn('id', $returned_books)
                ->whereBetween('updated_at', [
                    $now->startOfWeek(Carbon::SUNDAY)->format('Y-m-d'),
                    $now->endOfWeek(Carbon::SATURDAY)->format('Y-m-d'),
                ])->whereYear('created_at', date('Y'))
                ->get();
            $period = 'Weekly';
        } elseif ($period == 'monthly') {
            $reservations = Reservation::where('status', 3)
                ->whereIn('id', $returned_books)
                ->whereMonth('updated_at', date('m'))->whereYear('created_at', date('Y'))
                ->get();
            $period = 'Monthly';
        } elseif ($period == "semester") {
            $reservations = Reservation::where('status', 3)
                ->whereIn('id', $returned_books)
                ->whereYear('updated_at', date('Y'))
                ->get();
            $period = 'Semeter';
        } else {
            $reservations = Reservation::where('status', 3)
                ->whereIn('id', $returned_books)
                ->whereDate('created_at', $request->date)
                ->get();
            $period = $request->date;
        }


        return view(
            'admin.reports.returned_books',
            compact('reservations', 'period')
        );
    }

    public function unreturned_books(Request $request, $period)
    {
        $now = Carbon::now();
        $returned_books = ReturnedBook::pluck('reservation_id')->all();
        if ($period == 'weekly') {
            $reservations = Reservation::where('status', 3)
                ->whereNotIn('id', $returned_books)
                ->whereBetween('updated_at', [
                    $now->startOfWeek(Carbon::SUNDAY)->format('Y-m-d'),
                    $now->endOfWeek(Carbon::SATURDAY)->format('Y-m-d'),
                ])->whereYear('created_at', date('Y'))
                ->get();
            $period = 'Weekly';
        } elseif ($period == 'monthly') {
            $reservations = Reservation::where('status', 3)
                ->whereNotIn('id', $returned_books)
                ->whereMonth('updated_at', date('m'))->whereYear('created_at', date('Y'))
                ->get();
            $period = 'Monthly';
        } elseif ($period == 'semester') {
            $reservations = Reservation::where('status', 3)
                ->whereNotIn('id', $returned_books)
                ->whereYear('updated_at', date('Y'))
                ->get();
            $period = 'Semeter';
        } else {
            $reservations = Reservation::where('status', 3)
                ->whereNotIn('id', $returned_books)
                ->whereDate('created_at', $request->date)
                ->get();
            $period = $request->date;
        }

        return view(
            'admin.reports.unreturned_books',
            compact('reservations', 'period')
        );
    }

    public function fined(Request $request, $period)
    {
        $now = Carbon::now();

        if ($period == 'weekly') {
            $reservations = Reservation::where('status', 3)
                ->where('is_fined', 1)
                ->whereBetween('updated_at', [
                    $now->startOfWeek(Carbon::SUNDAY)->format('Y-m-d'),
                    $now->endOfWeek(Carbon::SATURDAY)->format('Y-m-d'),
                ])->whereYear('created_at', date('Y'))
                ->get();
            $period = 'Weekly';
        } elseif ($period == 'monthly') {
            $reservations = Reservation::where('status', 3)
                ->where('is_fined', 1)
                ->whereMonth('updated_at', date('m'))->whereYear('created_at', date('Y'))
                ->get();
            $period = 'Monthly';
        } elseif ($period == 'semester') {
            $reservations = Reservation::where('status', 3)
                ->where('is_fined', 1)
                ->whereYear('updated_at', date('Y'))
                ->get();
            $period = 'Semeter';
        } else {
            $reservations = Reservation::where('status', 3)
                ->where('is_fined', 1)
                ->whereDate('updated_at', $request->date)
                ->get();
            $period = $request->date;
        }

        return view('admin.reports.fined', compact('reservations', 'period'));
    }

    public function profile(Request $request, $period)
    {
        $now = Carbon::now();

        if ($period == 'weekly') {
            $users = User::whereBetween('created_at', [
                $now->startOfWeek(Carbon::SUNDAY)->format('Y-m-d'),
                $now->endOfWeek(Carbon::SATURDAY)->format('Y-m-d'),
            ])->whereYear('created_at', date('Y'))->get();
            $period = 'Weekly';
        } elseif ($period == 'monthly') {
            $users = User::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();
            $period = 'Monthly';
        } elseif ($period == 'semester') {
            $users = User::whereYear('created_at', date('Y'))->get();
            $period = 'Semeter';
        } else {
            $users = User::whereDate('created_at', $request->date)->get();
            $period = $request->date;
        }

        return view('admin.reports.profile', compact('users', 'period'));
    }

    public function borrowing(Request $request, $period)
    {
        $now = Carbon::now();

        if ($period == 'weekly') {
            $reservations = Reservation::select('user_id', DB::raw('count(*) as total'))->groupBy('user_id')
                ->orderByRaw('COUNT(*) DESC')
                ->whereIn('status', [1, 3])
                ->whereBetween('created_at', [
                    $now->startOfWeek(Carbon::SUNDAY)->format('Y-m-d'),
                    $now->endOfWeek(Carbon::SATURDAY)->format('Y-m-d'),
                ])->whereYear('created_at', date('Y'))
                ->get();
            $period = 'Weekly';
        } elseif ($period == 'monthly') {
            $reservations = Reservation::select('user_id', DB::raw('count(*) as total'))->groupBy('user_id')
                ->orderByRaw('COUNT(*) DESC')
                ->whereIn('status', [1, 3])
                ->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))
                ->get();

            $period = 'Monthly';
        } elseif ($period == 'semester') {
            $reservations = Reservation::select('user_id', DB::raw('count(*) as total'))->groupBy('user_id')
                ->orderByRaw('COUNT(*) DESC')
                ->whereIn('status', [1, 3])
                ->whereYear('created_at', date('Y'))
                ->get();

            $period = 'Semeter';
        } else {
            $reservations = Reservation::select('user_id', DB::raw('count(*) as total'))->groupBy('user_id')
                ->orderByRaw('COUNT(*) DESC')
                ->whereIn('status', [1, 3])
                ->whereDate('created_at', $request->date)
                ->get();

            $period = $request->date;
        }

        return view(
            'admin.reports.borrowed',
            compact('reservations', 'period')
        );
    }

    public function filter_history(Request $request)
    {
        $access_number = $request->access_number;
        $reservations = Reservation::where('access_number', $access_number)->groupBy('user_id')->get();

        $html = view('admin.reports.filtered_books', compact('access_number', 'reservations'))->render();
        return response()->json($html);
    }
}