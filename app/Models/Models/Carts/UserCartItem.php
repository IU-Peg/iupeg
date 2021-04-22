<?php

namespace App\Models\Models\Carts;

use App\Models\Models\Market\MarketItems;
use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCartItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "user_cart_id", "user_id", "market_item_id"
    ];

    public function user_cart()
    {
        return $this->belongsTo(UserCart::class, "user_cart_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function market_item(){
        return $this->belongsTo(MarketItems::class, "market_item_id");
    }

    public function countItem($market_item_id)
    {
        return UserCartItem::query()
            ->where("user_cart_id", $this->id)
            ->where("market_item_id", $market_item_id)
            ->count();
    }

    public function totalItem($market_item_id)
    {
        return 10;
    }
}
