<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSucursalClienteTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('sucursal_cliente', function(Blueprint $table){
      $table->increments('id');
      $table->integer('cliente_id')->unsigned()->nullable();
      $table->string('razon_sucursal');


      //  $table->primary(['id','cliente_id']);

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::drop('sucursal_cliente');
  }
}
