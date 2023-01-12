<?php

use App\Http\Controllers\Admin\AdminBorrowedController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminRequestController;
use App\Http\Controllers\Admin\AdminReturnController;
use App\Http\Controllers\Admin\LostController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\FinesController;
use App\Http\Controllers\Member\MemberBorrowedController;
use App\Http\Controllers\Member\PaymentHistoryController;
use App\Http\Controllers\Member\ReservationController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'index'])
    ->name('login')
    ->middleware('guest');
Route::post('/', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'index'])
    ->name('register')
    ->middleware('guest');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

Route::get('/verify', [RegisterController::class, 'verify'])
    ->name('verify')
    ->middleware('auth');
Route::post('/verify', [RegisterController::class, 'verifyCode']);
Route::post('profile', [ProfileController::class, 'update'])->name('profile');

Route::group(
    [
        'namespace' => 'admin',
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => ['auth'],
    ],
    function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name(
            'dashboard'
        );

        //categories routes
        Route::get('/categories', [CategoryController::class, 'index'])->name(
            'category'
        );
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::patch('/categories', [CategoryController::class, 'update']);

        //users routes
        Route::get('/users', [UserController::class, 'index'])->name('user');
        Route::post('/users', [UserController::class, 'store']);
        Route::patch('/users', [UserController::class, 'update']);

        //books route
        Route::get('/books', [BookController::class, 'index'])->name('book');
        Route::post('/books', [BookController::class, 'store']);
        Route::patch('/books', [BookController::class, 'update']);

        //request route
        Route::get('requests', [AdminRequestController::class, 'index'])->name(
            'requests'
        );
        Route::post('requests/status', [
            AdminRequestController::class,
            'status',
        ])->name('requests.status');

        //Students routes
        Route::get('students', [StudentController::class, 'index'])->name(
            'students'
        );
        Route::post('students', [StudentController::class, 'store']);
        Route::patch('students', [StudentController::class, 'update']);

        //faculty routes
        Route::get('faculties', [FacultyController::class, 'index'])->name(
            'faculty'
        );
        Route::post('faculties', [FacultyController::class, 'store']);
        Route::patch('faculties', [FacultyController::class, 'update']);

        //borrowed books routes
        Route::get('borrowed', [AdminBorrowedController::class, 'index'])->name(
            'borrowed'
        );

        //lost books routes
        Route::get('lost-books', [LostController::class, 'index'])->name('lostbooks');
        Route::post('lost-books', [LostController::class, 'store']);

        //fines payment routes
        Route::get('fines-payments', [FinesController::class, 'index'])->name('finespayments');
        Route::post('fines-payments', [FinesController::class, 'store']);
        Route::get('fines-payment/reservation', [FinesController::class, 'reservation'])->name('fines.reservation');
        //returned books routes
        Route::get('returned', [AdminReturnController::class, 'index'])->name(
            'returned'
        );
        Route::post('returned', [AdminReturnController::class, 'store']);

        //report routes
        Route::get('reports/books-history/{period}', [
            ReportController::class,
            'books_history',
        ])->name('report.books_history');

        Route::get('reports/added-books/{period}', [
            ReportController::class,
            'added_books',
        ])->name('report.added_books');
        Route::get('reports/updated-books/{period}', [
            ReportController::class,
            'updated_books',
        ])->name('report.updated_books');
        Route::get('reports/inventory/{period}', [
            ReportController::class,
            'inventory',
        ])->name('report.inventory');
        Route::get('reports/issued_books/{period}', [
            ReportController::class,
            'issued_books',
        ])->name('report.issued_books');
        Route::get('reports/returned_books/{period}', [
            ReportController::class,
            'returned_books',
        ])->name('report.returned_books');
        Route::get('reports/unreturned_books/{period}', [
            ReportController::class,
            'unreturned_books',
        ])->name('report.unreturned_books');


        Route::get('reports/fined/{period}', [
            ReportController::class,
            'fined',
        ])->name('report.fined');
        Route::get('reports/profile/{period}', [
            ReportController::class,
            'profile',
        ])->name('report.profile');
        Route::get('reports/frequent-borrowing-department/{period}', [
            ReportController::class,
            'borrowing',
        ])->name('report.borrowing');
        Route::get('report/book-history/filter', [ReportController::class, 'filter_history'])->name('filter.book.history');

        Route::get('fines-payments/filter', [FinesController::class, 'filter'])->name('fines-payment.filter');
    }
);

Route::group(
    [
        'namespace' => 'members',
        'prefix' => 'members',
        'as' => 'members.',
        'middleware' => ['auth'],
    ],
    function () {
        Route::get('reservation', [
            ReservationController::class,
            'index',
        ])->name('reservation');
        Route::post('reservation', [ReservationController::class, 'store']);
        Route::get('payment-history', [PaymentHistoryController::class, 'index'])->name('payment.history');

        Route::get('borrowed-books', [MemberBorrowedController::class, 'index'])->name('borrowed');
        Route::get('books/search', [MemberBorrowedController::class, 'search'])->name('book.search');
    }
);

//delete route
Route::post('delete', [DeleteController::class, 'delete'])
    ->name('delete')
    ->middleware('auth');
Route::get('get-book', [BookController::class, 'get_book'])
    ->name('get_book')
    ->middleware('auth');
Route::post('get-book', [BookController::class, 'get_books'])
    ->name('post_get_book')
    ->middleware('auth');
Route::post('get-author', [BookController::class, 'get_author'])
    ->name('post_get_author')
    ->middleware('auth');


Route::get('get-access-number', [BookController::class, 'get_access_number'])
    ->name('get_access_number')
    ->middleware('auth');