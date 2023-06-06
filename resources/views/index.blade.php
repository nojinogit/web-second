@extends('layouts.layouts')

@section('title','index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')
    <div class="container">
        <div class="flex__item store-wrap">
            @foreach($stores as $store)
            <div class="store-wrap__item" href="">
                <img src="{{$store->image_name}}" alt="" class="store-wrap__item-eyecatch">
                <div class="store-wrap__item-content">
                    <h2>{{$store->name}}</h2>
                    <div>
                        <p class="store-wrap__item-content-tag">#{{$store->area}}</p>
                        <p class="store-wrap__item-content-tag">#{{$store->category}}</p>
                    </div>
                    <div class="flex__item store-wrap">
                        <a href="" class="detail">詳しく見る</a>
                        <button type="submit">
                            <img src="{{ asset('svg/glay.svg')}}" alt="お気に入り" class="heart">
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection