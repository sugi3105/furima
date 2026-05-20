<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class PurchaseController extends Controller
{
    public function show(Item $item)
    {
        $user = auth()->user();

        return view('items.purchase', compact('item', 'user'));
    }

    public function store(Item $item)
    {
        $item->update([
            "is_sold" => true,
            'purchaser_id' => auth()->id(),
            'shipping_address' =>
                 session('address', auth()->user()->address),
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
        session([
            'address' => $request->address,
        ]);

        return redirect("/purchase/{$item->id}");
    }


}
