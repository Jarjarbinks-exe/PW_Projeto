<?php

namespace App\Dto;

# TODO ACABAR ESTE DTO
class UserDTO
{
    public string $username;
    public string $email;


    public function __construct(string $username, string $email)
    {
        $this->username = $username;
        $this->email = $email;
    }

    public function toArray() : array
    {
        return [
            'username' => $this->username,
            'email' => $this->email,
        ];
    }
}
