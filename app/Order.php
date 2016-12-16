<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model {

    use SoftDeletes;

    protected $table = 'orders';

    protected $fillable = array('no', 'wait', 'total');

    public function products()
    {
        return $this->belongsToMany('App\Product', 'order_products', 'order_id', 'product_id')->withPivot('amount');
    }

}