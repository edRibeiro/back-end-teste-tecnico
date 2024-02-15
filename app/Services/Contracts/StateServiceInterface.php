<?php

namespace App\Services\Contracts;

use App\Models\State;

interface StateServiceInterface
{
  public function findAll(): array;
  public function findOne(int $id): State|null;
  public function new($dto): State;
  public function update($dto, int $id): State|null;
  public function delete(int $id): void;
}
