<?php

namespace App\Listeners;

use App\Coupon;
use App\Jobs\UpdateCoupon;
use Illuminate\Queue\InteractsWithQueue;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Queue\ShouldQueue;

class CartUpdatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {       // Make sure that Coupon value will be updated after cart updating.
        $couponName = session()->get('coupon')['name'];

        if ($couponName){
            $coupon = Coupon::where('code', $couponName)->first();
    
            dispatch_now(new UpdateCoupon($coupon));    // Calling job's class.  dispatch_now() is Laravel helper.
        }
    }
}
