<?php

namespace App\Dtos;

class AddressDto
{
  public function __construct(
    public string $street,
    public string $number,
    public string $complement,
    public string $neighborhood,
    public CityDto $city,
    public int $id = 0
  ) {
  }

  public function toArray(): array
  {
    $attrib = [];
    if ($this->id > 0) {
      $attrib += ['id' => $this->id];
    }
    return $attrib + [
      'street' => $this->street,
      'number' => $this->number,
      'complement' => $this->complement,
      'neighborhood' => $this->neighborhood,
      'city' => $this->city->toArray()
    ];
  }
}
