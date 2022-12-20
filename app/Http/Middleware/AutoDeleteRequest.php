<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Carbon\Carbon;
class AutoDeleteRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $reservations = Reservation::where('status', 1)->get();
        foreach($reservations as $reservation){
            $created_at = Carbon::parse($reservation->created_at); 
            $now = now();
            $diff = $now->diffInDays($created_at);
            if($diff >= 1) //if the request is already for release after 24 hrs 
                            //we delete the request so that it can be avaiable again for request
            {
                $reservation->delete();

            }
        }
        return $next($request);
    }
}
