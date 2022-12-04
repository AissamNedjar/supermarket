<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function items() {
    	return $this->hasMany(Buy::class)->orderBy('updtaed_at', 'asc');
    }
}
