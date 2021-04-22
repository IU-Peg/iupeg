<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class BaseHttpRepository {

    /**
        * Esta classe tem como objetivo ser a base para qualquer repositório criado.
        * Para utilizala basta extendê-la em seu novo repositório
     **/


    private $defaultResponse;
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

    protected function return_response($response)
    {
        $this->response = $response;
        $return_response['code'] = $response->status();

        if($response->successful())
            $return_response['body'] = $response->json();
        else {
            $error_header = $response->headers();
            if(isset($error_header["OmieAPI-Error"][0]))
                $return_response['message'] = $error_header["OmieAPI-Error"][0];
            else
                $return_response['message'] = $response->getReasonPhrase();

        }

        $this->makeDefaultResponse($return_response);
        return $return_response;
    }

    public function makeDefaultResponse($response)
    {
        $this->defaultResponse = $response;
    }

    public function getCode(): int
    {
        return $this->defaultResponse['code'];
    }

    public function getBody(): array
    {
        return $this->defaultResponse['body'];
    }

    public function getError() : string
    {
        return $this->defaultResponse['message'] ?? "";
    }
}
