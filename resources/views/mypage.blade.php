@extends('layouts.layouts')

@section('title','MyPage')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css')}}">
@endsection

@section('content')
    <div class="container">
        <h1>ようこそ&emsp;{{ Auth::user()->name }}さん！</h1>
        <div class="container-area">
            <div class="reserve-wrap">
                <h2>予約状況</h2>
                <div class="reserve-wrap__item" href="">
                    @foreach($reserves as $reserve)
                        <div class="reserve-confirmation">
                            <div class="reserve-confirmation-area">
                                <div class="reserve-confirmation-area-head">
                                    <img src="{{ asset('svg/時計.svg')}}" alt="" id="clock">
                                    <span id="reserve-num">予約{{$loop->iteration}}</span>
                                    <form action="/reserveDelete" method="post">
                                        @csrf
                                        <input type="hidden" value="{{$reserve->id}}" name="id">
                                        <button id="cancel-button" type="submit">予約取り消し</button>
                                    </form>
                                </div>
                                <p><label for="">shop</label>&emsp;<span>{{$reserve->shop->name}}</span></p>
                                <p><label for="">date</label>&emsp;<span id="output-date">{{$reserve->date}}</span></p>
                                <p><label for="">time</label>&emsp;<span id="output-time">{{$reserve->time}}</span></p>
                                <p><label for="">number</label>&emsp;<span id="output-number">{{$reserve->hc}}</span></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="store-wrap">
                <h2>お気に入り店舗</h2>
                <div class="store-wrap-area">
                @foreach($shops as $shop)
                    <div class="store-wrap__item" href="">
                        <img src="{{$shop->image_name}}" alt="" class="store-wrap__item-eyecatch">
                        <div class="store-wrap__item-content">
                            <h2>{{$shop->name}}</h2>
                            <div>
                                <p class="store-wrap__item-content-tag">#{{$shop->area}}</p>
                                <p class="store-wrap__item-content-tag">#{{$shop->category}}</p>
                            </div>
                            <div class="store-wrap__item-bottom">
                                <form action="/detail/{{$shop->id}}" method="get" name="id">
                                    <button class="detail">詳しく見る</button>
                                </form>
                                <form action="/favoriteDeleteMyPage" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="shop_id" value="{{$shop->id}}">
                                    <button type="submit">
                                    <img src="{{ asset('svg/red.svg')}}" alt="お気に入り" class="heart">
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    
</script>

@endsection