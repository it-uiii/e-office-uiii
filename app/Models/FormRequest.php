<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormRequest extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ProjectCategory()
    {
        return $this->belongsTo(ProjectCategory::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
