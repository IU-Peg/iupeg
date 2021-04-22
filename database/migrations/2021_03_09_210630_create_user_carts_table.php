<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable("user_carts"))
        Schema::create('user_carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("market_id")->constrained("markets")->onDelete("cascade");
            $table->foreignId("user_id")->constrained("users")->onDelete("cascade");
            $table->string("cart_code")->nullable()->comment("Codigo Unico gerado pela Iupeg para identificar os pedidos");
            $table->string("status")->default("BUYING")->comment("Possíveis status => BUYING, PAYING, PAID, COMPLETED");
            $table->timestamp("paid_at")->nullable();
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('user_carts');
    }
}
