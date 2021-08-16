<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
	protected $table = 'items_sales';

    public function item() {
    	return $this->belongsTo('App\Item');
    }
}
