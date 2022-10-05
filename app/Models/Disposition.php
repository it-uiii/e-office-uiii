<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disposition extends Model
{
    protected $fillable = [
        'entry_letter_id',
        'user_id'
    ];

    public function entry_letter()
    {
        return $this->belongsTo(EntryLetter::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
