<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockTable extends Migration
{
  /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventario', function(Blueprint $table){
          $table->integer('id');
          $table->integer('articulo_id')->unsigned()->nullable();
          $table->integer('dispo_total');
          $table->integer('prog_dia_ant');
          $table->integer('dispo_real')->nullable();
          $table->timestamps();

          $table->primary(['id','articulo_id']);

          
        //  $table->unique('no_doc','cliente_id','articulo_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inventario');
    }
}
