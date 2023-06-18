<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Helpers\Api as ApiHelper;
use App\Interfaces\EletroRepositoryInterface;
use App\Models\Eletro;

class EletroRepository implements EletroRepositoryInterface
{
    private $apiHelper;
    private $eletroModel;

    public function __construct(ApiHelper $apiHelper, Eletro $eletroModel)
    {
        $this->apiHelper = $apiHelper;
        $this->eletroModel = $eletroModel;
    }

    public function listing()
    {
        try {
            $eletro = $this->eletroModel->all();
            return $this->apiHelper->response($eletro);
        } catch (\Exception $e) {
            return $this->apiHelper->response($e->getMessage(), 'er', null, 500);
        }
    }

    public function store($eletro)
    {
        DB::beginTransaction();
        try {
            /** criação **/
            $this->eletroModel->create($eletro);
            DB::commit();
            return $this->apiHelper->response();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->apiHelper->response(null, 'er', null, 500);
        }
    }

    public function show($id)
    {
        try {
            $eletro = $this->eletroModel->where('id', $id)->with(['Marca'])->first();
            if ($eletro)
                return $this->apiHelper->response($eletro);
            else
                return $this->apiHelper->response(null, 'nf');
        } catch (\Exception $e) {
            return $this->apiHelper->response($e->getMessage(), 'er', null, 500);
        }
    }

    public function update($eletro, $id)
    {
        DB::beginTransaction();
        try {
            /** atualização **/
            $eletroUpdate = $this->eletroModel->find($id);

            if (!$eletroUpdate)
                return $this->apiHelper->response(null, 'nf');

            $eletroUpdate->update($eletro);
            DB::commit();
            return $this->apiHelper->response();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->apiHelper->response(null, 'er', null, 500);
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            /** delete **/
            $eletro = $this->eletroModel->find($id);

            if (!$eletro)
                return $this->apiHelper->response(null, 'nf');

            $eletro->delete();
            DB::commit();
            return $this->apiHelper->response();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->apiHelper->response(null, 'er', null, 500);
        }
    }
}
