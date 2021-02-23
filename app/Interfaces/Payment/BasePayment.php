<?php


namespace App\Interfaces\Payment;


interface BasePayment
{
    /**
     * Autorizar uma transação
     * @param $params
     * @param IupegAdquirer $adquirer
     * @return mixed
     */
    public function authorize($params, IupegAdquirer $adquirer);

    /**
     * Captura o montante de uma transação autorizada
     * @param $params
     * @param IupegAdquirer $adquirer
     * @return mixed
     */
    public function capture($params, IupegAdquirer $adquirer);

    /**
     * Cancela uma transação realizada
     * @param $params
     * @param IupegAdquirer $adquirer
     * @return mixed
     */
    public function cancel($params, IupegAdquirer $adquirer);
}
