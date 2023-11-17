<?php

namespace App\Dto;

# TODO ACABAR ESTE DTO
class UserDTO
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function toArray() : array
    {
        return [
            'name' => $this->name
        ];
    }
}
