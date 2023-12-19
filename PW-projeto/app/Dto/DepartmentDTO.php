<?php

namespace App\Dto;

class DepartmentDTO
{

    public string $created_at;
    public string $updated_at;
    public string $name;

    public function __construct(string $name)
    {
        $this->created_at = now();
        $this->updated_at = now();
        $this->name = $name;
    }

    public function toArray(): array
    {
        return [
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'name' => $this->name,
        ];
    }
}
