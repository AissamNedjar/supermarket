<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function items() {
    	return $this->hasMany('App\Buy')->orderBy('updtaed_at', 'asc');
    }
}
