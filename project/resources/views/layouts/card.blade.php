<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">
            @if($prod->isNew())
                <span class="badge badge-success">Новинка</span>
            @endif
            @if($prod->isRecommend())
                <span class="badge badge-danger">Рекомендумеый</span>
            @endif
            @if($prod->isHit())
                <span class="badge badge-warning">Хит</span>
            @endif
        </div>
        <img src="{{\Illuminate\Support\Facades\Storage::url($prod->image)}}" alt="{{$prod->name}}">
        <div class="caption">
            <h3>{{$prod->name}}</h3>
            <p>{{$prod->pricee}}</p>
            <p>
            </p><form action="{{route('basket-add', $prod->id)}}" method="POST">
                <button type="submit" class="btn btn-primary" role="button">В корзину</button>
                {{--<a href="/{{$prod->category->code}}/{{$prod->code}}" class="btn btn-default" role="button">Подробнее</a>--}}
                <a href="{{route('detail', [$prod->category->code, $prod->code])}}" class="btn btn-default" role="button">Подробнее</a>
                @csrf
            </form>
            <p></p>
        </div>
    </div>
</div>