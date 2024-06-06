<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timestamps;
use App\Models\Breaks;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Pagination\Paginator;

class TimeStampController extends Controller
{
    // 管理画面表示
    public function index()
    {
        return view('attendance');
    }
    
    // 管理画面で勤務時間から休憩時間をマイナスして表示
    public function attendance(Request $request)
    {
        $currentDate = $request->input('date') ?? Carbon::now()->format('Y-m-d'); // デフォルトで現在の日付を使用
        $date = Carbon::createFromFormat('Y-m-d', $currentDate);

        // 前の日と次の日を計算
        $previousDate = $date->copy()->subDay()->format('Y-m-d');
        $nextDate = $date->copy()->addDay()->format('Y-m-d');

        // 指定された日のタイムスタンプを取得し、ページネーションを設定
        $timestamps = Timestamps::with('breaks', 'user')
            ->whereDate('day', $date)
            ->paginate(5);

        // 勤務サマリーを計算
            $workSummaries = $timestamps->map(function ($timestamp) {
            $totalBreak = $timestamp->breaks->reduce(function ($carry, $break) {
                $startBreak = new Carbon($break->start_break);
                $endBreak = new Carbon($break->end_break);
                return $carry + $startBreak->diffInSeconds($endBreak);
            }, 0);

            $startWork = new Carbon($timestamp->start_work);
            $endWork = new Carbon($timestamp->end_work);
            $totalWork = $startWork->diffInSeconds($endWork) - $totalBreak;

            return [
                'user' => $timestamp->user->name,
                'start_work' => $startWork->format('H:i:s'),
                'end_work' => $endWork->format('H:i:s'),
                'totalbreak' => gmdate('H:i:s', $totalBreak),
                'totalwork' => gmdate('H:i:s', $totalWork),
            ];
        });

        return view('attendance', compact('timestamps', 'workSummaries', 'currentDate', 'previousDate', 'nextDate'));

    }

    // ログアウト処理
    public function logout()
    {
        return view('login');
    }

    // ホームボタンの表示
    public function home()
    {
        $now_date = Carbon::now()->format('Y-m-d');
        $user_id = Auth::user()->id;
        $confirm_date = Timestamps::where('user_id', $user_id)->whereDate('created_at', $now_date)->first();

     // 初期状態。勤務前（0）に設定
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
    

    // 打刻画面表示
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
                'start_work' => $now->format('H:i:s'),
                'day' => $now->toDateString(), 
                'totalwork' => '00:00:00', 
            ]);
        } elseif ($request->has('end_work')) {
                $today_timestamp = Timestamps::where('user_id', $user_id)
                    ->whereDate('day', $now->toDateString())
                    ->first();

                if ($today_timestamp) {
                    $today_timestamp->end_work = $now->format('H:i:s');
                    $start_work = new Carbon($today_timestamp->start_work);
                    $today_timestamp->totalwork = $start_work->diff($now)->format('%H:%I:%S');
                    $today_timestamp->save();
                }

            // 休憩開始・休憩終了ボタン
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

    // 勤務時間から休憩時間をマイナス
    public function showWorkSummary()
    {
        $user_id = Auth::user()->id;
        $timestamps = Timestamps::where('user_id', $user_id)->get();

        $workSummaries = [];

        foreach ($timestamps as $timestamp) {
            $start_work = new Carbon($timestamp->start_work);
            $end_work = new Carbon($timestamp->end_work);
            $work_duration = $start_work->diffInSeconds($end_work);

            // 該当日の全休憩時間を取得
            $breaks = Breaks::where('timestamps_id', $timestamp->id)->get();
            $total_break_seconds = 0;
            foreach ($breaks as $break) {
                $start_break = new Carbon($break->start_break);
                $end_break = new Carbon($break->end_break);
                $total_break_seconds += $start_break->diffInSeconds($end_break);
            }

            // 実働時間を計算
            $actual_work_seconds = $work_duration - $total_break_seconds;
            $actual_work_time = gmdate('H:i:s', $actual_work_seconds);

            $workSummaries[] = [
                'day' => $timestamp->day,
                'start_work' => $timestamp->start_work,
                'end_work' => $timestamp->end_work,
                'totalwork' => gmdate('H:i:s', $work_duration), // 全体の勤務時間
                'actual_work_time' => $actual_work_time, // 休憩時間を差し引いた実働時間
            ];
        }

        return view('admin.work_summary', compact('workSummaries'));
    }
}