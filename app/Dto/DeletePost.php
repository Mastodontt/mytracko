<?php

namespace App\Dto;


class DeletePost
{

    private $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(string $id): DeletePost
    {
        $this->id = $id;
        return $this;
    }

    public static function make(string $id): self
    {
        $self = new self();
        $self->setId($id);
        return $self;
    }
}