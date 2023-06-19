<?php

namespace App\Http\Controllers;

use App\Interfaces\ProdutoRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Api as ApiHelper;

class ProdutoController extends Controller
{
    private $apiHelper;
    private $produtoRepository;

    public function __construct(ApiHelper $apiHelper, ProdutoRepositoryInterface $produtoRepository)
    {
        $this->apiHelper = $apiHelper;
        $this->produtoRepository = $produtoRepository;
    }

    public function listing()
    {
        return $this->produtoRepository->listing();
    }

    public function store(Request $request)
    {
        /** validação **/
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:100',
            'preco' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'estoque' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->apiHelper->response(null, 'er', $validator->messages()->all());
        }

        return $this->produtoRepository->store($request->all());
    }

    public function show($id)
    {
        return $this->produtoRepository->show($id);
    }

    public function update(Request $request, $id)
    {
        /** validação **/
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:100',
            'preco' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'estoque' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->apiHelper->response(null, 'er', $validator->messages()->all());
        }

        return $this->produtoRepository->update($request->all(), $id);
    }

    public function delete($id)
    {
        return $this->produtoRepository->delete($id);
    }
}
