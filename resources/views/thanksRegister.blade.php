@extends('layouts.layouts')

@section('title','thanks')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css')}}">
@endsection

@section('content')
    <div class="container">
        <div  class="thanks">
            <h1>会員登録ありがとうございます</h1>
            <a href="/">戻る</a>
        </div>
    </div>
@endsection