<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->integer('controle_N1')->nullable();
            $table->integer('controle_N2')->nullable();
            $table->integer('controle_N3')->nullable();
            $table->integer("EFM")->nullable();
            $table->integer("coefficient")->nullable();;
            $table->unsignedBigInteger('stagiaire_id')->nullable();
            $table->unsignedBigInteger('filiere_id')->nullable();;
            $table->timestamps();
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
        Schema::dropIfExists('modules');
    }
}
