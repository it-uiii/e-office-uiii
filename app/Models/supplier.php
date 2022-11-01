<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // public function item()
    // {
    //     return $this->hasMany(items::class);
    // }

    public function user()
    {
        return $this->belongsTo(users::class, 'user_id');
    }
}
