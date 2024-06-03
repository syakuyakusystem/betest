<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timestamps;
use App\Models\Breaks;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class TimeStampController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('attendance');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function attendance()
    {
        return view('attendance');
    }

    public function logout()
    {
        return view('login');
    }

    public function home()
{
    $now_date = Carbon::now()->format('Y-m-d');
    $user_id = Auth::user()->id;
    $confirm_date = Timestamps::where('user_id', $user_id)->whereDate('created_at', $now_date)->first();

    // 初期状態を勤務前（0）に設定
    $status = 0;

    if ($confirm_date) {
        // 勤務中（1）
        $status = 1;

        // 休憩開始のレコードがあり、休憩終了のレコードがない場合は休憩中（2）
        $break = Breaks::where('timestamps_id', $confirm_date->id)->whereNotNull('start_break')->whereNull('end_break')->first();
        if ($break) {
            $status = 2;
        }
    }

    return view('home', compact('status'));
}

 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $timestamp = new timestamp();
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


    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // 画面表示
    public function punch()
    {
        $now_date = Carbon::now()->format('Y-m-d');
        $user_id = Auth::user()->id;
        $confirm_date = Timestamps::where('user_id', $user_id)->whereDate('created_at', $now_date)->first();

   

        return view('index');
    }

    // 勤務開始・勤務終了ボタン
    public function work(Request $request)
    {
        $user_id = Auth::user()->id;
        $now = Carbon::now();

        if ($request->has('start_work')) {
            Timestamps::create([
                'user_id' => $user_id,
                'start_work' => $now,
                'day' => $now->toDateString(), 
                'totalwork' => $now,
            ]);
        } elseif ($request->has('end_work')) {
            $today_timestamp = Timestamps::where('user_id', $user_id)
                ->whereDate('day', $now->toDateString())
                ->first();

            if ($today_timestamp) {
                $today_timestamp->end_work = $now;
                $start_work = new Carbon($today_timestamp->start_work);
                $today_timestamp->totalwork = $start_work->diff($now)->format('%H:%I:%S');
                $today_timestamp->save();
            }
        } elseif ($request->has('start_break')) {
            $today_timestamp = Timestamps::where('user_id', $user_id)
                ->whereDate('day', $now->toDateString())
                ->first();

            if ($today_timestamp) {
                Breaks::create([
                    'timestamps_id' => $today_timestamp->id,
                    'start_break' => $now,
                    'totalbreak' => null,
                ]);
            }
        } elseif ($request->has('end_break')) {
            $today_timestamp = Timestamps::where('user_id', $user_id)
                ->whereDate('day', $now->toDateString())
                ->first();

            if ($today_timestamp) {
                $break = Breaks::where('timestamps_id', $today_timestamp->id)
                    ->whereNull('end_break')
                    ->first();

                if ($break) {
                    $break->end_break = $now;
                    $start_break = new Carbon($break->start_break);
                    $break->totalbreak = $start_break->diff($now)->format('%H:%I:%S');
                    $break->save();
                }
            }
        }

        return redirect()->route('home');
    }
}