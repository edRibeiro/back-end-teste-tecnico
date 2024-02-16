<?php

namespace App\Dtos;

class UserDto
{
  public function __construct(public string $name,  public string $email, public AddressDto $address, public int $id = 0)
  {
  }

  public function toArray(): array
  {
    $attrib = [];
    if ($this->id > 0) {
      $attrib += ['id' => $this->id];
    }
    return $attrib + [
      'name' => $this->name,
      'email' => $this->email,
      'address' => $this->address->toArray()
    ];
  }
}
