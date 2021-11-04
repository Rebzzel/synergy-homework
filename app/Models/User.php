<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Editable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'middle_name',
        'passport_order',
        'passport_id',
        'passport_given_by',
        'birthday_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'passport_order',
        'passport_id',
        'passport_given_by',
        'snils_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'birthday_at' => 'date',
    ];

    protected $editable = [
        'avatar_url',
        'status',
        'about_me',
    ];

    protected $editableOnce = [
        'snils_id'
    ];

    public function getFullNameAttribute()
    {
        return $this->last_name.' '.$this->first_name.' '.$this->middle_name;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getHomeworkAttribute()
    {
        return Homework::where('user_id', $this->id)->get();
    }
}
