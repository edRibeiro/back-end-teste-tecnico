<?php

namespace App\Services;

use App\Dtos\AddressDto;
use App\Dtos\CityDto;
use App\Dtos\StateDto;
use App\Dtos\UserDto;
use App\Models\User;
use App\Repositories\Contracts\AddressRepositoryInterface;
use App\Repositories\Contracts\CityRepositoryInterface;
use App\Repositories\Contracts\StateRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserService implements UserServiceInterface
{
  public function __construct(
    protected UserRepositoryInterface $userRepository,
    protected AddressRepositoryInterface $addressRepository,
    protected CityRepositoryInterface $cityRepository,
    protected StateRepositoryInterface $stateRepository,
  ) {
  }

  public function findAll(): array
  {
    return $this->userRepository->getAll();
  }

  public function findOne(int $id): User|null
  {
    return $this->userRepository->findOne($id);
  }

  public function new(UserDto $dto): User
  {
    $stateData = $this->stateRepository->new($dto->address->city->state);
    $dto->address->city->state = new StateDto($stateData->name, $stateData->id);
    $cityData = $this->cityRepository->new($dto->address->city);
    $dto->address->city = new CityDto(
      $cityData->name,
      $dto->address->city->state,
      $cityData->id
    );
    $addressData = $this->addressRepository->new($dto->address);
    $dto->address = new AddressDto(
      $addressData->street,
      $addressData->number,
      $addressData->complement,
      $addressData->neighborhood,
      $dto->address->city,
      $addressData->id
    );
    return $this->userRepository->new($dto);
  }

  public function update($dto, int $id): User|null
  {
    $userData = $this->findOne($id);
    if (!$userData) {
      throw new NotFoundHttpException();
    }
    $stateData = $this->stateRepository->findByName($dto->address->city->state->name);
    if (!$stateData) {
      $stateData = $this->stateRepository->new($dto->address->city->state->name);
    }
    $dto->address->city->state = new StateDto($stateData->name, $stateData->id);
    $cityData = $this->cityRepository->findByName($dto->address->city->name);
    if (!$cityData) {
      $cityData = $this->cityRepository->new($dto->address->city);
    }
    $dto->address->city = new CityDto(
      $cityData->name,
      $dto->address->city->state,
      $cityData->id
    );
    $addressData = $this->addressRepository->update($dto->address, $userData->address_id);
    $dto->address = new AddressDto(
      $addressData->street,
      $addressData->number,
      $addressData->complement,
      $addressData->neighborhood,
      $dto->address->city,
      $addressData->id
    );
    return $this->userRepository->update($dto, $id);
  }

  public function delete(int $id): void
  {
    $user = self::findOne($id);
    $this->addressRepository->delete($user->address_id);
    $this->userRepository->delete($id);
  }
}
