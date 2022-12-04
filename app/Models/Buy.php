<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
	protected $table = 'items_sales';

    public function item() {
    	return $this->belongsTo(Item::class);
    }
}
