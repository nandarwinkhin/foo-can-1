<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblTransactions', function (Blueprint $table) {
            $table->Increments('transaction_id');
            $table->unsignedInteger('card_id');
            $table->unsignedInteger('shop_id');
            $table->unsignedInteger('recipe_id');
            $table->Integer('transationsAmount');
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
        Schema::dropIfExists('tblTransactions');
    }
}
