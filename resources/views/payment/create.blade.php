<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>confirmation</title>
    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/create.css')}}"/>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<header>
    <div class="header">
        <span class="nav_toggle">
            <i></i>
            <i></i>
            <i></i>
        </span>
        @auth
        <nav class="nav">
            <ul class="nav_menu_ul">
                <li class="nav_menu_li"><a href="/myPage">マイページ</a></li>
                <li class="nav_menu_li"><a href="/search">店舗検索</a></li>
                <li class="nav_menu_li">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                            <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                            </x-dropdown-link>
                    </form>
                </li>
                @if(Auth::user()->role > 9)
                <li class="nav_menu_li"><a href="/managementIndex">マネジメント画面</a></li>
                @endif
                @if(Auth::user()->role > 99)
                <li class="nav_menu_li"><a href="/accountIndex">アカウント画面</a></li>
                @endif
            </ul>
        </nav>
        @else
        <nav class="nav">
            <ul class="nav_menu_ul">
                <li class="nav_menu_li"><a href="/search">店舗検索</a></li>
                <li class="nav_menu_li"><a href="/login">ログイン</a></li>
                <li class="nav_menu_li"><a href="/register">会員登録</a></li>
            </ul>
        </nav>
        @endauth
        <span id="title">Rese</span>
    </div>
</header>
<body>
    <div class="container">
        @if (session('flash_alert'))
            <div class="alert alert-danger">{{ session('flash_alert') }}</div>
        @elseif(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="reserve-area">
            <p>ご予約ありがとうございました</p>
            <p>引き続き事前決済をお願いします</p>
            <p>{{$reserveData->shop->name}}</p>
            <p>おすすめコース{{$reserveData->hc}}人分、{{$reserveData->hc}},000円</p>
        </div>
        <div class="credit">
            <div class="credit-area col-6 card">
                <div class="card-header">Stripe決済</div>
                <div class="card-body">
                    <form id="card-form" action="{{ route('payment.store') }}" method="POST">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id" value="{{$reserveData->id}}">
                        <input type="hidden" name="pay" value="{{$reserveData->hc}}000">
                        <div>
                            <label for="card_number">カード番号</label>
                            <div id="card-number" class="form-control"></div>
                        </div>

                        <div>
                            <label for="card_expiry">有効期限</label>
                            <div id="card-expiry" class="form-control"></div>
                        </div>

                        <div>
                            <label for="card-cvc">セキュリティコード</label>
                            <div id="card-cvc" class="form-control"></div>
                        </div>

                        <div id="card-errors" class="text-danger"></div>

                        <button class="mt-3 btn btn-primary">決済する</button>
                    </form>
                    <form action="{{route('myPage')}}">
                        <button type="submit" class="mt-3 btn btn-primary">おすすめコースをキャンセルしてマイページへ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        /* 基本設定*/
        const stripe_public_key = "{{ config('stripe.stripe_public_key') }}"
        const stripe = Stripe(stripe_public_key);
        const elements = stripe.elements();

        var cardNumber = elements.create('cardNumber');
        cardNumber.mount('#card-number');
        cardNumber.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var cardExpiry = elements.create('cardExpiry');
        cardExpiry.mount('#card-expiry');
        cardExpiry.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var cardCvc = elements.create('cardCvc');
        cardCvc.mount('#card-cvc');
        cardCvc.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var form = document.getElementById('card-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            var errorElement = document.getElementById('card-errors');
            if (event.error) {
                errorElement.textContent = event.error.message;
            } else {
                errorElement.textContent = '';
            }

            stripe.createToken(cardNumber).then(function(result) {
                if (result.error) {
                    errorElement.textContent = result.error.message;
                } else {
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            var form = document.getElementById('card-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            form.submit();
        }
    </script>
    <script>
    $(".nav_toggle").on("click", function () {
    $(".nav_toggle, .nav").toggleClass("show");
    });
    </script>
</body>
</html>