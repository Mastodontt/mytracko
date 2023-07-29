<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'created_by'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getAuthorAttribute()
    {
        return $this->user->fullname;
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function countLikes()
    {
        return $this->likes()->count();
    }

    public function isLikedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }

}
