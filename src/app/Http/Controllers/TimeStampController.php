<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timestamps;
use App\Models\Breaks;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class TimeStampController extends Controller
{
    // コンストラクタ。認証ミドルウェアを設定し、認証されていないユーザーがアクセスできないようにする。
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ホーム画面表示
    public function home()
    {
        // 現在の日付を取得
        $now_date = Carbon::now()->format('Y-m-d');
        // 現在のユーザーIDを取得
        $user_id = Auth::user()->id;
        // 今日のタイムスタンプを取得
        $confirm_date = Timestamps::where('user_id', $user_id)->whereDate('created_at', $now_date)->first();

        // 初期状態。勤務前（0）に設定
        $status = 0;

        if ($confirm_date) {
            // 勤務中（1）に設定
            $status = 1;

            // 休憩開始のレコードがあり、休憩終了のレコードがない場合は休憩中（2）
            $break = Breaks::where('timestamps_id', $confirm_date->id)->whereNotNull('start_break')->whereNull('end_break')->first();
            if ($break) {
                $status = 2;
            }
        }
        // ステータスをビューに渡す
        return view('home', compact('status'));
    }

    // 打刻画面表示
    public function punch()
    {
        return view('index');
    }

    // 勤務開始・勤務終了・休憩開始・休憩終了ボタン処理
    public function work(Request $request)
    {
        // 現在のユーザーIDを取得
        $user_id = Auth::user()->id;
        // 現在の時刻を取得
        $now = Carbon::now();

        // 勤務開始ボタンが押された場合の処理
        if ($request->has('start_work')) {
            // 新しい勤務開始レコードを作成
            Timestamps::create([
                'user_id' => $user_id,
                'start_work' => $now->format('H:i:s'),
                'day' => $now->toDateString(),
                'totalwork' => '00:00:00',
            ]);
        } elseif ($request->has('end_work')) {
            // 勤務終了ボタンが押された場合の処理
            $today_timestamp = Timestamps::where('user_id', $user_id)
                ->whereDate('day', $now->toDateString())
                ->first();

            if ($today_timestamp) {
                // 勤務終了時刻を記録し、勤務時間を計算
                $today_timestamp->end_work = $now->format('H:i:s');
                $start_work = new Carbon($today_timestamp->start_work);
                $today_timestamp->totalwork = $start_work->diff($now)->format('%H:%I:%S');
                $today_timestamp->save();
            }

        } elseif ($request->has('start_break')) {
            // 休憩開始ボタンが押された場合の処理
            $today_timestamp = Timestamps::where('user_id', $user_id)
                ->whereDate('day', $now->toDateString())
                ->first();

            if ($today_timestamp) {
                // 休憩開始レコードを作成
                Breaks::create([
                    'timestamps_id' => $today_timestamp->id,
                    'start_break' => $now,
                    'breaktime' => null,
                ]);
            }
        } elseif ($request->has('end_break')) {
            // 休憩終了ボタンが押された場合の処理
            $today_timestamp = Timestamps::where('user_id', $user_id)
                ->whereDate('day', $now->toDateString())
                ->first();

            if ($today_timestamp) {
                // 休憩終了時刻を記録し、休憩時間を計算
                $break = Breaks::where('timestamps_id', $today_timestamp->id)
                    ->whereNull('end_break')
                    ->first();

                if ($break) {
                    $break->end_break = $now;
                    $start_break = new Carbon($break->start_break);
                    $break->breaktime = $start_break->diff($now)->format('%H:%I:%S');
                    $break->save();
                }
            }
        }
        // ホーム画面にリダイレクト
        return redirect()->route('home');
    }
    
    // 管理画面で勤務時間から休憩時間をマイナスして表示
    public function attendance(Request $request)
    {
        // 現在の日付を取得、もしくはリクエストから取得
        $currentDate = $request->input('date') ?? Carbon::now()->format('Y-m-d');
        $date = Carbon::createFromFormat('Y-m-d', $currentDate);

        // 前の日と次の日を計算
        $previousDate = $date->copy()->subDay()->format('Y-m-d');
        $nextDate = $date->copy()->addDay()->format('Y-m-d');

        // 指定された日のタイムスタンプを取得し、ページネーションを設定
        $timestamps = Timestamps::with('breaks', 'user')
            ->whereDate('day', $date)
            ->paginate(5)
            ->appends(['date' => $currentDate]); // 日付情報をページネーションリンクに追加

        // 勤務サマリーを計算
        $workSummaries = $timestamps->map(function ($timestamp) {
            $breaktime = $timestamp->breaks->reduce(function ($carry, $break) {
                $startBreak = new Carbon($break->start_break);
                $endBreak = new Carbon($break->end_break);
                return $carry + $startBreak->diffInSeconds($endBreak);
            }, 0);

            $startWork = new Carbon($timestamp->start_work);
            $endWork = new Carbon($timestamp->end_work);
            $totalWork = $startWork->diffInSeconds($endWork) - $breaktime;

            // 勤務サマリーを返す
            return [
                'user' => $timestamp->user->name,
                'start_work' => $startWork->format('H:i:s'),
                'end_work' => $endWork->format('H:i:s'),
                'breaktime' => gmdate('H:i:s', $breaktime),
                'totalwork' => gmdate('H:i:s', $totalWork),
            ];
        });

        // 管理画面ビューにデータを渡して表示
        return view('attendance', compact('timestamps', 'workSummaries', 'currentDate', 'previousDate', 'nextDate'));
    }
    
    // ログアウト処理
    public function logout()
    {
        Auth::logout();
        return redirect()->route('register');
    }

}