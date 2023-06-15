@extends('layouts.layouts')

@section('title','index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')
    <div class="search">
        <div class="search-area">
            <form action="/search" method="get">
            <select value="all area" id="area" name="area" <!--onchange="this.form.submit()"-->>
                <option value="">all area</option>
                @foreach($areas as $area)
                <option value="{{$area->area}}">{{$area->area}}</option>
                @endforeach
            </select>
            <select value="all genre" id="category"  name="category" <!--onchange="this.form.submit()"-->>
                <option value="">all genre</option>
                @foreach($categories as $category)
                <option value="{{$category->category}}">{{$category->category}}</option>
                @endforeach
            </select>
            <input type="search" placeholder="Search" id="search"  name="name">
            @auth
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            @endauth
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
                        @auth
                                @php
                                $favorite=0;
                                if(!empty(App\Models\Favorite::where('user_id',Auth::user()->id)->where('shop_id',$shop->id)->first())){
                                    $favorite++;
                                }
                                @endphp
                                @if($favorite==1)
                                <form class="favoriteDelete deleteOrigin{{$shop->id}}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="shop_id" value="{{$shop->id}}">
                                    <button type="submit">
                                        <img src="{{ asset('svg/red.svg')}}" alt="お気に入り" class="heart">
                                    </button>
                                </form>
                                @else
                                <form class="favoriteStore storeOrigin{{$shop->id}}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="shop_id" value="{{$shop->id}}">
                                    <button type="submit">
                                        <img src="{{ asset('svg/glay.svg')}}" alt="お気に入り" class="heart">
                                    </button>
                                </form>
                                @endif
                                <form class="favoriteDelete delete{{$shop->id}} none">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="shop_id" value="{{$shop->id}}">
                                    <button type="submit">
                                        <img src="{{ asset('svg/red.svg')}}" alt="お気に入り" class="heart">
                                    </button>
                                </form>
                                <form class="favoriteStore store{{$shop->id}} none">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="shop_id" value="{{$shop->id}}">
                                    <button type="submit">
                                        <img src="{{ asset('svg/glay.svg')}}" alt="お気に入り" class="heart">
                                    </button>
                                </form>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
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
                $('.deleteOrigin'+res.shop_id).addClass('none');
                $('.delete'+res.shop_id).addClass('none');
                $('.store'+res.shop_id).removeClass('none');
            }).faile(function(){
                alert('通信の失敗をしました');
            });
        });

        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
        })
        $('.favoriteStore').on('submit', function(event){
            event.preventDefault();
            const user_id=$(this).find('input[name="user_id"]').val();
            const shop_id=$(this).find('input[name="shop_id"]').val();
            $.ajax({
                url: "{{ route('favoriteStore') }}",
                method: "POST",
                data: {user_id:user_id,shop_id:shop_id},
                dataType: "json",
            }).done(function(res){
                $('.storeOrigin'+res.shop_id).addClass('none');
                $('.store'+res.shop_id).addClass('none');
                $('.delete'+res.shop_id).removeClass('none');
            }).faile(function(){
                alert('通信の失敗をしました');
            });
        });
    </script>
@endsection