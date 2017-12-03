<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfocupoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('info_cupo', function(Blueprint $table){
        $table->integer('id');
        $table->integer('cliente_id')->unsigned()->nullable();
        $table->integer('contado_a_hoy');
        $table->integer('cupo_de_credito_fanalca');
        $table->integer('cupo_de_credito_factoring');
        $table->integer('total_credito');
        $table->timestamps();

          $table->primary(['id','cliente_id']);

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('info_cupo');
    }
}
