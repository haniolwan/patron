<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'subject_id',
        'code',
        'description',
        'private'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
