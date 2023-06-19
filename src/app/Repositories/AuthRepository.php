<?php

namespace App\Repositories;

use App\Helpers\Api as API;
use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{
    private $apiHelper;
    private $userModel;

    public function __construct(API $apiHelper, User $userModel)
    {
        $this->apiHelper = $apiHelper;
        $this->userModel = $userModel;
    }

    public function login($user)
    {
        try {
            /** autenticação **/
            $userAuth = $this->userModel->where('email', $user['email'])->first();

            if (!$userAuth || !Hash::check($user['password'], $userAuth->password)) {
                return $this->apiHelper->response(null, 'er', ["Email ou Senha inválido."]);
            } else {
                $token = $userAuth->createToken($userAuth->email)->plainTextToken;
                return $this->apiHelper->response([
                    'token' => $token,
                    'user' => [
                        'id' => $userAuth->id,
                        'nome' => $userAuth->nome,
                        'sobrenome' => $userAuth->sobrenome,
                        'email' => $userAuth->email,
                    ],
                ]);
            }
        } catch (\Exception $e) {
            return $this->apiHelper->response(null, 'er', null, 500);
        }
    }

    public function logout()
    {
        try {
            auth()->user()->tokens()->delete();
            return $this->apiHelper->response();
        } catch (\Exception $e) {
            return $this->apiHelper->response(null, 'er', null, 500);
        }
    }
}
