<?php

namespace App\Services\Contracts;

use App\Models\City;

interface CityServiceInterface
{
  public function findAll(): array;
  public function findOne(int $id): City|null;
  public function new($dto): City;
  public function update($dto, int $id): City|null;
  public function delete(int $id): void;
}
