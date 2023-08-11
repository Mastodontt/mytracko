<?php 
namespace App\Interfaces;

use App\Models\Post;

interface PostRepositoryInterface
{
    public function getAllPosts();
    public function getAllPostsPaginated();
    public function getPostById(int $taskId);
    public function deletePost(int $taskId);
    public function createPost(Post $post);
    public function updatePost(Post $post);
}