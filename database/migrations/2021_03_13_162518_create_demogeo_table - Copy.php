<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemogeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demogeo', function (Blueprint $table) {
            $table->id();
            $table->string("fname");
            $table->string("lname");
            $table->string("address");
            $table->geometryCollection("latitude");
            $table->geometryCollection("longitude");
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
        Schema::dropIfExists('demogeo');
    }
}
