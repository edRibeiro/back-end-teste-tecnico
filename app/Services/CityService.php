<?php

namespace App\Services;

use App\Models\City;
use App\Repositories\Contracts\CityRepositoryInterface;
use App\Services\Contracts\CityServiceInterface;

class CityService implements CityServiceInterface
{
  public function __construct(protected CityRepositoryInterface $repository)
  {
  }

  public function findAll(): array
  {
    return $this->repository->findAll();
  }

  public function findOne(int $id): City|null
  {
    return $this->repository->findOne($id);
  }

  public function new($dto): City
  {
    return $this->repository->new($dto);
  }

  public function update($dto, int $id): City|null
  {
    return $this->repository->update($dto, $id);
  }

  public function delete(int $id): void
  {
    $this->repository->delete($id);
  }
}
