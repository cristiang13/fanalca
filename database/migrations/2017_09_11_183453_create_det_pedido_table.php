<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetPedidoTable extends Migration
{
  /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detpedidos', function(Blueprint $table){
          $table->string('no_doc');
          $table->integer('articulo_id')->unsigned();
          $table->integer('sucursal_id')->unsigned();
          $table->integer('cant_pedida');
          $table->integer('cant_pendiente');
          $table->integer('cant_programado')->nullable();
          $table->integer('cond_pago')->nullable();
          $table->integer('costo_programado')->nullable();
          $table->string('no_viaje')->nullable();
          $table->integer('marca_update')->nullable();
          $table->timestamps();
          $table->primary(['no_doc','articulo_id','sucursal_id']);
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
        Schema::drop('detpedidos');
    }
}
