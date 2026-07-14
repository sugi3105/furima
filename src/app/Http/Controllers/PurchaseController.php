<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\ParchaseRequest;

class PurchaseController extends Controller
{
    public function show(Item $item)
    {
        $user = auth()->user();

        return view('items.purchase', compact('item', 'user'));
    }

    public function store(ParchaseRequest $request, Item $item)
    {
        $user = auth()->user();

        $postcode = session('postcode', $user->postcode);
        $address = session('address', $user->address);

        if (empty($postcode) || empty($address)) {
            return back()->withErrors([
                'address' => '配送先を登録してください'
            ])->withInput();
        }

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

    public function updateAddress(AddressRequest $request, Item $item)
    {
        session([
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building' => $request->building,
        ]);
        
        $item->update([
            'shipping_address' => $request->address,
        ]);

        return redirect("/purchase/{$item->id}");
    }


}
