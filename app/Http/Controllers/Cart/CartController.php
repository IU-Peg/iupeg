<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Models\Carts\UserCartItem;
use App\Services\Cart\CartService;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;

class CartController extends Controller
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function create_cart(Request $request)
    {
        $user_id = $request->user_id;

        if($this->cartService->createCart($user_id)){
            return response()->json([
                "success" => "Carrinho criado com sucesso",
                "instance" => $this->cartService->getInstanceUuid()
            ]);
        }else{
            return response()->json(["error" => "Não foi possível criar o carrinho"]);
        }
    }

    public function get_cart(Request $request){
        $user_id = $request->user_id;

        if($this->cartService->getCart($request->instance, $user_id)){
            return response()->json([
                "success" => "Carrinho obtido com sucesso",
                "instance" => $this->cartService->getInstanceUuid()
            ]);
        }else{
            return response()->json(["error" => "Não foi possível obter o carrinho"]);
        }
    }

    public function remove_cart(Request $request)
    {
        if($this->cartService->removeCart($request->instance, $request->user_id)){
            return response()->json(["success" => "Carrinho removido com sucesso"]);
        }else{
            return response()->json(["error" => "Não foi possível remover o carrinho"]);
        }
    }

    public function add_item(Request $request)
    {
        $this->cartService->getCart($request->instance, $request->user_id);
        if($this->cartService->addItem($request->item)){
            return response()->json(["success" => "Item adicionado com sucesso"]);
        }else{
            return response()->json(["error" => "Não foi possível obter o carrinho"]);
        }
    }

    public function teste(Request $request){
        return response()->json(["success" => "ok"]);
    }
}
