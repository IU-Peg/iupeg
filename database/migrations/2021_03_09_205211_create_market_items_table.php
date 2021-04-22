<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable("market_items"))
        Schema::create('market_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId("market_id")->constrained("markets")->onDelete("cascade");
            $table->foreignId("item_id")->constrained("items")->onDelete("cascade");
            $table->string("product_code_api")->nullable();
            $table->string("ean")->unique();
            $table->decimal("unit_price", 10,2);
            $table->integer("stock")->default(0);
            $table->tinyInteger("active")->default(1);
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
        Schema::dropIfExists('market_items');
    }
}
