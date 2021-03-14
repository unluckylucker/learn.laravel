@extends('layouts.app')
@section('title', 'Главная')
@section('content')


<div class="container">
    <div class="starter-template">
        <h1>Все товары</h1>
        <form method="GET" action="{{route('index')}}">
            <div class="filters row">
                <div class="col-sm-6 col-md-3">
                    <label for="price_from">Цена от <input type="text" name="price_from" id="price_from" size="6"
                                                           value="{{Request::get('price_from')}}">
                    </label>
                    <label for="price_to">до <input type="text" name="price_to" id="price_to" size="6" value="{{Request::get('price_to')}}">
                    </label>
                </div>
                <div class="col-sm-2 col-md-2">
                    <label for="hit">
                        <input type="checkbox" name="hit" id="hit" @if(Request::get('hit') =='on') checked @endif> Хит </label>
                </div>
                <div class="col-sm-2 col-md-2">
                    <label for="new">
                        <input type="checkbox" name="new" id="new"  @if(Request::get('new') =='on') checked @endif> Новинка </label>
                </div>
                <div class="col-sm-2 col-md-2">
                    <label for="recommend">
                        <input type="checkbox" name="recommend" id="recommend"  @if(Request::get('recommend') =='on') checked @endif> Рекомендуем </label>
                </div>
                <div class="col-sm-6 col-md-3">
                    <button type="submit" class="btn btn-primary">Фильтр</button>
                    <a href="{{route('index')}}" class="btn btn-warning">Сброс</a>
                </div>
            </div>
        </form>
        <div class="row">
            @foreach($products as $prod)
            @include('layouts.card', compact('prod'))
            @endforeach
        </div>
        {{$products->links('partials.pagination')}}


    </div>
</div>

@endsection