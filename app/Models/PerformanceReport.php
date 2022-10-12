<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceReport extends Model
{
    protected $fillable = [
        'status',
        'revision',
        'revision_description',
        'created_by',
        'updated_by',
    ];

    public function report_created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function report_updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
