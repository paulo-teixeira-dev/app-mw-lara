<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\AuthRepository;
use App\Helpers\Api as API;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $apiHelper;
    private $authRepository;

    public function __construct(API $apiHelper, AuthRepository $authRepository)
    {
        $this->apiHelper = $apiHelper;
        $this->authRepository = $authRepository;
    }

    public function login(Request $request)
    {
        /** validação **/
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255|email',
            'password' => 'required|min:6|max:15',
        ]);

        if ($validator->fails()) {
            return $this->apiHelper->response(null, 'er', $validator->messages()->all());
        }

        return $this->authRepository->login($request->all());
    }

    public function logout()
    {
        return $this->authRepository->logout();
    }
}
