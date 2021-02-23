<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Services\Payment\PaymentService;
use Illuminate\Http\Request;
use function Illuminate\Events\queueable;

class PaymentController extends Controller
{
    private $paymentService;
    public function __construct()
    {
        $this->paymentService = new PaymentService();
    }

    public function payment($adquirer, $call){
        $payment_adquirer = $this->paymentService->setAdquirer($adquirer);
        switch ($call){
            case "authorize":
                return $this->paymentService->authorize([], $payment_adquirer);
                break;
            case "capture":
                return $this->paymentService->capture([], $payment_adquirer);
                break;
            case "cancel":
                return $this->paymentService->cancel([], $payment_adquirer);
                break;
        }
    }
}
