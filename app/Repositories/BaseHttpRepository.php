<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class BaseHttpRepository {

    /**
        * Esta classe tem como objetivo ser a base para qualquer repositório criado.
        * Para utilizala basta extendê-la em seu novo repositório
     **/


    protected function get($url, $headers = [], $body = []){
        return $this->http('get', $url, $headers, $body);
    }

    protected function post($url, $headers = [], $body = []){
        return $this->http('post', $url, $headers, $body);
    }

    protected function put($url, $headers = [], $body = []){
        return $this->http('put', $url, $headers, $body);
    }

    private function http($method, $url, $headers, $body){
        $headers['Accept'] = 'application/json';
        $headers['content-type'] = 'application/json';
        return Http::withHeaders($headers)->{$method}($url, $body);
    }

    protected function return_response($response){
        $return_response['code'] = $response->status();

        $response->successful() ? $return_response['body'] = $response->json()  : $return_response['message'] = $response->getReasonPhrase();

        return $return_response;
    }
}
