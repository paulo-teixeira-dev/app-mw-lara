<?php

namespace App\Http\Controllers;

use App\Interfaces\EletroRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Api as ApiHelper;

class EletroController extends Controller
{
    private $apiHelper;
    private $eletroRepository;

    public function __construct(ApiHelper $apiHelper, EletroRepositoryInterface $eletroRepository)
    {
        $this->apiHelper = $apiHelper;
        $this->eletroRepository = $eletroRepository;
    }

    public function listing()
    {
        return $this->eletroRepository->listing();
    }

    public function store(Request $request)
    {
        /** validação **/
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:100',
            'descricao' => 'required',
            'tensao' => 'required|integer',
            'marca_id' => 'required|integer|exists:App\Models\Marca,id',
        ]);

        if ($validator->fails()) {
            return $this->apiHelper->response(null, 'er', $validator->messages()->all());
        }

        return $this->eletroRepository->store($request->all());
    }

    public function show($id)
    {
        return $this->eletroRepository->show($id);
    }

    public function update(Request $request, $id)
    {
        /** validação **/
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:100',
            'descricao' => 'required',
            'tensao' => 'required|integer',
            'marca_id' => 'required|integer|exists:App\Models\Marca,id',
        ]);

        if ($validator->fails()) {
            return $this->apiHelper->response(null, 'er', $validator->messages()->all());
        }

        return $this->eletroRepository->update($request->all(), $id);
    }

    public function delete($id)
    {
        return $this->eletroRepository->delete($id);
    }
}
