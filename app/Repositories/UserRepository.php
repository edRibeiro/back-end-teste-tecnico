<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
  public function __construct(User $user)
  {
  }

  public function getAll(): array
  {
    return null;
  }

  public function findOne(int $id): User|null
  {
    return null;
  }

  public function new($dto): User
  {
    return null;
  }

  public function update($dto, int $id): User|null
  {
    return null;
  }

  public function delete(int $id): void
  {
  }
}
