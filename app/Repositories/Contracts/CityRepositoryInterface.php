<?php

namespace App\Repositories\Contracts;

use App\Models\City;

interface CityRepositoryInterface
{
  public function findAll(): array;
  public function findOne(int $id): City|null;
  public function new($dto): City;
  public function update($dto, int $id): City|null;
  public function delete(int $id): void;
  public function findByName(string $name): City|null;
}
