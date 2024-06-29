<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Timestamps extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function breaks()
    {
        return $this->hasMany(Breaks::class);
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
                $workDuration = $endWork->diffInMinutes($startWork);

                $breakDuration = $timestamp->breaks->sum(function ($break) {
                    $startBreak = Carbon::parse($break->start_break);
                    $endBreak = Carbon::parse($break->end_break);
                    return $endBreak->diffInMinutes($startBreak);
                });

                $worktime = $workDuration - $breakDuration;
                $timestamp->worktime = Carbon::createFromTime(0, $worktime);
            }
        });
    }
}