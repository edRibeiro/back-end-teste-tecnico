<?php

namespace App\Repositories;

use App\Dtos\UserDto;
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
    return $this->model->with(['address.city.state'])->get()->toArray();
  }

  public function findOne(int $id): User|null
  {
    return $this->model->with(['address.city.state'])->where('id', '=', $id)->first();
  }

  public function new(UserDto $dto): User
  {
    return $this->model->create([
      'name' => $dto->name,
      'email' => $dto->email,
      'address_id' => $dto->address->id,
    ]);
  }

  public function update(UserDto $dto, int $id): User|null
  {
    $user = $this->model->find($id);
    if (!$user) {
      throw new NotFoundHttpException();
    }
    $user->name = $dto->name;
    $user->email = $dto->email;
    $user->address_id = $dto->address->id;
    $user->save();
    return $user->load(['address.city.state']);
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
