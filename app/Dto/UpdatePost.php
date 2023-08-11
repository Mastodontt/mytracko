<?php

namespace App\Dto;

use App\Http\Requests\Post\UpdatePostRequest;

class UpdatePost
{
    private $id;

    private $title;

    private $content;

    private $created_by;

    public static function make(string $title,string $content,int $createdBy): self
    {
        $createProduct = new self();
        $createProduct->setTitle($title);
        $createProduct->setContent($content);
        $createProduct->setCreatedBy($createdBy);
        return $createProduct;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): UpdatePost
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): UpdatePost
    {
        $this->title = $title;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): UpdatePost
    {
        $this->content = $content;
        return $this;
    }

    public function getCreatedBy(): ?int
    {
        return $this->created_by;
    }

    public function setCreatedBy(int $createdBy): UpdatePost
    {
        $this->created_by = $createdBy;
        return $this;
    }

    public static function fromRequest(UpdatePostRequest $request,int $id): self
    {
        $updatePost = new UpdatePost();
        $updatePost->setId($id);
        $updatePost->setTitle($request->title);
        $updatePost->setContent($request->content);
        $updatePost->setCreatedBy(auth()->user()->id);
        return $updatePost;
    }

}