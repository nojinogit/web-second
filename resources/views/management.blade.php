@extends('layouts.layouts')

@section('title','management')

@section('css')
<link rel="stylesheet" href="{{ asset('css/management.css')}}">
@endsection

@section('content')

<main class="main">
    <div>
        <h1>
            管理システム
        </h1>
    </div>
    <div class="main__search">
        <form action="/search" method="get">
        @csrf
        <div class="main__search--step">
            <div class="main__search--step-name">
                <div class="main__search--step-title">
                    お名前
                </div>
                <div  class="main__search--step-input">
                    <input name="fullname">
                </div>
            </div>
            <div class="main__search--step-gender">
                <div class="main__search--step-title-gender">
                    性別
                </div>
                <div  class="main__search--step-button">
                    <input type="radio" name="gender" value="" checked>全て
                    <input type="radio" name="gender" value="1">男性
                    <input type="radio" name="gender" value="2">女性
                </div>
            </div>
        </div>
        <div class="main__search--step">
            <div class="main__search--step-title">
                登録日
            </div>
            <div class="main__search--step-input-day">
                <input type="date" name="startDate">
                <div class="to">～</div>
                <input type="date" name="endDate">
            </div>
        </div>
        <div class="main__search--step">
            <div class="main__search--step-title">
                メールアドレス
            </div>
            <div class="main__search--step-input">
                <input  name="email">
            </div>
        </div>
        <div class="main__search--submit">
            <input type="submit" value="検索">
        </div>
        <div>
            <button type="reset" class="main__search--reset">リセット</button>
        </div>
        </form>
    </div>

    @isset($contacts)
    <div class="main__search--paginate">
        <div>
            <p>全{{ $contacts->total() }}中
            {{  ($contacts->currentPage() -1) * $contacts->perPage() + 1}} ~
            {{ (($contacts->currentPage() -1) * $contacts->perPage() + 1) + (count($contacts) -1)  }}件</p>
        </div>
        <div>
            {{$contacts->appends(request()->query())->links()}}
        </div>
    </div>
    <div class="main__search--table">
        <table>
            <tr class="main__search--table-title">
                <th>ID</th>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>ご意見</th>
            </tr>
            @foreach($contacts as $contact)
            <tr>
                <form action="/delete" method="post">
                    @csrf
                    @method('DELETE')
                    <td>{{$contact['id']}}</td>
                    <td>{{$contact['fullname']}}</td>
                    <td>
                        @if($contact['gender']==1){{'男性'}}
                        @elseif($contact['gender']==2){{'女性'}}
                        @endif
                    </td>
                    <td>{{$contact['email']}}</td>
                    <td class="opinion">
                        <span class="opinion-limit">{{$contact['opinion']}}</span>
                        <span class="opinion-origin none">{{$contact['opinion']}}</span>
                    </td>
                    <input type="hidden" name="id" value="{{$contact['id']}}">
                    <td><input type="submit" value="削除" id="delete__submit"></td>
                </form>
            </tr>
            @endforeach
        </table>
    </div>
    @endisset
</main>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
const TextLimit = () => {
    let maxLength = 25;
    let limitedText = document.getElementsByClassName('opinion-limit');
    for (i = 0; i < limitedText.length; i++) {
    let originalText = document.getElementsByClassName('opinion-limit')[i].innerHTML;
    if (originalText.length > maxLength) {
        document.getElementsByClassName('opinion-limit')[i].innerHTML = originalText.substr(0, maxLength) + '...';
    }
    }
    }
TextLimit();

$(function() {

    $('.opinion').hover(function(){
        $(this).find('.opinion-limit').toggleClass('none');
        $(this).find('.opinion-origin').toggleClass('none')},
    function(){
        $(this).find('.opinion-limit').toggleClass('none');
        $(this).find('.opinion-origin').toggleClass('none')}
    )
});
</script>

@endsection