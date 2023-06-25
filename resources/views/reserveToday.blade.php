@extends('layouts.layouts')

@section('title','reserveToday')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reserveToday.css')}}">
@endsection

@section('content')

<main class="main">
    <div>
        <h1>
            当日予約状況
        </h1>
    </div>

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

</main>

@endsection