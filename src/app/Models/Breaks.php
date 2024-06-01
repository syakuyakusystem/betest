<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breaks extends Model
{
    use HasFactory;

    public function timestamp() {
        return $this->belongsTo('App\Models\Timestamps');
    }
    
    protected $fillable = [
        'start_break',
        'end_break',
        'totalbreak',
    ];
}
