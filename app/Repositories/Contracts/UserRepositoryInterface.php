<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
  public function getAll(): array;
  public function findOne(int $id): User|null;
  public function new($dto): User;
  public function update($dto, int $id): User|null;
  public function delete(int $id): void;
}
