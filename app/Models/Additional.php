<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Additional extends Model
{
    protected $table = 'additional';
    protected $fillable = [
        'outgoing_letter_id',
        'file',
    ];

    public function outgoing_letter()
    {
        return $this->belongsTo(OutgoingLetter::class);
    }
}
