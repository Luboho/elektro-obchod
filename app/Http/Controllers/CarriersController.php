<?php

namespace App\Http\Controllers;

use App\Carrier;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CarriersController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $carrier = Carrier::where('slug', $request->carrier_slug)->first();

       if (!$carrier) {
           return redirect()->route('cart.index')->withErrors('Neoznačili ste spôsob dopravy. Prosím, vyberte jednu z možností.');
       }

       session()->put('carrier', [
            'name' => $carrier->name,
            'slug' => $carrier->slug,
            'price' => $carrier->delivery(Cart::subtotal()),
       ]);

       return redirect()->route('cart.index')->with('success_message', 'Bol vybraný spôsob dopravy.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
