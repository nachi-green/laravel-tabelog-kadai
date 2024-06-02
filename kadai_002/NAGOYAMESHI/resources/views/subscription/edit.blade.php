@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center mt-3">
    <div class="w-50">
        <h2 class="mt-3 mb-3">クレジットカード情報更新</h2>
        <div class="mt-4">
        @auth
            <div class="row">
                <form action="{{ route('stripe.update') }}" method="POST" id="payment-form">
                    @csrf
                    @method('PUT')
                    <label for="card-holder-name" class="m-1 fs-6">お名前</label>
                    <input type="test" class="form-control MyCardElement col-sm-5 mb-2" id="card-holder-name" required>
                
                    <label for="card-element" class="m-1 fs-6">カード番号</label>
                    <div class="form-group MyCardElement col-sm-5 mb-2" id="card-element"></div>
                
                    <div id="card-errors" role="alert" style='color:red'></div>
                
                    <div class="form-group m-1">
                        <button class="mt-3 btn btn-warning" id="card-button" data-secret="{{ $intent->client_secret }}">更新</button>
                    </div>
                </form>
            </div>
        @endauth
        </div>
    </div>
</div>
<script>
    // HTMLの読み込み完了後に実行するようにする
	window.onload = my_init;
    function my_init() {

        // Configに設定したStripeのAPIキーを読み込む  
        const stripe = Stripe("{{ config('services.stripe.pb_key') }}");
        const elements = stripe.elements();

        var style = {
            base: {
            color: "#32325d",
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: "antialiased",
            fontSize: "16px",
            "::placeholder": {
            color: "#aab7c4"
            }
        },
        invalid: {
            color: "#fa755a",
            iconColor: "#fa755a"
        }
        };
        
        const cardElement = elements.create('card', {style: style, hidePostalCode: true});
        cardElement.mount('#card-element');

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        cardButton.addEventListener('click', async (e) => {
            // formのsubmitボタンのデフォルト動作を無効にする
            e.preventDefault();
            const { setupIntent, error } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                    card: cardElement,
                    billing_details: { name: cardHolderName.value }
                    }
                }
            );
            
            if (error) {
            // エラー処理
            console.log('error');
            
            } else {
            // 問題なければ、stripePaymentHandlerへ
            stripePaymentHandler(setupIntent);
            }
        });
    }

    function stripePaymentHandler(setupIntent) {
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripePaymentMethod');
    hiddenInput.setAttribute('value', setupIntent.payment_method);
    form.appendChild(hiddenInput);
    // フォームを送信
    form.submit();
    }
    </script>
<script src="https://js.stripe.com/v3/"></script>
@endsection
