<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prog_viaje extends Model
{
  /**
  * The database table used by the model.
  * añadadio el 13/09/2017
  * @var string
  */

  public $timestamps = false;
 protected $table = 'prog_viaje';

 /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
 protected $fillable = ['no_doc', 'no_doc_detped','articulo_id','cant_programada','costo_programado','ruta'];

 public function client()
 {
     return $this->hasMany(Stock::class);
 }

}
