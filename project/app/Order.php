<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function products(){
        return $this->belongsToMany(Products::class, 'order_product', 'order_id', 'product_id')->withPivot('count')->withTimestamps();
    }

    public function getFullPrice(){
        $sum = 0;
        foreach ($this->products as $prod){
            $sum += $prod->getPriceForCount($prod->pivot->count);
        }
        return $sum;
    }

    public function saveOrder($name, $phone){
        if($this->status == 0){
            $this->name = $name;
            $this->phone =  $phone;
            $this->status = 1;
            $this->save();
            session()->forget('orderId');
            return true;
        }else{
            return false;
        }

    }

    static public function getOrders(){
        $orderObj = new Order;
        $orders = $orderObj->where('status', 1)->get();
        foreach ($orders as $order){
            $orderId = $order->id;
            $orderProd = $order->products()->where('order_id', $orderId)->get();
            $fullprice = $order->getFullPrice();

            $order->prods = $orderProd;
            $order->price = $fullprice;
        }

        return $orders;
    }
}
