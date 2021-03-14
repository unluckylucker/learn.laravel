@extends('layouts.app')
@section('title', $category->name)
@section('content')


<div class="container">
    <div class="starter-template">
        <h1>
            {{$category->name}} Количество: {{$category->products->count()}}
        </h1>
        <p>
            В этом разделе вы найдёте самые популярные мобильные телефонамы по отличным ценам!
        </p>
        <div class="row">
            @foreach($category->products as $prod)
                @include('layouts.card', compact('prod'))
            @endforeach
        </div>
    </div>
</div>

@endsection
