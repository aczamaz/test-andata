<?php

namespace App\Utils;

trait Response
{
    public function response(array $data, int $code, bool $status = true): string
    {
        http_response_code($code);
        $response = ['data' => $data, 'success'=> $status, 'code' => $code];
        return print_r(json_encode($response));
    }
}