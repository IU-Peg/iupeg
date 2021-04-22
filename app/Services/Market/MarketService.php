<?php


namespace App\Services\Market;


use App\Models\Models\Items\Item;
use App\Models\Models\Market\Market;
use App\Models\Models\Market\MarketItems;

class MarketService
{
    public function addMarket($market_data){
        return Market::query()->create($market_data);
    }

    public function addOrUpdateMarketItem($market_id, $item_id, $item_data){
        return MarketItems::query()->updateOrCreate([
            "market_id" => $market_id,
            "item_id" => $item_id
        ],
        $item_data);
    }

}
