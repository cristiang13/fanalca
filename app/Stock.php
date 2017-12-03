<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
  /**
  * The database table used by the model.
  *
  * @var string
  */

 protected $table = 'inventario';

 /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
 protected $fillable = ['id','articulo_id','dispo_total','prog_dia_ant','dispo_real','fecha_inventario'];


  public function articulo()
  {
      return $this->belongsTo(Articulo::class);
  }

  public function articulo_id()
   {
     return $this->articulo->id;
   }

}
