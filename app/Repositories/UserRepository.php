<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserRepository implements UserRepositoryInterface
{
  public function __construct(protected User $model)
  {
  }

  public function getAll(): array
  {
    return $this->model->get()->toArray();
  }

  public function findOne(int $id): User|null
  {
    return $this->model->findOne($id);
  }

  public function new($dto): User
  {
    $this->model->fill($dto)->save();
    return $this->model;
  }

  public function update($dto, int $id): User|null
  {
    $user = $this->model->findOne($id);
    if (!$user) {
      throw new NotFoundHttpException();
    }
    $user->fill($dto)->save();
    return $this->model;
  }

  public function delete(int $id): void
  {
    $user = $this->model->find($id);
    if (!$user) {
      throw new NotFoundHttpException();
    }
    $user->delete();
  }
}
