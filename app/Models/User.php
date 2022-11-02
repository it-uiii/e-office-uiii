<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'head_id',
        'position_id',
        'name',
        'username',
        'nrp',
        'appoinment_number',
        'appoinment_date',
        'entry_date',
        'birth_date',
        'npwp',
        'bank',
        'account_number',
        'avatar',
        'email',
        'status',
        'password',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['username'] = Str::of($value)->slug('');
    }

    public function reports()
    {
        return $this->hasMany(Laporan::class);
    }

    public function head()
    {
        return $this->belongsTo(User::class, 'head_id');
    }

    public function outgoing_letters()
    {
        return $this->hasMany(OutgoingLetter::class, 'created_by');
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function item()
    {
        return $this->hasMany(items::class);
    }

    public function supplier()
    {
        return $this->hasMany(supplier::class);
    }
}
