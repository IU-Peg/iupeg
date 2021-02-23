<?php


namespace App\Repositories\Payment;


use App\Interfaces\Payment\IupegAdquirer;
use App\Repositories\BaseHttpRepository;

class ModelAdquirer extends BaseHttpRepository implements IupegAdquirer
{

    /**
     * @inheritDoc
     */
    public function authorize($params = [])
    {
        return [
            "adquirer" => "EXEMPLO ADQUIRER",
            "reference" => "pedido123",
            "tid" => "8345000363484052380",
            "nsu"  => "663206341",
            "authorizationCode"  => "186376",
            "dateTime"  => "2017-02-28T08=>54=>00.000-03=>00",
            "amount"  => 2099,
            "cardBin"  => "544828",
            "last4"  => "0007",
            "returnCode"  => "00",
            "returnMessage"  => "Success.",
            "links"  => [
                [
                    "method" => "GET",
                  "rel" => "transaction",
                  "href" => "https=>// api.userede.com.br/erede/v1/transactions/8345000363484052380"
                ],
                [
                    "method" => "PUT",
                  "rel" => "capture",
                  "href" => "https=>// api.userede.com.br/erede/v1/transactions/8345000363484052380"
                ],
                [
                    "method" => "POST",
                  "rel" => "refund",
                  "href" => "https=>// api.userede.com.br/erede/v1/transactions/8345000363484052380/refunds"
                ]
            ]
        ];
    }

    /**
     * @inheritDoc
     */
    public function capture($params = [])
    {
        return [
            "adquirer" => "EXEMPLO ADQUIRER",
            "reference" => "pedido123",
            "tid" => "8345000363484052380",
            "nsu" => "7648531",
            "authorizationCode" => "186376",
            "dateTime" => "2017-02-28T08=>54=>00.000-03=>00",
            "returnCode" => "00",
            "returnMessage" => "Success.",
            "links" => [
                [
                    "method"=> "GET",
                "rel"=> "transaction",
                "href"=> "https=>//api.userede.com.br/erede/v1/transactions/9274256037511432483"
                ],
                [
                    "method"=> "POST",
                    "rel"=> "refund",
                    "href"=> "https=>//api.userede.com.br/erede/v1/transactions/9274256037511432483/refunds"
                ]
            ]
        ];

    }

    /**
     * @inheritDoc
     */
    public function cancel($params = [])
    {
        return  [
            "adquirer" => "EXEMPLO ADQUIRER",
            "refundId" => "d21c0fa9-aa0f-4b9f-aedc-a1d4ed08e03d",
            "tid" => "9274256037511432483",
            "nsu" => "750004939",
            "refundDateTime" => "2017-02-11T08:45:00.000-03:00",
            "cancelId" => "786524681",
            "returnCode" => "360",
            "returnMessage" => "Refund request has been successful",
            "links" => [
                [
                    "method" => "GET",
                    "rel" => "refund",
                    "href" => "https://api.userede.com.br/erede/v1/transactions/9274256037511432483/refunds/5938e353-a6e7-430f-bac3-869acf1e7665"
                ],
                [
                    "method" => "GET",
                    "rel" => "transaction",
                    "href" => "https://api.userede.com.br/erede/v1/transactions/9274256037511432483"
                ],
                [
                    "method" => "GET",
                    "rel" => "refunds",
                    "href" => "https://api.userede.com.br/erede/v1/transactions/9274256037511432483/refunds"
                ]
            ]
        ];

    }
}
