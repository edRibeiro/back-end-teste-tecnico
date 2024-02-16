<?php

namespace App\Services;

use App\Models\State;
use App\Repositories\Contracts\StateRepositoryInterface;
use App\Services\Contracts\StateServiceInterface;

class StateService implements StateServiceInterface
{
  public function __construct(protected StateRepositoryInterface $repository)
  {
  }

  public function findAll(): array
  {
    return $this->repository->getAll();
  }

  public function findOne(int $id): State|null
  {
    return $this->repository->findOne($id);
  }

  public function new($dto): State
  {
    return $this->repository->new($dto);
  }

  public function update($dto, int $id): State|null
  {
    return $this->repository->update($dto, $id);
  }

  public function delete(int $id): void
  {
    $this->repository->delete($id);
  }
}
