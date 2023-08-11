<?php

namespace App\Dto;

use App\Http\Requests\Post\StorePostRequest;

class CreatePost
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

    public function setId(?int $id): CreatePost
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): CreatePost
    {
        $this->title = $title;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): CreatePost
    {
        $this->content = $content;
        return $this;
    }

    public function getCreatedBy(): ?int
    {
        return $this->created_by;
    }

    public function setCreatedBy(int $createdBy): CreatePost
    {
        $this->created_by = $createdBy;
        return $this;
    }

    public static function fromRequest(StorePostRequest $request): self
    {
        $createProduct = new CreatePost();
        $createProduct->setId($request->id);
        $createProduct->setTitle($request->title);
        $createProduct->setContent($request->content);
        $createProduct->setCreatedBy(auth()->user()->id);
        return $createProduct;
    }

}