<?php


namespace App\Interfaces\Payment;


interface IupegAdquirer
{

    /**
     * Autorizar uma transação
     * @param array $params
     * @return mixed
     */
    public function authorize($params = []);

    /**
     * Captura o montante de uma transação autorizada
     * @param array $params
     * @return mixed
     */
    public function capture($params = []);

    /**
     * Cancela uma transação realizada
     * @param array $params
     * @return mixed
     */
    public function cancel($params = []);
}
