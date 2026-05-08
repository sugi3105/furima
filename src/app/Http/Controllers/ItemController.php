<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Like;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::where('user_id', '!=', auth()->id())->get();
        return view('items.index', compact('items'));
    }

    public function show($item_id)
    {
        $item = Item::findOrFail($item_id);
        return view('items.show', compact('item'));
    }

    public function create()
    {
        return view('items.create');
    }
    public function store(ItemRequest $request)
    {
        Item::create($request->all());
        return redirect('/');
    }

    public function mylist()
    {
        $item = Item::whereHas('likes', function ($query) {
            $query->where('user_id' , auth()->id());
        })->get();

        return view('mylist', compact('item'));
        }
    }

