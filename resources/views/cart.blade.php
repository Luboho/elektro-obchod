@extends('layout')

@section('title', 'Nákupný košík')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')

    @component('components.breadcrumbs')
        <a href="/">Domov</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>Nákupný košík</span>
    @endcomponent <!-- end breadcrumbs -->

    <div class="container">
        @if (session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
        @endif

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @include('partials.messages')
        @if (Session::has('message'))
            <div class="alert alert-success">{{ Session::get('message') }}</div>
        @endif <!-- end messages -->
    </div>

        <div class="cart-section container">

            @if (Cart::count() > 0)

                <div id="shopping-cart-summary">
                    <h2>{{ \Helper::cartItemsCounterEnding(Cart::count()) }} v nákupnom košíku</h2>

                    <div class="cart-table">
                        @foreach(Cart::content() as $item)
                        <div class="cart-table-row">
                            <div class="cart-table-row-left">
                                <a href="{{ route('shop.show', $item->model->slug) }}"><img src="{{ productImage($item->model->image) }}" alt="product"> {{-- Voyager storage   <img src="{{ asset('storage/img/products/'.$item->model->slug.'.png') }}" alt="item" class="cart-table-img"></a>--}}
                                <div class="cart-item-details"> 
                                    <div class="cart-table-item"><a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->model->name }}</a></div>
                                    <div class="cart-table-description">{{ $item->model->details }}</div>
                                </div>
                            </div>
                            <div class="cart-table-row-right">
                                <div class="cart-table-actions">
                                    {{-- Remove --}}
                                    <form action="{{ route('cart.destroy', $item->rowId) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="cart-options">Odstrániť</button>
                                    </form>
                                    <br>
                                    {{-- Save for Later --}}
                                    <form action="{{ route('cart.switchToSaveForLater', $item->rowId) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="cart-options">Odložiť</button>
                                    </form>

                                </div>
                                <div>   
                                    {{-- Adding Product Quantity to cart. --}}
                                    <select class="quantity" data-id="{{ $item->rowId }}" data-productQuantity="{{ $item->model->quantity }}"> {{-- }}">Add to JS below too. --}}
                                        @for($i = 1; $i < 5 + 1; $i++)
                                            <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor

                                    </select>
                                </div>
                                <div class="ml-1">{{ $item->model->presentPrice() }}</div>
                            </div>
                        </div> <!-- end cart-table-row -->
                            
                        @endforeach
                    </div> <!-- end cart-table -->

                    @if (! session()->has('coupon'))
                        <a href="#" class="have-code">Zľavový kupón</a>

                        <div class="have-code-container">
                            <form action="{{ route('coupon.store') }}" method="POST">
                                @csrf
                                <input type="text" name="coupon_code" id="coupon_code" class="border bg-light">
                                <input type="submit" class="button" value="Použiť">
                            </form>
                        </div>
                    @endif

                    <div class="cart-totals">
                        <div class="cart-totals-left">
                          Doprava ZDARMA pri nákupe nad 45€.
                        </div>

                        <div class="cart-totals-right">
                            <div>
                                Medzisúčet <br>
                                @if (session()->has('coupon'))
                                    Kód ({{ session()->get('coupon')['name'] }})
                                    <form action="{{ route('coupon.destroy') }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" style="font-size: 0.8em" class="cart-options text-black-50 ">Odstrániť</button>
                                    </form>
                                    <br>
                                    <hr>
                                    Nový medzisúčet <br>
                                @endif
                                DPH(20%) <br>
                                <span class="cart-totals-total">Celkom&nbsp; </span>
                            </div>
                            <div class="cart-totals-subtotal">
                                {{ presentPrice(Cart::subtotal()) }} <br>
                                @if (session()->has('coupon'))
                                    -{{ presentPrice(session()->get('coupon')['discount']) }} <br>
                                    <hr>
                                    {{ presentPrice($newSubtotal) }} <br>
                                @endif
                                {{ presentPrice($newTax) }} <br>
                                <span class="cart-totals-total">{{ presentPrice($newTotal) }}</span>
                            </div>
                        </div>
                    </div> <!-- end cart-totals -->

                    <div class="cart-buttons">
                        <a href="{{ route('shop.index') }}" class="button">Pokračovať v nákupe</a>
                        <a href="{{ route('checkout.index') }}" class="button-primary">Pristúpiť k objednávke</a>
                    </div>
                </div>

                <div id="delivery-section">
                    <h2>Doprava</h2>
                <form action="#" method="POST" class="delivery">
         
                        <div class="form-block">
                            <div>
                                <label class="rad" for="personally">
                                    <input type="radio" id="personally" name="delivery" value="personally"><i></i>
                                     Na predajni
                                </label>
                                <ul class="custom-radio-container">
                                    <li>Predajňa je otvorená denne od 8:00 do 17:00.</li>
                                    <li><a href="#footer-section2" class="un">Adresa predajne</a></li>
                                    <li>Bežná doba doručenia 1 - 2 dni.</li>
                                    <li>Tovar je možné si v predajni vyskúšať</li>
                                </ul>
                            </div>

                            <div> ZDARMA</div>
                        </div>

                        <div class="form-block">
                            <div>
                                <label class="rad" for="dhl">
                                    <input type="radio" id="dhl" name="delivery" value="dhl"><i></i>
                                    DHL
                                </label>
                                <ul class="custom-radio-container">
                                    <li>Bežná doba doručenia 1 - 2 dni. </li>
                                    <li>DHL kurier rozváža tovať vo všedné dni od 8:00 do 18:00.</li>
                                </ul>
                            </div>

                            <div> €3.50</div>
                        </div>

                        <div class="form-block">
                            <div>
                                <label class="rad" for="slovak-post-office">
                                    <input type="radio" id="slovak-post-office" name="delivery" value="slovak-post-office"><i></i>
                                    Pošta SR
                                </label>
                                    <ul class="custom-radio-container">
                                        <li>Bežná doba doručenia 3 - 4 pracovné dni.</li>
                                        <li>U vodiča Pošty SR môžete platiť len v hotovosti</li>
                                        <li>Pošta rozváža tovar vo všedné dni od 8:00 do 17:00.</li>
                                    </ul>
                            </div>

                            <div> €2.50</div>
                        </div>

                    </form>
                </div> {{-- End Delivery section--}}

                    @else 

                        <h3>Žiadne položky v košíku!</h3>
                        <div class="spacer"></div>
                            <a href="{{ route('shop.index') }}" class="button">Pokračovať v nákupe</a>
                        <div class="spacer"></div>

                    @endif   
        {{-- Save For Later Section --}}
                    @if (Cart::instance('saveForLater')->count() > 0)
                        <div id="shopping-cart-summary">
                        <h2>{{ \Helper::saveItemsCounterEndings(Cart::instance('saveForLater')->count()) }} </h2>

                        <div class="saved-for-later cart-table" >
                            @foreach (Cart::instance('saveForLater')->content() as $item )                    
                                <div class="cart-table-row">
                                    <div class="cart-table-row-left">
                                        <a href="{{ route('shop.show', $item->model->slug) }}">
                                            <img src="{{ productImage($item->model->image) }} " alt="product" class="cart-table-img">{{--<-- Voyager storage--}}  {{-- <img src="{{ asset('storage/img/products/'.$item->model->slug.'.png') }}" alt="item" class="cart-table-img"> --}}
                                        </a>
                                        <div class="cart-item-details">
                                            <div class="cart-table-item"><a href="{{ route('shop.show', $item->model->slug) }}">
                                                {{ $item->model->name }}</a>
                                            </div>
                                            <div class="cart-table-description">{{ $item->model->details }}</div>
                                        </div>
                                    </div>
                                    <div class="cart-table-row-right">
                                        <div class="cart-table-actions">
                                            {{-- Remove--}}
                                            <form action="{{ route('saveForLater.destroy', $item->rowId) }}" method="POST">
                                                @csrf
                                                @method('delete') 

                                                <button type="submit" class="cart-options">Odstrániť</button>
                                            </form>
                                            {{-- Move to Cart--}}
                                            <form action="{{ route('saveForLater.switchToCart', $item->rowId) }}" method="POST">
                                            @csrf

                                            <button type="submit" class="cart-options">Do košíka</button>
                                            </form>
                                        </div>
                                        {{-- <div>
                                            <select class="quantity">
                                                <option selected="">1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div> --}}
                                        <div>{{ $item->model->presentPrice() }}</div>
                                    </div>
                                </div> <!-- end cart-table-row -->
                            @endforeach

                        </div> <!-- end saved-for-later -->
                        </div>
                    @endif
                     
    </div> <!-- end cart-section -->

    @include('partials.might-like')


