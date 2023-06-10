@extends('layouts.layouts')

@section('title','MyPage')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css')}}">
@endsection

@section('content')
    <div class="container">
        <div class="store-wrap">
            <h1>予約状況</h1>
            <div class="store-wrap__item" href="">
                @foreach($reserves as $reserve)
                    <div class="reserve-confirmation">
                        <div class="reserve-confirmation-area">
                            <img src="{{ asset('svg/時計.svg')}}" alt="" id="clock"><span id="reserve-num">予約{{$loop->iteration}}</span>
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