<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionalReport extends Model
{
    protected $fillable = [
        'performance_report_id',
        'file',
    ];

    public function performance_report()
    {
        return $this->belongsTo(PerformanceReport::class);
    }
}
