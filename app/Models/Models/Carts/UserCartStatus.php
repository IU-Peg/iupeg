<?php

namespace App\Models\Models\Carts;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCartStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "user_cart_id", "user_id", "name"
    ];

    public function user_cart()
    {
        return $this->belongsTo(UserCart::class, "user_cart_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
