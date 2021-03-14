<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ProductsFilter;
use App\Products;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(ProductsFilter $request){
        $productsQuery = Products::query();
        //$products = Products::get();
        if($request->filled('price_from')){
            $productsQuery->where('pricee', '>=', $request->price_from);
        }
        if($request->filled('price_to')){
            $productsQuery->where('pricee', '<=', $request->price_to);
        }

        foreach (['hit', 'recommend', 'new'] as $field){
            if($request->has($field)){
                $productsQuery->where($field, 1);
            }

        }

        $products = $productsQuery->paginate(6)->withPath('?'.$request->getQueryString());
        return view('index', compact('products'));
    }

    public function categories(){
        $categories = Category::get();
        return view('categories', compact('categories'));
    }

    public function products($category, $product = null){
        return view('product', compact('product'));
    }

    public function category($code){
        $category = Category::where('code', $code)->first();
//        $products = Products::where('category_id', $category->id)->get();
        return view('category', compact('category'));
//        return view('category', compact('category', 'products'));
    }


}
