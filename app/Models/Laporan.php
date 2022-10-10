<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $fillable = [
    //     'kegiatan',
    //     'keterangan',
    //     'filenames',
    //     'tanggal_dibuat',
    //     'revisi',
    //     'status'
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setFilenamesAttribute($value)
    {
        $this->attributes['filenames'] = json_encode($value);
    }
}
