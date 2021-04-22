<?php

namespace App\Models\Models\Carts;

use App\Models\Models\Market\Market;
use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCart extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "user_id", "market_id", "cart_code",  "status", "paid_at"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function market(){
        return $this->belongsTo(Market::class, "market_id");
    }


}
