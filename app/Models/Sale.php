<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function items() {
    	return $this->hasMany(Buy::class)->orderBy('updated_at', 'desc');
    }
}
