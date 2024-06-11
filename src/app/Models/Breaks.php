<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breaks extends Model
{
    use HasFactory;

    public function timestamps() {
        return $this->belongsTo('App\Models\Timestamps');
    }
    
    protected $fillable = [
        'timestamps_id',
        'start_break',
        'end_break',
        'breaktime',
    ];

    public function timestamp()
    {
        return $this->belongsTo(Timestamps::class);
    }
    
}
