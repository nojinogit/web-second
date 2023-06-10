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
                <img src="{{$shop->image_name}}" alt="" class="store-wrap__item-eyecatch">
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
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
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
                    <button type="submit" id="button">予約する</button>
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
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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