<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Timestamps extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function breaks() {
        return $this->hasMany('App\Models\Breaks');
    }

    protected $fillable = [
        'user_id',
        'start_work',
        'end_work',
        'day',
        'totalwork',
        'worktime',
    ];

    protected static function booted()
    {
        static::saving(function ($timestamp) {
            if ($timestamp->end_work) {
                $startWork = Carbon::parse($timestamp->start_work);
                $endWork = Carbon::parse($timestamp->end_work);

                // 勤務時間を計算
                $workDuration = $endWork->diffInMinutes($startWork);

                // 休憩時間を計算
                $breakDuration = $timestamp->breaks->sum(function ($break) {
                    $startBreak = Carbon::parse($break->start_break);
                    $endBreak = Carbon::parse($break->end_break);
                    return $endBreak->diffInMinutes($startBreak);
                });

                // 勤務時間から休憩時間を引く
                $worktime = $workDuration - $breakDuration;

                // worktimeを設定
                $timestamp->worktime = Carbon::createFromTime(0, $worktime);
            }
        });
    }

}
