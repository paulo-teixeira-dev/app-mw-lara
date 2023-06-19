<?php

namespace App\Interfaces;

interface AuthRepositoryInterface
{
    public function login($user);

    public function logout();

}
