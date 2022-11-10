<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rulesSop extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'category_rules_id',
        'title',
        'nomor',
        'tanggal_penetapan',
        'tanggal_berlaku',
        'tanggal_berakhir',
        'status',
        'deskripsi',
        'pdf',
    ];

    public function category()
    {
        return $this->belongsTo(categoryRule::class, 'category_rules_id');
    }
}
