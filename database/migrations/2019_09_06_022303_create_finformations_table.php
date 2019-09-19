<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finformations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("pratique")->nullable();
            $table->integer("theorique")->nullable();
            $table->unsignedBigInteger("stagiaire_id")->index();
            $table->timestamps();
            $table->foreign('stagiaire_id')->references("id")->on("stagiaires");
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finformations');
    }
}
