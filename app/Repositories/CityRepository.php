<?php

namespace App\Repositories;

use App\Models\City;
use App\Repositories\Contracts\CityRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CityRepository implements CityRepositoryInterface
{
  public function __construct(protected City $model)
  {
  }

  public function getAll(): array
  {
    return $this->model->get()->toArray();
  }
  public function findOne(int $id): City|null
  {
    return $this->model->findOne($id);
  }
  public function new($dto): City
  {
    $this->model->fill($dto)->save();

    return $this->model;
  }
  public function update($dto, int $id): City|null
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
