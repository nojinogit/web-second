@extends('layouts.layouts')

@section('title','index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')
    <div class="search">
        <div class="search-area">
            <form action="/search" method="get">
            <select value="all area" id="area" name="area" onchange="this.form.submit()">
                <option value="">all area</option>
                @foreach($areas as $area)
                <option value="{{$area->area}}">{{$area->area}}</option>
                @endforeach
            </select>
            <select value="all genre" id="category"  name="category" onchange="this.form.submit()">
                <option value="">all genre</option>
                @foreach($categories as $category)
                <option value="{{$category->category}}">{{$category->category}}</option>
                @endforeach
            </select>
            <input type="search" placeholder="Search" id="search"  name="name">
            <button>search</button>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="flex__item store-wrap">
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