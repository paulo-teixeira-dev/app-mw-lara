<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Api as API;

class UserController extends Controller
{
    private $apiHelper;
    private $userRepository;

    public function __construct(API $apiHelper, UserRepositoryInterface $userRepository)
    {
        $this->apiHelper = $apiHelper;
        $this->userRepository = $userRepository;
    }

    public function store(Request $request)
    {
        /** validação **/
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:100',
            'sobrenome' => 'required|max:100',
            'email' => 'required|max:255|email|unique:App\Models\User,email',
            'email_confirmation' => 'required|max:255|email|same:user.email',
            'password' => 'required|min:6|max:15',
            'password_confirmation' => 'required|min:6|max:15|same:user.password',
        ]);

        if ($validator->fails()) {
            return $this->apiHelper->response(null, 'er', $validator->messages()->all());
        }

        return $this->userRepository->store($request->all());
    }
}
