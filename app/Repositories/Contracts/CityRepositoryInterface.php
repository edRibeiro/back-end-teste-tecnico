<?php

namespace App\Repositories\Contracts;

use App\Models\City;

interface CityRepositoryInterface
{
  public function getAll(): array;
  public function findOne(int $id): City|null;
  public function new($dto): City;
  public function update($dto, int $id): City|null;
  public function delete(int $id): void;
}
