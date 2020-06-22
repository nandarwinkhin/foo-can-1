<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblPeople', function (Blueprint $table) {
            $table->increments('person_id');
            $table->String('personName');
            $table->String('personEmail');
            $table->String('personContactNo');
            $table->String('personNRC')->unique();
            $table->String('personRegNo')->unique();
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
        Schema::dropIfExists('tblPeople');
    }
}
