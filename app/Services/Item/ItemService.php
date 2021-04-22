<?php


namespace App\Services\Item;


use App\Models\Models\Items\Item;

class ItemService
{

    public function addItem($item_data)
    {
        return Item::query()->create($item_data);
    }

}
