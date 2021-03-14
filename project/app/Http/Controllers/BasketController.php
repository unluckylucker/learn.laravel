<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket(){
        $orderId = session('orderId');
        if(!is_null($orderId)){
            $order = Order::findOrFail($orderId);
        }else{
            return redirect()->route('index');
        }
        return view('basket', compact('order'));

    }

    public function basketPlace(){
        $orderId = session('orderId');
        if(is_null($orderId)){
            return redirect()->route('index');
        }
        $order = Order::find($orderId);
        return view('order', compact('order'));
    }

    public function basketConfirm(Request $request){
        $orderId = session('orderId');
        if(is_null($orderId)){
            return redirect()->route('index');
        }
        $order = Order::find($orderId);
        $success = $order->saveOrder($request->name, $request->phone);

        if($success){
            session()->flash('success', 'Ваш заказ принят');
        }else{
            session()->flash('warning', 'Error');
        }

        return redirect()->route('index');
    }

    public function basketAdd($productId){
        $orderId = session('orderId');
        if(is_null($orderId)){
            $order = Order::create();
            session(['orderId'=>$order->id]);
        }else{
            $order = Order::find($orderId);
        }

        if($order->products->contains($productId)){
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();

        }else{
            $order->products()->attach($productId);
        }

        if(Auth::check()){
            $order->user_id = Auth::id();
            $order->save();
        }

        $product = Products::find($productId);
        $productName = $product->name;

        session()->flash('success', 'Добавлен товар ' . $productName );

//        dump($order->products);
//        dump($order);
        return redirect()->route('basket');
        //return view('basket', compact('order'));
    }

    public function basketRemove($productId){
        $orderId = session('orderId');
        if(is_null($orderId)){
            return redirect()->route('basket');
        }
        $order = Order::find($orderId);

        if($order->products->contains($productId)){
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            if($pivotRow->count < 2){
                $order->products()->detach($productId);
            }else{
                $pivotRow->count--;
                $pivotRow->update();
            }
        }

        $product = Products::find($productId);
        $productName = $product->name;
        session()->flash('warning', 'Удален товар ' . $productName );

        return redirect()->route('basket');
        //return view('basket', compact('order'));
    }
}
