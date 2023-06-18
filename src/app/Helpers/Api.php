<?php

namespace App\Helpers;

class Api
{
    public function response($data = null, $statusCode = 'sc', $message = null, $statusResponse = 200)
    {
        if (empty($data) && $statusCode == "sc" && empty($message))
            $message = ['operação realizada com sucesso.'];

        else if ($statusCode == "nf" && empty($message))
            $message = ['não encontrado.'];

        else if ($statusCode == "er" && empty($message) && $statusResponse == 500)
            $message = ['sistema indisponível.'];

        return response()->json(['status' => $this->getStatus($statusCode), 'message' => $message, 'data' => $data], $statusResponse);
    }

    public function getStatus($status)
    {
        switch ($status) {
            case 'sc':
                return 'success';
            case 'er':
                return 'error';
            case 'nf':
                return 'not-found';
            default:
                return null;
        }
    }
}
