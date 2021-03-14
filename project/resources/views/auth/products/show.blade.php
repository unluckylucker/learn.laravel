@extends('auth.layouts.master')
@section('title', $product->name)
@section('content')
    <div class="col-md-12">
        <h1>Категория {{ $product->name }}</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    Поле
                </th>
                <th>
                    Значение
                </th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $product->id }}</td>
            </tr>
            <tr>
                <td>Код</td>
                <td>{{ $product->code }}</td>
            </tr>
            <tr>
                <td>Название</td>
                <td>{{ $product->name }}</td>
            </tr>
            <tr>
                <td>Описание</td>
                <td>{{ $product->description }}</td>
            </tr>
            <tr>
                <td>Категория</td>
                <td>{{ $product->category->name }}</td>
            </tr>
            <tr>

                    @if($prod->isNew())
                        <td>Новинка</td>
                    @endif
                    @if($prod->isRecommend())
                        <td> Рекомендумеый></td>
                    @endif
                    @if($prod->isHit())
                        <td>Хит</td>
                    @endif

            </tr>
            <tr>
                <td>Цена</td>
                <td>{{ $product->pricee }}</td>
            </tr>
            <tr>
                <td>Картинка</td>
                <td><img src="{{\Illuminate\Support\Facades\Storage::url($product->image)}}"
                         height="240px"></td>
            </tr>
            </tbody>
        </table>
    </div>


@endsection