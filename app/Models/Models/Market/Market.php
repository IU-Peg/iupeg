<?php

namespace App\Models\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Market extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name", "cnpj", "website", "active"
    ];

    public function market_items()
    {
        return $this->hasMany(MarketItems::class, "market_id");
    }
}
