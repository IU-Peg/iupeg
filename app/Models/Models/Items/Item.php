<?php

namespace App\Models\Models\Items;

use App\Models\Models\Market\MarketItems;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "brand", "description", "active"
    ];

    public function markets_items()
    {
        return $this->hasMany(MarketItems::class, "item_id");
    }
    public function market_items($market_id)
    {
        return $this->hasMany(MarketItems::class, "item_id")->where("market_id", $market_id);
    }
}
