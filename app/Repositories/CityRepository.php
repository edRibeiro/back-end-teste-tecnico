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

  public function findAll(): array
  {
    return $this->model->with(['state'])->get()->toArray();
  }
  public function findOne(int $id): City|null
  {
    return $this->model->with(['state'])->find($id);
  }

  public function new($dto): City
  {
    return ($this->model->firstOrCreate(['name' => $dto->name], ['state_id' => $dto->state->id]))->load(['state']);
  }

  public function update($dto, int $id): City|null
  {
    $city = $this->model->find($id);
    if (!$city) {
      throw new NotFoundHttpException();
    }
    $city->fill($dto)->save();
    return $this->model->load(['state']);
  }
  public function delete(int $id): void
  {
    $city = $this->model->find($id);
    if (!$city) {
      throw new NotFoundHttpException();
    }
    $city->delete();
  }

  public function findByName(string $name): City|null
  {
    return $this->model->with(['state'])->where('name', '=', $name)->first();
  }
}
