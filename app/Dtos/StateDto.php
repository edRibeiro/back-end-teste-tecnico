<?php

namespace App\Dtos;

class StateDto
{
  public function __construct(public string $name, public int $id = 0)
  {
  }

  public function toArray(): array
  {
    $attrib = [];
    if ($this->id > 0) {
      $attrib += ['id' => $this->id];
    }
    return $attrib + [
      'name' => $this->name
    ];
  }
}
