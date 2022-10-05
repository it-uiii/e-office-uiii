<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingLetter extends Model
{
    protected $fillable = [
        'number',
        'date',
        'subject',
        'destination',
        'description',
        'status',
        'revision',
        'revision_description',
        'signature',
        'created_by',
        'update_by'
    ];

    public function entry_created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function entry_updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getDisplayStatusAttribute()
    {
        switch ($this->status) {
            case 0:
                return '<span class="badge bg-light">Draft</span>' . ($this->revision ? '<span class="badge bg-danger ml-2">Revisi</span>' : '');
                break;
            case 1:
                return '<span class="badge bg-warning">Acc Pelaksana Sekretariat</span>' . ($this->revision ? '<span class="badge bg-danger ml-2">Revisi</span>' : '');
                break;
            case 2:
                return '<span class="badge bg-info">Acc KTU Sekretaris</span>' . ($this->revision ? '<span class="badge bg-danger ml-2">Revisi</span>' : '');
                break;
            case 3:
                return '<span class="badge bg-primary">Acc Sekretaris Universitas</span>' . ($this->revision ? '<span class="badge bg-danger ml-2">Revisi</span>' : '');
                break;
            case 4:
                return '<span class="badge bg-success">Acc Rektor</span>' . ($this->revision ? '<span class="badge bg-danger ml-2">Revisi</span>' : '');
                break;
            default:
                return '<span class="badge bg-danger">Unknown</span>';
                break;
        }
    }
}
