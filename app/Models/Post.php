<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function usersThatLike(): MorphToMany
    {
        return $this->morphToMany(User::class, 'likeable');
    }

    public function usersThatDislike(): MorphToMany
    {
        return $this->morphToMany(User::class, 'dislikeable');
    }

    public function isLiked()
    {
        return $this->usersThatLike()->where('user_id', Auth::user()->id)->exists();
    }

    public function isDisliked()
    {
        return $this->usersThatDislike()->where('user_id', Auth::user()->id)->exists();
    }
}
