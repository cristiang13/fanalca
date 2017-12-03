<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeingkeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('inventario', function($table){
        $table->foreign('articulo_id')->references('id')->on('articulos')
              ->onDelete('cascade')->onUpdate('cascade');
      });
      Schema::table('sucursal_cliente', function($table){
        $table->foreign('cliente_id')->references('id')->on('clientes')
              ->onDelete('cascade')->onUpdate('cascade');
      });
      Schema::table('info_cupo', function($table){
        $table->foreign('cliente_id')->references('id')->on('clientes')
              ->onDelete('cascade')->onUpdate('cascade');
      });
        Schema::table('detpedidos', function($table){
          $table->foreign('sucursal_id')->references('id')->on('sucursal_cliente')
                ->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('articulo_id')
                ->references('id')->on('articulos')
                ->onDelete('cascade')->onUpdate('cascade');
      });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('foreignKey');
    }
}
