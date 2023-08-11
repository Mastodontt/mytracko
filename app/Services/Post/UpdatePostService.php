<?php


namespace App\Services\Post;


use App\Dto\UpdatePost;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;

class UpdatePostService
{

    private $postRepository;

    public function __construct(PostRepositoryInterface $repository)
    {
        $this->postRepository = $repository;
    }

    public function handle(UpdatePost $updatePost): ?Post
    {
        $this->validates($updatePost);
        $existingPost = $this->findOrError($updatePost);
        $this->buildPost($updatePost, $existingPost);
        return $existingPost;
    }

    private function validates(UpdatePost $updatePost)
    {
        if ($updatePost->getId() == null) {
            throw new \Exception('Post doesnt exists');
        }
    }

    private function buildPost(UpdatePost $updatePost, ?Post $existingPost): void
    {
        $existingPost->title = $updatePost->getTitle();
        $existingPost->content = $updatePost->getContent();
        $this->postRepository->updatePost($existingPost);
    }

    private function findOrError(UpdatePost $updatePost)
    {
        $existingPost = $this->postRepository->getPostById($updatePost->getId());

        if (!$existingPost instanceof Post) {
            throw new \Exception('Post doesnt exists');
        }
        return $existingPost;
    }


}