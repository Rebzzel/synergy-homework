<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory, Editable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'lesson_id',
        'description',
        'done',
        'expire_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'expire_at' => 'date'
    ];

    protected $editable = [
        'done'
    ];

    public function getLessonAttribute()
    {
        return Lesson::find($this->lesson_id);
    }

    public function hasAccess(User $user)
    {
        return $this->user_id == $user->id;
    }
}