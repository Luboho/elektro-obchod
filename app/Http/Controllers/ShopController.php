<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = 9;
        $categories = Category::all();

        if (request()->category) {
            $products = Product::with('categories')->whereHas('categories', function ($query) {
                $query->where('slug', request()->category);
            });
            $categoryName = optional($categories->where('slug', request()->category)->first())->name;
        } else {
            $products = Product::where('featured', true);
            $categoryName = 'Odporúčané';
        }

        if (request()->sort == 'low_high') {
            $products = $products->orderBy('price')->paginate($pagination);
        } elseif (request()->sort == 'high_low') {
            $products = $products->orderBy('price', 'desc')->paginate($pagination);
        } else {
            $products = $products->paginate($pagination);
        }

        return view('shop')->with([
            'products' => $products,
            'categories' => $categories,
            'categoryName' => $categoryName,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $mightAlsoLike = Product::where('slug', '!=', $slug)->mightAlsoLike()->get();

        // Product Availability in Stock. Method in Helpers.php
        $stockLevel = getStockLevel($product->quantity);
        
        return view('product')->with([
            'product' => $product,
            'mightAlsoLike' => $mightAlsoLike,
            'stockLevel' => $stockLevel,
        ]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|min:3',
        ]);

        $query = $request->input('query');

        // Search modul making by own code ( Not a Search package ).
        // $products = Product::where('name', 'like', "%$query%")
        //                     ->orWhere('details', 'like', "%$query%")
        //                     ->orWhere('description', 'like', "%$query%")
        //                     ->paginate(10);   // "%$query%" is dynamic SQL helper searching for words in $tables where contains $query. Without %% it will searching strictly what is in $query

        if (request()->sort == 'low_high') {
            $products = Product::search($query)->orderBy('price')->paginate(10); // Search modul by nicolaslopezj/searchable .// If Syntax error or access violation: 1055 Error appear change true to false in config.database
        } elseif (request()->sort == 'high_low') {
            $products = Product::search($query)->orderBy('price', 'desc')->paginate(10); // Search modul by nicolaslopezj/searchable .// If Syntax error or access violation: 1055 Error appear change true to false in config.database
        } else {
            $products = Product::search($query)->paginate(10); // Search modul by nicolaslopezj/searchable .// If Syntax error or access violation: 1055 Error appear change true to false in config.database
        }

        return view('search-results', compact('products'));
    }

    public function searchAlgolia(Request $request)
    {
        return view('search-results-algolia');
    }

}
