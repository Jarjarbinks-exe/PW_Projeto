<?php

namespace App\Dto;

class UserDTO
{
    public string $username;
    public string $password;
    public string $email;
    public string $created_at;
    public string $updated_at;

    public function __construct(string $username, string $password, string $email)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->created_at = now();
        $this->updated_at = now();
    }

    public function toArray() : array
    {
        return [
            'username' => $this->username,
            'password' => $this->password,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
