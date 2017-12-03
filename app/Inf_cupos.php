<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inf_cupos extends Model
{
  /**
  * The database table used by the model.
  *
  * @var string
  */

 protected $table = 'info_cupo';

 /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
 protected $fillable = ['id','cliente_id','contado_a_hoy','cupo_de_credito_fanalca','cupo_de_credito_factoring','total_credito'];


  public function cliente()
  {
      return $this->belongsTo(Client::class);
  }

  public function cliente_id()
   {
     return $this->cliente->id;
   }
}
