<?php

namespace App\Repositories\Contracts;

use App\Models\Address;

interface AddressRepositoryInterface
{
  public function findAll(): array;
  public function findOne(int $id): Address|null;
  public function new($dto): Address;
  public function update($dto, int $id): Address|null;
  public function delete(int $id): void;
}
