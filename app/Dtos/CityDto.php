<?php

namespace App\Dtos;

class CityDto
{
  public function __construct(public string $name, public StateDto $state, public int $id = 0)
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
      'address' => $this->state->toArray()
    ];
  }
}
