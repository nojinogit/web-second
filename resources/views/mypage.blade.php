@extends('layouts.layouts')

@section('title','MyPage')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css')}}">
@endsection

@section('content')
    <div class="container">
        <h1>ようこそ&emsp;{{ Auth::user()->name }}さん！</h1>
        <div class="store-wrap">
            <h2>予約状況</h2>
            <div class="store-wrap__item" href="">
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
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    
</script>

@endsection