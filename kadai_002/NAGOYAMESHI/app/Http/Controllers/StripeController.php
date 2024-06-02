<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\User;

class StripeController extends Controller
{
    // フォームを表示
    public function subscription(Request $request){
        $user=Auth::user();
          return view('subscription.subscription',  [
            'intent' => $user->createSetupIntent()
        ]);
    }

    // フォームを投稿後、データを保存
    public function store(Request $request){
        // ログインユーザーを$userとする
        $user = Auth::user();
 
        // またStripe顧客でなければ、新規顧客にする
        $stripeCustomer = $user->createOrGetStripeCustomer();
 
        // フォーム送信の情報から$paymentMethodを作成する
        $paymentMethod = $request->input('stripePaymentMethod');
 
        // プランはconfigに設定したsubscription_idとする
        $plan = config('services.stripe.subscription_id');
        
        // 上記のプランと支払方法で、サブスクを新規作成する
        $user->newSubscription('default', $plan)->create($paymentMethod);
        
        return to_route('mypage');
    }

    public function edit(Request $request){
        $user = Auth::user();

        return view('subscription.edit',  [
            'intent' => $user->createSetupIntent()
        ]);
    }

    public function update(Request $request){
        $user = Auth::user();

        $paymentMethod = $request->input('stripePaymentMethod');
        Auth::user()->updateDefaultPaymentMethod($paymentMethod);
        return back()->with(['success' => "クレジットカード情報を変更しました。"]);
    }

    public function cancel_confirm(Request $request){
        $user = Auth::user();

        return view('subscription.cancel');
    }

    public function cancel(Request $request, User $user){
        $user = Auth::user();
        $user->subscription(config('services.stripe.subscription_id'))->cancel();
        
        return to_route('mypage')->with(['success' => "解約しました。ご利用ありがとうございました。"]);;
    }
}
