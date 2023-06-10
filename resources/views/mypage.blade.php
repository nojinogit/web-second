@extends('layouts.layouts')

@section('title','MyPage')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css')}}">
@endsection

@section('content')
    <div class="container">
        <div class="flex__item store-wrap">
            <div class="store-wrap__item" href="">
                @foreach($reserves as $reserve)
                <h1>{{$reserve->shop->name}}</h1>
                <img src="" alt="" class="store-wrap__item-eyecatch">
                <div class="store-wrap__item-content">
                    <div>
                        <p class="store-wrap__item-content-tag">#{{$reserve->date}}</p>
                        <p class="store-wrap__item-content-tag">#{{$reserve->time}}</p>
                    </div>
                    <div class="flex__item store-wrap">
                        <p>※予約可能時間&emsp;11：00～22：00</p>
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