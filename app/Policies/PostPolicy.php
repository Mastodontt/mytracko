<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function updatePost(User $user, Post $post): bool
    {
        return $user->id === $post->created_by;
    }

    public function deletePost(User $user, Post $post): bool
    {
        return $user->id === $post->created_by;
    }

    public function like(User $user, Post $post): bool
    {
        return $user->id !== $post->created_by;
    }

}
