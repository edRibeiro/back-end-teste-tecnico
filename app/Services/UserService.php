<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;

class UserService implements UserServiceInterface
{
  public function __construct(protected UserRepositoryInterface $repository)
  {
  }

  public function findAll(): array
  {
    return $this->repository->findAll();
  }

  public function findOne(int $id): User|null
  {
    return $this->repository->findOne($id);
  }

  public function new($dto): User
  {
    return $this->repository->new($dto);
  }

  public function update($dto, int $id): User|null
  {
    return $this->repository->update($dto, $id);
  }

  public function delete(int $id): void
  {
    $this->repository->delete($id);
  }
}
