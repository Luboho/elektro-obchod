<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

class Helper {

    public static function limitText($description)
    {
        return Str::limit($description, 80);
    }

    public static function cartItemsCounterEnding($count)
    {
        if ($count == 1){
            return $count.' položka '; 
        } elseif ($count >= 2 && $count <= 4) {
            return $count.' položky ';
        } elseif ($count >= 5 || $count === 0 ) {
            return $count.' položiek ';
        }
    }

    public static function saveItemsCounterEndings($count)
    {
        if ($count == 1){
            return 'Odložená '.$count.' položka '; 
        } elseif ($count >= 2 && $count <= 4) {
            return 'Odložené '.$count.' položky ';
        } elseif ($count >= 5 || $count === 0 ) {
            return 'Odložených '.$count.' položiek';
        }
    }
    
}

//=========================  Global Methods  =============================================

function presentPrice($price)   // Using this method for non Product model purposes. 
{
    return sprintf('€%01.2f', $price / 100);
}

function presentDate($date) 
{
    return Carbon::parse($date)->format('M d, Y');
}

function setActiveCategory($category, $output = 'active')
{
    return request()->category == $category ? $output : '';
}

function productImage($path)
{
    return $path && file_exists('storage/'.$path) ? asset('storage/'.$path) : asset('img/not-found.jpg');
}

function getNumbers()
    {
        $tax = config('cart.tax') / 100;
        $couponCode = session()->get('coupon')['name'] ?? null;
        $discount = session()->get('coupon')['discount'] ?? 0;  // 0 to be sure if session hasn't coupon.
        $newSubtotal = (Cart::subtotal() - $discount);
        if ($newSubtotal < 0) {     // Do not allow negative total in checkout.
            $newSubtotal = 0;
        }
        $newTax = $newSubtotal * $tax;
        $newTotal = $newSubtotal + $newTax;

        return collect([
            'tax' => $tax,
            'couponCode' => $couponCode,
            'discount' => $discount,
            'newSubtotal' => $newSubtotal,
            'newTax' => $newTax,
            'newTotal' => $newTotal,
        ]);
    }

// Product Availability na sklade.
function getStockLevel($quantity) 
{
    // if ($quantity > setting('site.stock_threshold')) { // setting('site.stock_threshold')) from Voyager Settings.
    //     $stockLevel = '<div class="badge badge-success">na sklade</div>';
    // } elseif ($quantity <= setting('site.stock_threshold') && $quantity > 0) {
    //     $stockLevel = '<div class="badge badge-warning">Low Stock</div>'; // Haven't be escaped in blade {!! !!}
    // } else {
    //     $stockLevel = '<div class="badge badge-danger">Not available</div>';
    // }

    switch (true) {
        case ($quantity === 0 ): 
            $stockLevel = '<div class="badge badge-danger">Nie je na sklade</div>';
            break;
        case ($quantity === 1 ): 
            $stockLevel = '<div class="badge badge-warning">Na sklade 1ks</div>';
            break;
        case ($quantity === 2 ): 
            $stockLevel = '<div class="badge badge-warning">Na sklade 2ks</div>';
            break;
        case ($quantity === 3 ): 
            $stockLevel = '<div class="badge badge-warning">Na sklade 3ks</div>';
            break;
        case ($quantity === 4 ): 
            $stockLevel = '<div class="badge badge-warning">Na sklade 4ks</div>';
            break;
        case ($quantity === 5 ): 
            $stockLevel = '<div class="badge badge-success">Na sklade 5ks</div>';
            break;
        case ($quantity === 6 ): 
            $stockLevel = '<div class="badge badge-success">Na sklade 6ks</div>';
            break;
        case ($quantity === 7 ): 
            $stockLevel = '<div class="badge badge-success">Na sklade 7ks</div>';
            break;
        case ($quantity === 8 ): 
            $stockLevel = '<div class="badge badge-success">Na sklade 8ks</div>';
            break;
        case ($quantity === 9 ): 
            $stockLevel = '<div class="badge badge-success">Na sklade 9ks</div>';
            break;
        case ($quantity > 9 ): 
            $stockLevel = '<div class="badge badge-success">Na sklade > 10ks</div>';
            break;
    }

    return $stockLevel;
}


    

