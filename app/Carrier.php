<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->first() ;
    }

    public function delivery($total)
    {
        if ($this->price > 0) {
            return $this->price;
        } else {
            return 0;
        }
    }
}
