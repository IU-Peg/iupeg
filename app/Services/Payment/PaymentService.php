<?php


namespace App\Services\Payment;


use App\Interfaces\Payment\BasePayment;
use App\Interfaces\Payment\IupegAdquirer;
use App\Repositories\Payment\ModelAdquirer;
use App\Repositories\Payment\RedeAdquirer;

class PaymentService implements BasePayment
{

    public $adquirer;

    /**
     * @inheritDoc
     */
    public function authorize($params, IupegAdquirer $adquirer)
    {
        return $adquirer->authorize($params);
    }

    /**
     * @inheritDoc
     */
    public function capture($params, IupegAdquirer $adquirer)
    {
        return $adquirer->capture($params);
    }

    /**
     * @inheritDoc
     */
    public function cancel($params, IupegAdquirer $adquirer)
    {
        return $adquirer->cancel($params);
    }

    public function setAdquirer(string $adquirer){
        switch ($adquirer){
            case "rede":
                $paymentAdquirer = new RedeAdquirer();
                break;
            case "default":
                $paymentAdquirer = new ModelAdquirer();
                break;
        }
        $this->adquirer = $paymentAdquirer;
        return $paymentAdquirer;
    }
}
