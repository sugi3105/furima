<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PurchaseController extends Controller
{
    public function show(Item $item)
    {
        $user = auth()->user();

        return view('items.purchase', compact('item', 'user'));
    }

    public function store(Request $request, Item $item)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $paymentMethod = $request->payment;

        $session = Session::create([
        //'payment_method_types' => ['card'],
        'payment_method_types' => [$paymentMethod],
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
        'success_url' => url("/purchase/success/{$item->id}"),
        'cancel_url' => url("/purchase/{$item->id}"),
    ]);

        return redirect($session->url);
    }

    public function success(Item $item)
    {
        $item->update([
            'is_sold' => true,
            'purchaser_id' => auth()->id(),
        ]);

        return redirect('/');
    }

    public function editAddress(Item $item)
    {
        $user = auth()->user();

        return view('items.address', compact('item', 'user'));
    }

    public function updateAddress(Request $request, Item $item)
    {
        $item->update([
            'shipping_address' => $request->address,
        ]);

        return redirect("/purchase/{$item->id}");
    }


}
