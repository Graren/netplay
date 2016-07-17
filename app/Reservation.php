<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
      protected $fillable = [
        'stablishment_id'
      ];
      public function user(){
        return $this->belongsTo('App\User');
      }
      public function stablishment(){
        return $this->belongsTo('App\Stablishment');
      }
}
