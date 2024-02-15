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

  public function getAll(): array
  {
    return $this->model->get()->toArray();
  }

  public function findOne(int $id): Address|null
  {
    return $this->model->findOne($id);
  }

  public function new($dto): Address
  {
    $this->model->fill($dto)->save();
    return $this->model;
  }

  public function update($dto, int $id): Address|null
  {
    $city = $this->model->findOne($id);
    if (!$city) {
      throw new NotFoundHttpException();
    }
    $city->fill($dto)->save();
    return $this->model;
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
