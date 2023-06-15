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
                            <div class="reserve-confirmation-area  {{$reserve->id}}">
                                <div class="reserve-confirmation-area-head">
                                    <img src="{{ asset('svg/時計.svg')}}" alt="" id="clock">
                                    <span id="reserve-num">予約{{$loop->iteration}}</span>
                                    <form action="/reserveDelete" method="post">
                                        @csrf
                                        <input type="hidden" value="{{$reserve->id}}" name="id">
                                        <button id="button" type="submit">予約取り消し</button>
                                    </form>
                                    <form class="update-button">
                                        <input type="hidden" value="{{$reserve->id}}" name="id">
                                        <button id="button" type="submit">予約更新</button>
                                    </form>
                                </div>
                                <p><label for="">shop</label>&emsp;<span>{{$reserve->shop->name}}</span></p>
                                <p><label for="">date</label>&emsp;<span id="output-date">{{$reserve->date}}</span></p>
                                <p><label for="">time</label>&emsp;<span id="output-time">{{$reserve->time}}</span></p>
                                <p><label for="">number</label>&emsp;<span id="output-number">{{$reserve->hc}}</span></p>
                            </div>
                            <div class="reserve-confirmation-area {{$reserve->id}} none">
                                <div class="reserve-confirmation-area-head">
                                    <img src="{{ asset('svg/時計.svg')}}" alt="" id="clock">
                                    <span id="reserve-num">予約{{$loop->iteration}}</span>
                                    <form class="cancel-button">
                                        <input type="hidden" value="{{$reserve->id}}" name="id">
                                        <button id="button" type="submit">キャンセル</button>
                                    </form>
                                </div>
                                <form action="/reserveUpdate" method="post">
                                    @csrf
                                    <input type="hidden" value="{{$reserve->id}}" name="id">
                                    <p><label for="">shop</label>&emsp;<span>{{$reserve->shop->name}}</span></p>
                                    <p><label for="">date</label>&emsp;<input type="date" name="date" id="input-date" value="{{$reserve->date}}"></p>
                                    <p><label for="">time</label>&emsp;<input type="time" name="time" id="input-time" value="{{$reserve->time}}"></p>
                                    <p><label for="">number</label>&emsp;<input type="number" max="10" min="1" name="hc" id="input-number" value="{{$reserve->hc}}"></p>
                                    <div class="confirm-button-area">
                                        <button id="confirm-button" type="submit">確定</button>
                                    </div>
                                    @foreach ($errors->all() as $error)
                                    <li class="error">{{$error}}</li>
                                    @endforeach
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="store-wrap">
                <h2>お気に入り店舗</h2>
                <div class="store-wrap-area">
                @foreach($shops as $shop)
                    <div class="store-wrap__item delete{{$shop->shop->id}}" href="">
                        <img src="{{$shop->shop->image_name}}" alt="" class="store-wrap__item-eyecatch">
                        <div class="store-wrap__item-content">
                            <h2>{{$shop->shop->name}}</h2>
                            <div>
                                <p class="store-wrap__item-content-tag">#{{$shop->shop->area}}</p>
                                <p class="store-wrap__item-content-tag">#{{$shop->shop->category}}</p>
                            </div>
                            <div class="store-wrap__item-bottom">
                                <form action="/detail/{{$shop->shop->id}}" method="get" name="id">
                                    <button class="detail">詳しく見る</button>
                                </form>
                                <form class="favoriteDelete">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="shop_id" value="{{$shop->shop->id}}">
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

    <script>
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
        })
        $('.favoriteDelete').on('submit', function(event){
            event.preventDefault();
            const user_id=$(this).find('input[name="user_id"]').val();
            const shop_id=$(this).find('input[name="shop_id"]').val();
            $.ajax({
                url: "{{ route('favoriteDelete') }}",
                method: "POST",
                data: {user_id:user_id,shop_id:shop_id},
                dataType: "json",
            }).done(function(res){
                $('.delete'+res.shop_id).addClass('none');
            }).faile(function(){
                alert('通信の失敗をしました');
            });
        });

        $(function() {
            $('.update-button').on('submit', function(event){
            event.preventDefault();
            const reserve_id=$(this).find('input[name="id"]').val();
            $('.'+reserve_id).toggleClass('none');
            });
            });

        $(function() {
            $('.cancel-button').on('submit', function(event){
            event.preventDefault();
            const reserve_id=$(this).find('input[name="id"]').val();
            $('.'+reserve_id).toggleClass('none');
            });
            });
            
    </script>

@endsection