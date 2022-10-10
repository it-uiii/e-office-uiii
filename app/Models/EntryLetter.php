<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntryLetter extends Model
{
    protected $fillable = [
        'number',
        'subject',
        'date_in',
        'date_letters',
        'sender',
        'file',
        'description',
        'created_by',
        'update_by'
    ];

    public function scopeFilter($entry_letter)
    {
        $entry_letter->when(request('search'), function ($query) {
            $query->where('number', 'LIKE', '%' . request('search') . '%')
                ->orWhere('subject', 'LIKE', '%' . request('search') . '%')
                ->orWhere('sender', 'LIKE', '%' . request('search') . '%')
                ->orWhere('description', 'LIKE', '%' . request('search') . '%')
                ->orWhere('date_in', 'LIKE', '%' . request('search') . '%')
                ->orWhere('date_letters', 'LIKE', '%' . request('search') . '%');
        });

        return $entry_letter;
    }

    public function entry_created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function entry_updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function dispositions()
    {
        return $this->hasMany(Disposition::class);
    }

    public function disposition_names()
    {
        return $this->hasManyThrough(User::class, Disposition::class, 'entry_letter_id', 'id', 'id', 'user_id');
    }
}
