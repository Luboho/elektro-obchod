<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_product'; // $migration name was changed to a singular from order_producs to order_product.

    protected $fillable = ['order_id', 'product_id', 'quantity'];
}
