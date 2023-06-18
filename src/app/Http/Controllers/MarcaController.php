<?php

namespace App\Http\Controllers;

use App\Interfaces\MarcaRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Api as ApiHelper;

class MarcaController extends Controller
{
    private $apiHelper;
    private $marcaRepository;

    public function __construct(ApiHelper $apiHelper, MarcaRepositoryInterface $marcaRepository)
    {
        $this->apiHelper = $apiHelper;
        $this->marcaRepository = $marcaRepository;
    }

    public function listing()
    {
        return $this->marcaRepository->listing();
    }
}
