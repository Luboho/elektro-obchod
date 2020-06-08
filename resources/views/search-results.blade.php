@extends('layout')

@section('title', 'Výsledky hľadania')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')

    @component('components.breadcrumbs')
        <a href="/">Domov</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>Hľadanie</span>
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
    </div>

    <div class="search-results-container m-auto container">
       <h1 class="mt-3">Výsledky hľadania</h1>
       <div class="d-flex justify-content-between pb-3">
            <p class="search-results-count">{{ $products->total() }} výsledkov pre <strong>{{ request()->input('query') }}</strong></p>
        
            <div>
                @if($products->count() > 0)
                    <strong>Cena: </strong>
                    <a href="{{ route('search', ['query' => request()->input('query'), 'sort'=> request()->sort, 'sort' => 'low_high']) }}">Od najlacnejších</a> |
                    <a href="{{ route('search', ['query' => request()->input('query'), 'sort'=> request()->sort, 'sort' => 'high_low']) }}">Od najdrahších</a>
                @endif
            </div>
       </div>

       @if($products->total() > 0)
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Obrázok</th>
                        <th>Názov</th>
                        <th>Detail</th>
                        <th>Opis</th>
                        <th>Cena</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product )
                        <tr>
                            <td><a href="{{ route('shop.show', $product->slug) }}"><img src="{{ productImage($product->image) }}"></a></td>
                            <td><a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</td>
                                <td>{{ $product->details }}</td>
                            <td>{{ \Helper::limitText($product->description) }} </td>
                            <td>{{ $product->presentPrice() }}</td>
                        </tr>
                        @endforeach
                    </tbody>

            </table>
            <div class="spacer"></div>
            <div class="text-center">{{ $products->appends(request()->input())->links() }}</div>
        @endif
    </div> <!-- end search container-->

    @endsection

@section('extra-js')
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>
@endsection
