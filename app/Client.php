<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
  /**
  * The database table used by the model.
  *
  * @var string
  */

  public $timestamps = false;

 protected $table = 'clientes';

 /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
 protected $fillable = ['id','razon_social'];



}
