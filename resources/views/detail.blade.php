@extends('layouts.layouts')

@section('title','detail')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css')}}">
@endsection

@section('content')
    <div class="container">
        <div class="flex__item store-wrap">
            <div class="store-wrap__item" href="">
                <h1>{{$shop->name}}</h1>
                <img src="{{asset($shop->path)}}" alt="" class="store-wrap__item-eyecatch">
                <div class="store-wrap__item-content">
                    <div>
                        <p class="store-wrap__item-content-tag">#{{$shop->area}}</p>
                        <p class="store-wrap__item-content-tag">#{{$shop->category}}</p>
                    </div>
                    <div class="flex__item store-wrap">
                        <p>
                            {{$shop->overview}}
                        </p>
                        <p>※予約可能時間&emsp;11：00～22：00</p>
                    </div>
                </div>
            </div>
            <div class="reserve">
                <h2>予約</h2>
                <form action="/reserveAdd" method="post">
                        @csrf
                    <div class="reserve-input">
                        @auth
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        @endauth
                        <input type="hidden" name="shop_id" value="{{$shop->id}}">
                        <p><input type="date" name="date" id="input-date" value="{{ old('date') }}"></p>
                        <p><input type="time" name="time" id="input-time" value="{{ old('time') }}"></p>
                        <p><input type="number" max="10" min="1" name="hc" id="input-number" value="{{ old('hc') }}"></p>
                    </div>
                    <div class="reserve-confirmation">
                        <div class="reserve-confirmation-area">
                            <p><label for="">shop</label>&emsp;<span>{{$shop->name}}</span></p>
                            <p><label for="">date</label>&emsp;<span id="output-date">{{ old('date') }}</span></p>
                            <p><label for="">time</label>&emsp;<span id="output-time">{{ old('time') }}</span></p>
                            <p><label for="">number</label>&emsp;<span id="output-number">{{ old('hc') }}</span></p>
                        </div>
                    </div>
                    <button type="submit" id="button">
                        @auth予約する
                        @else予約にはログインが必要です
                        @endauth
                    </button>
                </form>
                @if (count($errors) > 0)
                <ul class="error">
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
                </ul>
                @endif
            </div>
        </div>
        @isset($reviewArea)
        <div class="review-area">
            <div class="review-box">
                <h3>店舗の評価をしてください</h3>
                @if(session('message'))
                <div class="message">
                    <div class="message__false">
                        <p class="message__false--p" id="session" style="color:red;">{{session('message')}}</p>
                    </div>
                </div>
                @endif
                <form action="{{route('reviewAdd')}}" method="post">
                    @csrf
                    <div class="rate-form">
                        <input type="hidden" value="{{$reviewArea->id}}" name="id">
                        <input type="hidden" value="{{$shop->id}}" name="shop_id">
                        <input id="star5" type="radio" name="score" value="5">
                        <label for="star5">★</label>
                        <input id="star4" type="radio" name="score" value="4">
                        <label for="star4">★</label>
                        <input id="star3" type="radio" name="score" value="3">
                        <label for="star3">★</label>
                        <input id="star2" type="radio" name="score" value="2">
                        <label for="star2">★</label>
                        <input id="star1" type="radio" name="score" value="1">
                        <label for="star1">★</label>
                    </div>
                    <div>
                        <p>レビュー</p>
                        <textarea name="review" id="" cols="100" rows="10"></textarea>
                    </div>
                    <button type="submit">投稿する</button>
                </form>
            </div>
        </div>
        @endisset
        <div>
            @foreach($reviews as $review)
            <div class="review-main">
                <div class="review-user">
                    <p>{{$review->user->name}}</p>
                    <p>{{$review->updated_at}}</p>
                </div>
                <p>
                    <span class="star5_rating" data-rate="{{$review->score}}"></span>
                </p>
                <p>{{$review->review}}</p>
                @if(Auth::user()->id==$review->user->id)
                <form action="{{route('reviewDelete')}}" method="post">
                    @csrf
                    <input type="hidden" value="{{$review->id}}" name="id">
                    <input type="hidden" value="{{$shop->id}}" name="shop_id">
                    <button>投稿を削除する</button>
                </form>
                @endif
            </div>
            @endforeach
        </div>
    </div>

<script>
    $(function() {
    $('#input-date').on('input',function(){
    $('#output-date').text($(this).val());
    });
    $('#input-time').on('input',function(){
    $('#output-time').text($(this).val());
    });
    $('#input-number').on('input',function(){
    $('#output-number').text($(this).val());
    });
});
</script>

@endsection