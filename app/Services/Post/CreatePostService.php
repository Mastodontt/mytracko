<?php


namespace App\Services\Post;

use App\Models\Post;
use App\Dto\CreatePost;
use App\Interfaces\PostRepositoryInterface;

class CreatePostService
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(CreatePost $createPost): ?Post
    {
        $this->validates($createPost);
        $post = $this->buildPost($createPost);
        $this->postRepository->createPost($post);
        return $post;
    }

    private function validates(CreatePost $createPost): void
    {
        if ($createPost->getTitle() === '') {
            throw new \Exception('Post title cannot be empty string');
        }

        if($createPost->getContent() === '') {
            throw new \Exception('Post content cannot be empty string');
        }

        if ($createPost->getId() == null) {
            return;
        }

        if ($this->postRepository->getPostById($createPost->getId()) instanceof Post) {
            throw new \Exception('Post already exists');
        }
    }

    private function buildPost(CreatePost $createPost): Post
    {
        $post = new Post();
        $post->id = $createPost->getId();
        $post->title = $createPost->getTitle();
        $post->content = $createPost->getContent();
        $post->created_by = $createPost->getCreatedBy();
        return $post;
    }

}