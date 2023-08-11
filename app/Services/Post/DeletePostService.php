<?php
namespace App\Services\Post;


use App\Models\Post;
use App\Models\Product;
use App\Dto\DeletePost;;
use App\Interfaces\PostRepositoryInterface;
use App\Exceptions\ProductNotExistsException;
use App\Exceptions\ProductIdCannotBeEmptyException;

class DeletePostService
{

    private $postRepository;

    public function __construct(PostRepositoryInterface $repository)
    {
        $this->postRepository = $repository;
    }

    public function handle(DeletePost $deletePost)
    {
        $this->validates($deletePost);
        $existingPost = $this->findOrError($deletePost);
        $this->deletePost($deletePost);
        return $existingPost;
    }

    private function validates(DeletePost $deletePost): void
    {
        if ($deletePost->getId() == null) {
            throw new \Exception('Post cannot be empty');
        }
    }

    private function findOrError(DeletePost $deletePost)
    {
        $existingPost = $this->postRepository->getPostById($deletePost->getId());
        if (!$existingPost instanceof Post) {
            throw new \Exception('Post doesnt exists');
        }
        return $existingPost;
    }

    private function deletePost(DeletePost $deletePost): void
    {
        $this->postRepository->deletePost($deletePost->getId());
    }


}