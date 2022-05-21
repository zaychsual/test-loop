<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function comment()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }
}