@endsection

@section('extra-js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        (function(){

            const classname = document.querySelectorAll('.quantity')

            Array.from(classname).forEach(function(element) {
                element.addEventListener('change', function() {
                    const id = element.getAttribute('data-id')      // Getting id from <select> quantity.
                    const productQuantity = element.getAttribute('data-productQuantity') // Getting product quantity  from <select> quantity.
           
                    axios.patch(`/cart/${id}`, {    // Making patch request. 
                        quantity: this.value,
                        productQuantity: productQuantity
                    })
                    .then(function(response) {      // REsponse from cart.blade/CartController@update.
                       // console.log(response);      
                        window.location.href = '{{ route('cart.index') }}'  // Refresh the page.
                    })
                    .catch(function(error){
                        // console.log(error);
                        window.location.href = '{{ route('cart.index') }}'  // Refresh the page.
                    });
                })
            })
        })();
    </script>

    <script>
        (function(){
            const classname = document.querySelectorAll('.delivery')

            Array.from(classname).forEach(function(element) {   // Making from classname an Array
                element.addEventListener('change', function() {
                    axios.patch('/cart/DHL', {
                        delivery: 'dhl'    
                    })
                    .then(function(response) {      // REsponse from cart.blade/CartController@update.
                       console.log(response);      
                        // window.location.href = '{{ route('cart.index') }}'  // Refresh the page.
                    })
                    .catch(function(error){
                        console.log(error);
                        // window.location.href = '{{ route('cart.index') }}'  // Refresh the page.
                    });
                })
            })
        })();
    </script>

    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>
@endsection