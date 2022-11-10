<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoryRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'category_name',
        'slug',
        'image',
        'status'
    ];
}
