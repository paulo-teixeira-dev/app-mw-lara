<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\Api as ApiHelper;
use App\Interfaces\MarcaRepositoryInterface;
use App\Models\Marca;

class MarcaRepository implements MarcaRepositoryInterface
{
    private $apiHelper;
    private $marcaModel;

    public function __construct(ApiHelper $apiHelper, Marca $marcaModel)
    {
        $this->apiHelper = $apiHelper;
        $this->marcaModel = $marcaModel;
    }

    public function listing()
    {
        try {
            $marca = $this->marcaModel->all();
            return $this->apiHelper->response($marca);
        } catch (\Exception $e) {
            return $this->apiHelper->response($e->getMessage(), 'er', null, 500);
        }
    }
}
