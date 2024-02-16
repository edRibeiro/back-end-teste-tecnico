<?php

namespace App\Dtos;

class UserDtoFactory
{
  public static function makeFromArray(array $request): UserDto
  {

    $stateDto = new StateDto($request['address']['city']['state']['name']);
    $cityDTO = new CityDTO($request['address']['city']['name'], $stateDto);
    $addressDTO = new AddressDTO(
      $request['address']['street'],
      $request['address']['number'],
      $request['address']['complement'],
      $request['address']['neighborhood'],
      $cityDTO
    );
    $userDTO = new UserDTO($request['name'], $request['email'], $addressDTO, $request['id'] ?? 0);
    return $userDTO;
  }
}
