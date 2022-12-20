<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Reservation;
use App\Models\StudentDetail;
use App\Models\User;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
        $id = $request->id;
        $page = $request->page;

    

        if ($page == 'user') {
            User::find($id)->delete();
        } elseif ($page == 'category') {
            Category::find($id)->delete();
        } elseif ($page == 'book') {
            Book::find($id)->delete();
        }elseif ($page == 'reservation') {
            Reservation::find($id)->delete();
        } else {
            return back();
        }

        return back()->with('success', 'Delete successfully');
    }
}
