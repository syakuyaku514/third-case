<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Profile;
use App\Models\SoldItem;
use App\Models\Order;
use App\Models\Payment;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Checkout\Session as StripeSession;

class SoldItemController extends Controller
{
    public function purchase($item_id)
    {
        $item = Item::findOrFail($item_id); // item_idに対応する商品を取得
        $paymentMethods = Payment::all(); // 支払方法を取得

        return view('items.purchase', compact('item', 'paymentMethods')); // 購入ページにデータを渡す
    }

    // 住所変更ページの表示
    public function changeAddress($item_id)
    {
        $profile = Profile::where('user_id', auth()->id())->first();
        // item_idを使って住所変更ページを表示
        return view('items.change_address', compact('profile', 'item_id'));
    }

    public function editProfile($userId)
    {
        $profile = Profile::where('user_id', $userId)->first();

        return view('profile.edit', compact('profile'));
    }

    public function updateAddress(Request $request, $item_id)
    {
        // ログイン中のユーザーのプロフィールを取得
        $profile = Profile::where('user_id', auth()->id())->first();

        // 入力値のバリデーション
        $request->validate([
            'post' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
        ]);

        // プロフィールの住所情報を更新
        $profile->update([
            'post' => $request->post,
            'address' => $request->address,
            'building' => $request->building,
        ]);

        // 確認画面にリダイレクト
        return redirect()->route('purchase', ['item_id' => $item_id]);
    }

    public function checkout(Request $request)
    {
        // 商品情報の取得
        $itemId = $request->input('item_id');
        $item = Item::findOrFail($itemId);

        // Stripe APIキーを設定
        Stripe::setApiKey(config('services.stripe.secret'));

        // StripeのCheckoutセッションを作成
        $checkoutSession = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => $item->price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('complete_purchase', ['item_id' => $item->id]),
            'cancel_url' => url()->previous(),
        ]);

        // StripeのCheckoutページへリダイレクト
        return redirect($checkoutSession->url);
    }

    // 購入するボタン
    public function completePurchase(Request $request, $itemId)
    {
    $validated = $request->validate([
        'payment_method' => 'required|string',
    ]);

    $paymentMethod = $validated['payment_method'];

    if ($paymentMethod === 'クレジットカード') {
        // クレジットカード処理
        return $this->processStripePayment($itemId, $request->stripeToken);
    }

    // 銀行振込やコンビニ払いの場合
    try {
        $payment = Payment::firstOrCreate(['name' => $paymentMethod]);

        $order = Order::create([
            'user_id' => auth()->id(),
            'item_id' => $itemId,
            'payment_id' => $payment->id,
        ]);

        return view('items.complete', ['order' => $order]);
    } catch (\Exception $e) {
        return back()->withErrors(['error' => '購入処理中にエラーが発生しました: ' . $e->getMessage()]);
    }
    }

    // Stripe処理用のメソッド
    private function processStripePayment($itemId)
    {
        $item = Item::findOrFail($itemId);

        Stripe::setApiKey(config('services.stripe.secret')); // Stripe APIキーを設定

        $checkoutSession = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => $item->price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('thank_you'), // 成功時にリダイレクトするURL
            'cancel_url' => url()->previous(), // キャンセル時にリダイレクトするURL
        ]);

        return redirect($checkoutSession->url); // StripeのCheckoutページへリダイレクト
    }

    public function createPaymentIntent(Request $request)
    {
        $item = Item::findOrFail($request->input('item_id'));

        Stripe::setApiKey(config('services.stripe.secret'));

        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => $item->price,
            'currency' => 'jpy',
            'payment_method_types' => ['card'],
        ]);

        return response()->json(['clientSecret' => $paymentIntent->client_secret]);
    }

    public function thankYou()
    {
        return view('items.thank_you');
    }


}
