<?php

namespace App\Services\Contracts;

use App\Models\User;

interface UserServiceInterface
{
  public function findAll(): array;
  public function findOne(int $id): User|null;
  public function new($dto): User;
  public function update($dto, int $id): User|null;
  public function delete(int $id): void;
}
