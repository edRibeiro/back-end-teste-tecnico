<?php

namespace App\Repositories\Contracts;

use App\Models\State;

interface StateRepositoryInterface
{
  public function getAll(): array;
  public function findOne(int $id): State|null;
  public function new($dto): State;
  public function update($dto, int $id): State|null;
  public function delete(int $id): void;
  public function findByName(string $name): State|null;
}
