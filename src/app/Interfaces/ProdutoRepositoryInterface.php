<?php

namespace App\Interfaces;

interface ProdutoRepositoryInterface
{
    public function listing();

    public function store($request);

    public function show($id);

    public function update($request, $id);

    public function delete($id);
}
