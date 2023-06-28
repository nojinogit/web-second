@extends('layouts.layouts')

@section('title','management')

@section('css')
<link rel="stylesheet" href="{{ asset('css/management.css')}}">
@endsection

@section('content')

<main class="main">
    <div>
        <h1>
            マネジメント管理
        </h1>
    </div>

    <div class="main__search">
        <h2>代表店舗</h2>
        <table class="main__search--table">
            <tr>
                <th>店舗名</th>
                <th>店舗情報</th>
                <th>予約状況</th>
            </tr>
            @foreach($shops as $shop)
            <tr>
                <td>{{$shop->shop->name}}</td>
                <td>
                    <form method="get" action="{{route('shopUpdateIndex')}}">
                        <input type="hidden" value="{{$shop->shop->id}}" name="id">
                        <button type="submit">更新画面を開く</button>
                    </form>
                </td>
                <td>
                    <form  method="get" action="{{route('shopReserve')}}">
                        <input type="hidden" name="id" value="{{$shop->shop->id}}">
                        <div class="main__search--step-input-day">
                            <input type="date" name="startDate">
                            <div class="to">～</div>
                            <input type="date" name="endDate">
                            <button type="submit">検索</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

    @isset($shopUpdate)
    <div class="main__detail">
        <h2>店舗詳細</h2>
        <div class="flex__item">
            <div class="shop-wrap__item">
                <h1>{{$shopUpdate->name}}</h1>
                <img src="{{asset($shopUpdate->path)}}" alt="" class="shop-wrap__item-eyecatch">
                <div class="shop-wrap__item-content">
                    <div>
                        <p class="shop-wrap__item-content-tag">#{{$shopUpdate->area}}</p>
                        <p class="shop-wrap__item-content-tag">#{{$shopUpdate->category}}</p>
                    </div>
                    <div class="flex__item shop-wrap">
                        <p>{{$shopUpdate->overview}}</p>
                    </div>
                </div>
            </div>
            <div class="shop-wrap__item">
                <form action="{{route('shopUpdate')}}" method="post"  enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" value="{{$shopUpdate->id}}" name="id">
                    <p><label for="">店舗名</label>&emsp;<input type="text" name="name" value="{{$shopUpdate->name}}"></p>
                    <p><label for="">都道府県</label>&emsp;<input type="text" name="area"  value="{{$shopUpdate->area}}"></p>
                    <p><label for="">ジャンル</label>&emsp;<input type="text" name="category"  value="{{$shopUpdate->category}}"></p>
                    <p>店舗概要&emsp;<textarea name="overview" cols="50" rows="8"></textarea></p>
                    <p><label for="">店舗画像</label>&emsp;<input type="file" name="image"></p>
                    <button type="submit">更新</button>
                </form>
            </div>
        </div>
    </div>
    @endisset

    @isset($reserves)
    <div class="main__search">
        @foreach($reserves as $reserve)
        <h2>{{$reserve->shop->name}}</h2>
        @break
        @endforeach
        <table>
            <tr>
                <th>日付</th>
                <th>時間</th>
                <th>名前</th>
                <th>人数</th>
                <th>キャンセル</th>
            </tr>
            @foreach($reserves as $reserve)
            <tr class="main__search--table">
                <td>{{$reserve->date}}</td>
                <td>{{$reserve->time}}</td>
                <td>{{$reserve->user->name}}</td>
                <td>{{$reserve->hc}}</td>
                <td>{{$reserve->deleted_at}}</td>
                <td>
                    <form action="{{route('informMail')}}" method="get">
                        <input type="hidden" value="{{$reserve->user->name}}" name="name">
                        <input type="hidden" value="{{$reserve->user->email}}" name="email">
                        <input type="hidden" value="{{$reserve->shop->name}}" name="shop">
                        <input type="hidden" value="{{$reserve->date}}" name="date">
                        <input type="hidden" value="{{$reserve->time}}" name="time">
                        <button type="submit">お知らせメール</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    @endisset

    <div class="main__add--table">
        <h2>新規店舗作成</h2>
        @if (count($errors) > 0)
                <ul class="error">
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
                </ul>
                @endif
        <div>
            <div id="time"></div>
                @if(session('message'))
                <div class="message">
                    <div class="message__success">
                        <p class="message__success--p" id="session" style="color:blue;">{{session('message')}}</p>
                    </div>
                </div>
                @endif
            </div>
        <table>
            <tr class="main__add--table-title">
                <th>店舗名</th>
                <th>都道府県</th>
                <th>ジャンル</th>
                <th>店舗概要</th>
                <th>店舗画像</th>
            </tr>
            <tr>
                <form  method="POST" action="{{route('shopCreate')}}" enctype="multipart/form-data">
                    @csrf
                    <td><input type="text" name="name"></td>
                    <td><input type="text" name="area"></td>
                    <td><input type="text" name="category"></td>
                    <td><textarea name="overview"></textarea></td>
                    <td><input type="file" name="image"></td>
                    <td><button type="submit">登録</button></td>
                </form>
            </tr>
        </table>
    </div>

</main>

@endsection