<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SucurClient extends Model
{
  /**
  * The database table used by the model.
  *
  * @var string
  */

  public $timestamps = false;

 protected $table = 'sucursal_cliente';

 /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
 protected $fillable = ['id','cliente_id','razon_sucursal'];

}
