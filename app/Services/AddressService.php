<?php

namespace App\Services;

use App\Models\Address;
use App\Repositories\Contracts\AddressRepositoryInterface;
use App\Services\Contracts\AddressServiceInterface;

class AddressService implements AddressServiceInterface
{
  public function __construct(protected AddressRepositoryInterface $repository)
  {
  }

  public function findAll(): array
  {
    return $this->repository->findAll();
  }

  public function findOne(int $id): Address|null
  {
    return $this->repository->findOne($id);
  }

  public function new($dto): Address
  {
    return $this->repository->new($dto);
  }

  public function update($dto, int $id): Address|null
  {
    return $this->repository->update($dto, $id);
  }

  public function delete(int $id): void
  {
    $this->repository->delete($id);
  }
}
