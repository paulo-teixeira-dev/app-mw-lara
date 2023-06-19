<?php

namespace App\Repositories;

use App\Helpers\Api as API;
use App\Interfaces\ProdutoRepositoryInterface;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class ProdutoRepository implements ProdutoRepositoryInterface
{
    private $apiHelper;
    private $produtoModel;

    public function __construct(API $apiHelper, Produto $produtoModel)
    {
        $this->apiHelper = $apiHelper;
        $this->produtoModel = $produtoModel;
    }

    public function listing()
    {
        try {
            $produto = $this->produtoModel->all();
            return $this->apiHelper->response($produto);
        } catch (\Exception $e) {
            return $this->apiHelper->response($e->getMessage(), 'er', null, 500);
        }
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            /** criação **/
            $this->produtoModel->create($request);

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
            $produto = $this->produtoModel->where('id', $id)->first();
            if ($produto)
                return $this->apiHelper->response($produto);
            else
                return $this->apiHelper->response(null, 'nf');
        } catch (\Exception $e) {
            return $this->apiHelper->response($e->getMessage(), 'er', null, 500);
        }
    }

    public function update($prod, $id)
    {
        DB::beginTransaction();
        try {
            /** atualização **/
            $produto = $this->produtoModel->find($id);

            if (!$produto)
                return $this->apiHelper->response(null, 'nf');

            $produto->update($prod);
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
            /** atualização **/
            $produto = $this->produtoModel->find($id);

            if (!$produto)
                return $this->apiHelper->response(null, 'nf');

            $produto->update(['ativo' => false]);
            DB::commit();
            return $this->apiHelper->response();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->apiHelper->response(null, 'er', null, 500);
        }
    }
}
