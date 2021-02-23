<?php


namespace App\PaymentExamples\Payment;


class PaymentExamples
{

    public function authorize()
    {
        return [
            "capture" => false,
            "reference" => "pedido123",
            "amount" => 2099,
            "cardholderName" => "John Snow",
            "cardNumber" => "5448280000000007",
            "expirationMonth" => 12,
            "expirationYear" => 2028,
            "securityCode" => "235",
        ];
    }

    public function capture(){
        return [
            "transactionID" => "8345000363484052380",
            "amount" => 2099
        ];
    }

    public function cancel()
    {
        return [
            "transactionID" => "8345000363484052380",
            "amount" => 2000,
            "urls" => [
                "kind" => "callback",
                "url" => "https://cliente.callback.com.br"
            ]
        ];
    }

}
