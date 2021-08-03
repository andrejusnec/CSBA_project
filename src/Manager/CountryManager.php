<?php

namespace App\Manager;

use App\Repository\CountryRepository;

class CountryManager
{
    private CountryRepository $repository;

    /**
     * @param CountryRepository $repository
     */
    public function __construct(CountryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function allCountries() : array {
        return $this->repository->findAll();
    }
}