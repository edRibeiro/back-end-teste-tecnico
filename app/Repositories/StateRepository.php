<?php

namespace App\Repositories;

use App\Models\State;
use App\Repositories\Contracts\StateRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StateRepository implements StateRepositoryInterface
{
  public function __construct(protected State $model)
  {
  }

  public function getAll(): array
  {
    return $this->model->get()->toArray();
  }

  public function findOne(int $id): State|null
  {
    return $this->model->find($id);
  }

  public function new($dto): State
  {
    return $this->model->firstOrCreate(['name' => $dto->name]);
  }

  public function update($dto, int $id): State|null
  {
    $state = $this->model->find($id);
    if (!$state) {
      throw new NotFoundHttpException();
    }
    $state->firstOrCreate($dto)->save();
    return $this->model;
  }

  public function delete(int $id): void
  {
    $state = $this->model->find($id);
    if (!$state) {
      throw new NotFoundHttpException();
    }
    $state->delete();
  }

  public function findByName(string $name): State|null
  {
    return $this->model->where('name', '=', $name)->first();
  }
}
