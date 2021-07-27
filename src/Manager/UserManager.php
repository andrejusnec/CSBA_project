<?php


namespace App\Manager;


use App\Repository\UserRepository;

class UserManager
{
    /**
     * ProductAndServicesManager constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
}