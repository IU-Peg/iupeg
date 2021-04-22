<?php

namespace App\Models\Models\Market;

use App\Models\Models\Items\Item;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarketItems extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "market_id", "item_id", "marketplace_id", "ean", "unit_price", "stock", "active"
    ];

    public function market()
    {
        return $this->belongsTo(Market::class, "market_id");
    }

    public function item()
    {
        return $this->belongsTo(Item::class, "item_id");
    }
}
