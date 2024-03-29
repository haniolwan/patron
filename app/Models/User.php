<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'gender',
        'specialization',
        'image',
        'phone',
        'bio',
        'rule',
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


    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function joinedSubjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_student', 'student_id', 'subject_id');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'user_id');
    }
    
    public function attendedQuizzes()
    {
        return $this->belongsToMany(Quiz::class, 'quiz_student', 'student_id', 'quiz_id')->withPivot('score');
    }

    public function finishedQuizzes()
    {
        return $this->belongsToMany(Quiz::class, 'quiz_student', 'student_id', 'quiz_id')->where('status', 'finished');
    }

    public function notAttended()
    {
        return $this->belongsToMany(Quiz::class, 'quiz_student', 'student_id', 'quiz_id')->where('status', '<>', 'finished');
    }

    public function assignedSubjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_teacher', 'teacher_id', 'subject_id');
    }
}
