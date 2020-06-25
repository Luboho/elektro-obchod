<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->first() ;
    }

    // public function delivery($total,$price)    // used in CarrierController
    // {
    //     if ($this->total > 85 || $this->price == 0) {
    //         return 0;
    //     } else {
    //         return $this->price;
    //     }
    // }
}
