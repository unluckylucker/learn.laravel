@extends('auth.layouts.master')
@isset($product)
    @section('title', 'Редактировать товар '. $product->name)
@else
    @section('title', 'Создать товар')
@endisset

@section('content')
    <div class="col-md-12">
        <h1>@yield('title')</h1>

        @foreach($errors->all() as $error)
            {{$error}}
            <br>
            @endforeach
        <form method="POST" enctype="multipart/form-data"
              @isset($product)
              action="{{route('products.update', $product)}}"
              @else
              action="{{route('products.store')}}"
                @endisset

        >
            @csrf
            <div>
                @isset($product)
                    @method('PUT')
                @endisset
                <div class="input-group row">
                    <label for="code" class="col-sm-2 col-form-label">Код: </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="code" id="code"
                               value="@isset($product){{$product->code}}@endisset">
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="name" class="col-sm-2 col-form-label">Название: </label>
                    <div class="col-sm-6">

                        <input type="text" class="form-control" name="name" id="name"
                               value="@isset($product){{$product->name}}@endisset">
                    </div>
                </div>
                    <br>
                    <div class="input-group row">
                        <label for="pricee" class="col-sm-2 col-form-label">Цена: </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="pricee" id="pricee"
                                   value="@isset($product){{$product->pricee}}@endisset">
                        </div>
                    </div>

                <br>
                <div class="input-group row">
                    <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                    <div class="col-sm-6">
                        <textarea name="description" id="description" cols="72"
                                  rows="7">@isset($product){{$product->description}}@endisset</textarea>
                    </div>
                </div>
                <br>
                    <div class="input-group row">
                        <label for="category" class="col-sm-2 col-form-label">Категория: </label>
                        <div class="col-sm-6">
                            <select name="category_id" id="category">
                                @foreach($categories as $category)
                                <option value="{{$category->id}}"
                                @isset($product)
                                    @if($category->id == $product->category_id)
                                        selected
                                    @endif
                                @endisset
                                >
                                    {{$category->name}}
                                </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <br>

                <div class="input-group row">
                    <label for="image" class="col-sm-2 col-form-label">Картинка: </label>
                    <div class="col-sm-10">
                        <label class="btn btn-default btn-file">
                            Загрузить <input type="file" style="display: none;" name="image" id="image">
                        </label>
                    </div>
                </div>
                    <br>
                   @foreach(['hit'=>'Хит', 'new'=>'Новинка', 'recommend'=>'Рекомендуемые'] as $key=>$item)
                        <div class="input-group row">
                            <label for="code" class="col-sm-2 col-form-label">{{$item}}</label>
                            <div class="col-sm-6">
                                <input type="checkbox" class="form-control" name="{{$key}}" id="{{$key}}"
                                       @if(isset($product) && $product->$key ===1)
                                       checked
                                       @endif
                                >
                            </div>
                        </div>
                       @endforeach
                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>


@endsection