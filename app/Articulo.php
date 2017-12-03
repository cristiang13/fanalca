<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
  /**
  * The database table used by the model.
  *
  * @var string
  */
 protected $table = 'articulos';

 /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
 protected $fillable = ['referencia', 'desc_detalle'];

 public function detpedidos()
   {
       return $this->hasMany(Detpedidos::class);
   }



   public function inventario()
     {
         return $this->hasMany(Stock::class, 'articulo_id', 'id');
     }


}
