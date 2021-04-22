<?php

namespace App\Models\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketAPI extends Model
{
    use HasFactory;

    protected $table = "market_apis";
    protected $fillable = [
        "market_id", "api_name", "api_key", "api_secret", "api_type"
    ];

    public function market()
    {
        return $this->belongsTo(Market::class, "market_id");
    }
}
