<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
    protected $fillable = [
      'name','slots'
    ];
    public function stablishments(){
      return $this->belongsToMany('App\Stablishment','stablishment_commodities','commodity_id','stablishment_id');
    }
}
