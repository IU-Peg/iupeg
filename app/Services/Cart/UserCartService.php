<?php


namespace App\Services\Cart;


use App\Models\Models\Carts\UserCart;
use App\Models\Models\Carts\UserCartItem;

class UserCartService
{
    public function createorRetrieveCart($user_id, $market_id)
    {
        return UserCart::query()->whereIn("status", ["BUYING", "PAYING"])->firstOrCreate([
            "user_id" => $user_id,
            "market_id" => $market_id,
        ]);
    }

    public function addCartItem($userCart, $market_item_id){
        return UserCartItem::query()->create([
            "user_cart_id" => $userCart->id,
            "user_id" => $userCart->user_id,
            "market_item_id" => $market_item_id,
        ]);
    }

    public function removeCartItem($user_cart_item_id)
    {
        UserCartItem::query()->find($user_cart_item_id)->delete();
    }

    public function getCartItems($user_cart_id){
        return UserCartItem::query()->where("user_cart_id", $user_cart_id)->get();
    }
}
