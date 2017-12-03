<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detpedidos extends Model
{
  /**
  * The database table used by the model.
  *
  * @var string
  */

 protected $table = 'detpedidos';

 /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
 protected $fillable = ['no_doc','articulo_id','sucursal_id','cant_pedida','cant_pendiente','cant_programado','costo_programado','no_viaje','marca_update'];


}
