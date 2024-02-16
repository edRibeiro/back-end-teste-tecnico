<?php

namespace App\Repositories\Contracts;

use App\Dtos\UserDto;
use App\Models\User;

interface UserRepositoryInterface
{
  public function getAll(): array;
  public function findOne(int $id): User|null;
  public function new(UserDto $dto): User;
  public function update(UserDto $dto, int $id): User|null;
  public function delete(int $id): void;
}
