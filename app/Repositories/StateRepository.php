<?php

namespace App\Repositories;

use App\Models\State;
use App\Repositories\Contracts\StateRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StateRepository implements StateRepositoryInterface
{
  public function __construct(private State $model)
  {
  }

  public function getAll(): array
  {
    return $this->model->get()->toArray();
  }

  public function findOne(int $id): State|null
  {
    return $this->model->findOne($id);
  }

  public function new($dto): State
  {
    $this->model->fill($dto)->save();
    return $this->model;
  }

  public function update($dto, int $id): State|null
  {
    $state = $this->model->findOne($id);
    if (!$state) {
      throw new NotFoundHttpException();
    }
    $state->fill($dto)->save();
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
}
