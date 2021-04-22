<?php


namespace App\Interfaces\Cart;


use App\Interfaces\Items\BaseItem;

interface IupegCart
{
    public function addItem(BaseItem $baseItem);
    public function removeItem(BaseItem $baseItem);
    public function getItems();
}
