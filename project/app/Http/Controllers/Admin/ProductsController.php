<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductsRequest;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productsAll = Products::paginate(6);
        return view('auth.products.index', compact('productsAll'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('auth.products.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsRequest $request)
    {
        $params = $request->all();
        unset( $params['image']);

        if($request->has('image')){
            $path = $request->file('image')->store('products');
            $params['image'] = $path;
        }


        Products::create($params);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $product)
    {
        return view('auth.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $product)
    {
        $categories = Category::get();

        return view('auth.products.form', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(ProductsRequest $request, Products $product)
    {
        $params = $request->all();
        if(!is_null($request->file('image'))){
            Storage::delete($product->image);
            $path = $request->file('image')->store('products');

            $params['image'] = $path;
        }

        foreach(['hit', 'new', 'recommend'] as $fieldName){
            if(!isset($params[$fieldName])) {
                $params[$fieldName] = 0;
            }
        }

        $product->update($params);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
