<?php

namespace App\Repositories;

use App\Helpers\Api as API;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    private $apiHelper;
    private $userModel;

    public function __construct(API $apiHelper, User $userModel)
    {
        $this->apiHelper = $apiHelper;
        $this->userModel = $userModel;
    }

    public function store($user)
    {
        DB::beginTransaction();
        try {
            /** criação **/
            $this->userModel->create($user);

            DB::commit();
            return $this->apiHelper->response();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->apiHelper->response(null, 'er', null, 500);
        }
    }
}
