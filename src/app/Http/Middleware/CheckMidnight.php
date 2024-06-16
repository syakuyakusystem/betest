<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Timestamp;

class CheckMidnight
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $currentTimestamp = Timestamp::where('user_id', $user->id)->latest()->first();

            if ($currentTimestamp && is_null($currentTimestamp->end_work)) {
                $now = Carbon::now();
                $startWorkTime = Carbon::parse($currentTimestamp->start_work);
                
                if ($startWorkTime->day != $now->day) {
                    // 勤務開始時間と現在時刻の日付が異なる場合、24時を過ぎていると見なす
                    $currentTimestamp->end_work = '24:00:00';
                    $currentTimestamp->save();
                }
            }
        }

        return $next($request);
    }
}
