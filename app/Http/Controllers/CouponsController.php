<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Jobs\UpdateCoupon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CouponsController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if (!$coupon) {
            return redirect()->route('cart.index')->withErrors('Neplatný kupón! Prosím skúste to znova.');
        }

        dispatch_now(new UpdateCoupon($coupon));        // Jobs. dispatch_now() is Laravel helper.
        // session()->put('coupon', [
        //     'name' => $coupon->code,
        //     'discount' => $coupon->discount(Cart::subtotal()),
        // ]);

        return redirect()->route('cart.index')->with('success_message', 'Kupón bol použitý.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->forget('coupon');

        return redirect()->route('cart.index')->with('success_message', 'Kupón bol odstránený.');
    }
}
