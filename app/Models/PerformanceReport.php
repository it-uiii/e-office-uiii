<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceReport extends Model
{
    protected $fillable = [
        'date',
        'status',
        'signature_reporter',
        'signature_leader',
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

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function additional_reports()
    {
        return $this->hasMany(AdditionalReport::class);
    }

    public function getDisplayStatusAttribute()
    {
        switch ($this->status) {
            case 0:
                return '<span class="badge bg-light">Draft</span>' . ($this->revision ? '<span class="badge bg-danger ml-2">Revisi</span>' : '');
                break;
            case 1:
                return '<span class="badge bg-success">Acc KTU Pimpinan</span>' . ($this->revision ? '<span class="badge bg-danger ml-2">Revisi</span>' : '');
                break;
            default:
                return '<span class="badge bg-danger">Unknown</span>';
                break;
        }
    }
}
