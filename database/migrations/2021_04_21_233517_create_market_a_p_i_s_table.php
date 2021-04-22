<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketAPISTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable("market_apis"))
            Schema::create('market_apis', function (Blueprint $table) {
                $table->id();
                $table->foreignId("market_id")->constrained("markets")->onDelete("cascade");
                $table->string("api_name");
                $table->string("api_key");
                $table->string("api_secret");
                $table->string("api_type");
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
        Schema::dropIfExists('market_a_p_i_s');
    }
}
