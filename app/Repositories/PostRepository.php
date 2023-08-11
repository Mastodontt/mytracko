<?php 
namespace App\Repositories;

use App\Models\Post;
use App\Enums\PaginationOptions;
use App\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    public function getAllPosts()
    {
        return Post::all();
    }

    public function getPostById(int $postId)
    {
        return Post::findOrFail($postId);
    }

    public function getAllPostsPaginated()
    {
        return Post::with('user')
                   ->orderBy('id', 'desc')             
                   ->paginate(PaginationOptions::DEFAULT_PER_PAGE);
    }

    public function deletePost(int $postId)
    {
        return Post::destroy($postId);
    }

    public function createPost(Post $post)
    {
        return $post->save();
    }

    public function updatePost(Post $post)
    {
        return $post->save();
    }
}
