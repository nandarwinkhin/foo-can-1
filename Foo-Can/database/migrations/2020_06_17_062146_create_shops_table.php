<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblShops', function (Blueprint $table) {
            $table->Increments('shop_id');
            $table->String('shopName');
            $table->String('shopContactPerson');
            $table->String('shopContactNo');
            $table->Text('shopAddress');
            $table->Integer('createdBy');
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
        Schema::dropIfExists('tblShops');
    }
}
