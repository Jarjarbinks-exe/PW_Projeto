<?php

namespace App\Dto;

class DocumentDTO
{

    public string $created_at;
    public string $updated_at;
    public int $user_id;
    public string $file_path;

    public function __construct(int $user_id, string $file_path)
    {
        $this->created_at = now();
        $this->updated_at = now();
        $this->user_id = $user_id;
        $this->file_path = $file_path;
    }

    public function toArray(): array
    {
        return [
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
            'file_path' => $this->file_path,

        ];
    }
}
