<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStagiairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stagiaires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('result')->nullable();
            $table->bigInteger('heures_absence')->nullable();;
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('filiere_id')->nullable();;
            $table->timestamps();
            $table->foreign("user_id")->references("id")->on("users");
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
        Schema::dropIfExists('stagiaires');
    }
}
