<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stablishment extends Model
{
    protected $fillable = [
      'name','city','address'
    ];

    public function commodities(){
      return $this->belongsToMany('App\Commodity','stablishment_commodities','stablishment_id','commodity_id')
      ->withPivot('slots');;
    }

    public function reservations(){
        return $this->hasMany('App\Reservation');
    }

}
