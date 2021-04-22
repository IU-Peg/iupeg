<?php


namespace App\Services\Cart;

use Gloudemans\Shoppingcart\Cart;
use Illuminate\Support\Str;
use Illuminate\Session\SessionManager;
use Illuminate\Events\Dispatcher;

class CartService
{
    private $cartInstance;
    private $instanceUuid;

    public function createCart($user_id){
        $uuid = Str::uuid();
        $this->cartInstance = \Cart::instance($uuid);
        $this->cartInstance->store($user_id);
        $this->instanceUuid = $uuid;
        return $this;
    }

    public function getCart($instanceUuid, $user_id)
    {
        $this->cartInstance = \Cart::instance($instanceUuid);
//        $this->cartInstance->restore($user_id);
        $this->instanceUuid = $instanceUuid;
        return $this;
    }

    public function removeCart($instanceUuid, $user_id)
    {
        $this->getCart($instanceUuid, $user_id);
        $this->cartInstance->erase($user_id);
        return $this;
    }

    public function addItem($item)
    {
        $this->cartInstance->add([$item]);
        return $this;
    }

    public function removeItem($itemId)
    {
        $this->cartInstance->remove($itemId);
        return $this;
    }

    public function updateQuantity($itemId, int $quantity)
    {
        $this->cartInstance->update($itemId, $quantity);
        return $this;
    }

    public function getInstanceUuid(){
        return $this->instanceUuid;
    }

    public function getTotal()
    {
        return $this->cartInstance->total();
    }

    public function getItems()
    {
        return $this->cartInstance->content();
    }
}
