<?php


namespace App\Repositories\ERP;


use App\Repositories\BaseHttpRepository;

class OmieRepository extends BaseHttpRepository
{
    private $body = [];
    public function setAuth($app_key, $app_secret){
        $auth_params["app_key"] = $app_key;
        $auth_params["app_secret"] = $app_secret;
        $this->setParams($auth_params);
        return $this;
    }

    public function setParams($params)
    {
        $this->body += $params;
    }

    public function getProduct($product_code)
    {
        $url = "https://app.omie.com.br/api/v1/geral/produtos/";

        $this->body["call"] = "ConsultarProduto";
        $this->body["param"] = [
            ["codigo_produto" => $product_code]
        ];
        return $this->return_response($this->post($url, [], $this->body));
    }

    public function getProducts($params = [])
    {
        $url = "https://app.omie.com.br/api/v1/geral/produtos/";

        $this->body["call"] = "ListarProdutos";
        $this->body["param"] = [
            [
                "pagina"=> $params["pagina"] ?? 1,
                "registros_por_pagina"=> $params["registros_por_pagina"] ?? 50,
                "apenas_importado_api"=> "N",
                "filtrar_apenas_omiepdv" => "N"
            ]
        ];
        return $this->return_response($this->post($url, [], $this->body));

    }
    public function teste()
    {

        $product = [
            "codigo_produto" => 385532243,
            "codigo_produto_integracao" => "385532243",
            "codigo" => "",
            "descricao" => "Produto de teste 153",
            "unidade" => "UN",
            "valor_unitario" => 12.87,
            "peso_liq" => 1.05,
            "marca" => "São João",
        ];

        return response()->json(["product" => $product], 200);
    }
}
