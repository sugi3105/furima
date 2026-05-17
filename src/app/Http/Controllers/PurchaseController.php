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
        ]);

        return redirect('/');
    }


}
