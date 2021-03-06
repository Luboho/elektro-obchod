<?php

namespace App\Http\Controllers;

use App\Product;
use App\Carrier;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**"#0eb85546"
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $carriers = Carrier::all(); 

        $mightAlsoLike = Product::mightAlsoLike()->get();   //mightAlsoLike() scoped fnc. in Product model
        return view('cart')->with([
            'carriers' => $carriers,
            'mightAlsoLike' => $mightAlsoLike,
            'discount' => getNumbers()->get('discount'),
            'newSubtotal' => getNumbers()->get('newSubtotal'),
            'newTax' => getNumbers()->get('newTax'),
            'newTotal' => getNumbers()->get('newTotal'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        session()->forget('carrier');

        // // Avoid items duplication in cart. 
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === $request->id;          // Cmp. items between cart and request. 
        });

        if ($duplicates->isNotEmpty()) {
            session()->flash('success', 'Položka už vo vašom košíku je.');
            return redirect('cart');
        } 

            Cart::add($request->id, $request->name, 1, $request->price) // Adding item to the cart.
                ->associate('App\Product');                             

            session()->flash('success', 'Položka bola pridaná do košíka.');
            return redirect('cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        session()->forget('carrier');

        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,5'
        ]);

        if($validator->fails()) {
            session()->flash('denied', collect(['Množstvo musí byť od 1 do 5.'])->first());
            return response()->json(['success' => false], 400);     // Https  RESPONSE Bad request 400;
        }

        if ($request->quantity > $request->productQuantity) {
            session()->flash('errors', collect(['Nedostatok položiek na sklade.'])->first());
            return response()->json(['success' => false], 400);
        }
        Cart::update($id, $request->quantity);

         session()->flash('success_message', 'Množstvo bolo aktualizované!');
         return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        session()->forget('carrier');

        Cart::remove($id);

        session()->flash('success', 'Položka bola odstránená!');
        return back();
    }

    /**
     * Switch item for shopping cart to Save for Later.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switchToSaveForLater($id)
    {
    session()->forget('carrier');

    $item = Cart::get($id);

    Cart::remove($id);

    $duplicates = Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($id){
        return $rowId === $id; 
    });

    if ($duplicates->isNotempty()) {
        session()->flash('success', 'Položka už bola rezervovaná.');
        return redirect('cart');
    }

    Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)
        ->associate('App\Product');

        session()->flash('success', 'Položka je rezervovaná.');
        return redirect('cart');
    }

}
