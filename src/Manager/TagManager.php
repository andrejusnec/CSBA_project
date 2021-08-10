<?php

namespace App\Manager;

use App\Entity\Tag;
use App\Repository\TagRepository;
use Doctrine\ORM\QueryBuilder;

class TagManager
{
    private TagRepository $repository;

    public function __construct(TagRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllTags(): array
    {
        return $this->repository->findAll();
    }

    public function getTag($tag_id): ?Tag
    {
        return $this->repository->find($tag_id);
    }
}