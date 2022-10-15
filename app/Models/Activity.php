<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'performance_report_id',
        'activity',
        'output',
        'volume',
        'description',
    ];

    public function performance_report()
    {
        return $this->belongsTo(PerformanceReport::class);
    }
}
