<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblCard_data', function (Blueprint $table) {
            $table->increments('card_id');
            $table->unsignedInteger('cardTypeID');
            $table->unsignedInteger('personID');
            $table->unsignedInteger('balance');
            $table->unsignedInteger('depositAmount');
            $table->unsignedInteger('createdBy');
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
        Schema::dropIfExists('tblCard_data');
    }
}
