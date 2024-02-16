<?php

namespace App\Services\Contracts;

use App\Dtos\UserDto;
use App\Models\User;

interface UserServiceInterface
{
  public function findAll(): array;
  public function findOne(int $id): User|null;
  public function new(UserDto $dto): User;
  public function update(UserDto $dto, int $id): User|null;
  public function delete(int $id): void;
}
