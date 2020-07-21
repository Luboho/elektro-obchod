<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\OrderProduct;
use App\Mail\OrderPlaced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CheckoutRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Cart::instance('default')->count() == 0 ){
            return redirect('shop.index');
        }

        if(!session()->has('carrier')) {
            session()->flash('denied', 'Potvrďte prosím spôsob dopravy.');
            return redirect()->route('cart.index');            
        }

        if (auth()->user() && request()->is('guestCheckout')) {
            return redirect()->route('checkout.index');
        }

        return view('checkout')->with([
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
    public function store(CheckoutRequest $request)
    {      
        // Check race condition when there are less items available to purchase
        if ($this->productsAreNoLongerAvailable()) {
            return back()->withErrors('Prepáčte. Niektorá z pridaných položiek už nie je k dispozícii.');
        }

        //Metadata
        $contents = Cart::content()->map(function ($item) {
            return $item->model->slug.', '.$item->qty;
        })->values()->toJson();
        
        try {   // Sending order to Stripe Dasboard.
            $charge = Stripe::charges()->create([
                'amount' => getNumbers()->get('newTotal') / 100,
                'currency' => 'Eur',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    //change to Order ID after we start using DB
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count(),
                    'delivery' => collect(session()->get('carrier'))->toJson(),
                    'discount' => collect(session()->get('coupon'))->toJson(),
                ],
            ]);

            $order = $this->addToOrdersTables($request, null);
            Mail::send(new OrderPlaced($order)); // or Mail::to($request->email)->send(new OrderPlaced);
          
            // Decrease the quantity of all the products in the cart.
            $this->decreaseQuantities();


            // SUCCESSFUL
            Cart::instance('default')->destroy();
            session()->forget('coupon');
            session()->forget('carrier');

            session()->flash('success_message', 'Ďakujeme! Vaša platba bola prijatá!');
            return redirect()->action('ConfirmationController@index');

        } catch (CardErrorException $e) {
            $this->addToOrdersTables($request, $e->getMessage());
            return back()->withErrors('Error! '. $e->getMessage());
        }
    }

    protected function addToOrdersTables($request, $error)
    {
        // Insert into orders table.
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'billing_province' => $request->province,
            'billing_postalcode' => $request->postalcode,
            'billing_phone' => $request->phone,
            'billing_name_on_card' => $request->name_on_card,
            'billing_discount' => getNumbers()->get('discount'),
            'billing_discount_code' => getNumbers()->get('couponCode'),
            'carrier' => session()->get('carrier')['name'],
            'delivery_price' => session()->get('carrier')['price'],
            'billing_subtotal' => getNumbers()->get('newSubtotal'),
            'billing_tax' => getNumbers()->get('newTax'),
            'billing_total' => getNumbers()->get('newTotal'),
            'error' => $error,
        ]);
    
        // Insert into order_product Pivot table.
        foreach (Cart::content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }

        return $order;
    }

    protected function decreaseQuantities()
    {
        foreach (Cart::content() as $item){
            $product = Product::find($item->model->id);

            $product->update(['quantity' => $product->quantity - $item->qty]);
        }
    }

    protected function productsAreNoLongerAvailable() 
    {
        foreach (Cart::content() as $item) {
            $product = Product::find($item->model->id);
            if ($product->quantity < $item->qty) {  // If $product->quantity are less than Cart $item quantity.
                return true;
            }
        }

        return false;
    }
}
