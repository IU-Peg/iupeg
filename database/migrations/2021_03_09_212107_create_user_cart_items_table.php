<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable("user_cart_items"))
        Schema::create('user_cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_cart_id")->constrained("user_carts")->onDelete("cascade");
            $table->foreignId("user_id")->constrained(  "users")->onDelete("cascade");
            $table->foreignId("market_item_id")->constrained("market_items")->onDelete("cascade");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_cart_items');
    }
}
