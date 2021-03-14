@extends('auth.layouts.master')
@section('title', 'Заказы')
@section('content')
    <?//use App\Order;?>
    <div class="col-md-12">
        <h1>@yield('title')</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    #
                </th>
                <th>
                    Имя
                </th>
                <th>
                    Телефон
                </th>
                <th>
                    Когда отправлен
                </th>
                <th>
                    Сумма
                </th>
                <th>
                    Действия
                </th>
            </tr>
            @foreach($orders as $order)
{{--            @foreach(Order::getOrders() as $order)--}}
            <tr>

                <td>{{$order->id}}</td>
                <td>{{$order->name}}</td>
                <td>{{$order->phone}}</td>
                <td>{{$order->created_at->format('H:m d/m/Y')}}</td>
                <td>{{$order->getFullPrice()}} руб.</td>
{{--                <td>{{$order->price}} руб.</td>--}}
                <td>
                    <div class="btn-group" role="group">
                        <a class="btn btn-success" type="button"
                        @admin
                        href="{{route('orders.show', $order->id)}}"
                        @else
                            href="{{route('person.orders.show', $order->id)}}"
                        @endadmin

                                   >Открыть</a>
                    </div>
                </td>


            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection