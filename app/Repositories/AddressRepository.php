<?php

namespace App\Repositories;

use App\Models\Address;
use App\Repositories\Contracts\AddressRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AddressRepository implements AddressRepositoryInterface
{
  public function __construct(protected Address $model)
  {
  }

  public function findAll(): array
  {
    return $this->model->with(['city.state'])->get()->toArray();
  }

  public function findOne(int $id): Address|null
  {
    return $this->model->with(['city.state'])->find($id);
  }

  public function new($dto): Address
  {
    return (object) ($this->model->create([
      'street' => $dto->street,
      'number' => $dto->number,
      'complement' => $dto->complement,
      'neighborhood' => $dto->neighborhood,
      'city_id' => $dto->city->id
    ])->load(['city.state']));
  }

  public function update($dto, int $id): Address|null
  {
    $addressData = $this->model->find($id);
    if (!$addressData) {
      throw new NotFoundHttpException();
    }
    $addressData->street = $dto->street;
    $addressData->number = $dto->number;
    $addressData->complement = $dto->complement;
    $addressData->neighborhood = $dto->neighborhood;
    $addressData->city_id = $dto->city->id;
    $addressData->save();
    return $addressData->load(['city.state']);
  }

  public function delete(int $id): void
  {
    $city = $this->model->find($id);
    if (!$city) {
      throw new NotFoundHttpException();
    }
    $city->delete();
  }
}
